<?php
namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaExport implements FromCollection, WithHeadings, WithStyles
{
    protected $kelasId;
    protected $meetingId;

    public function __construct($kelasId, $meetingId)
    {
        $this->kelasId = $kelasId;
        $this->meetingId = $meetingId;
    }

    public function collection()
    {
        // Ambil semua siswa dengan role_id 4 dari kelas terkait
        $siswa = \App\Models\User::with(['kelas', 'absensi' => function ($q) {
            $q->where('meeting_id', $this->meetingId);
        }, 'absensi.meeting'])
        ->whereHas('kelas', function ($q) {
            $q->where('kelas_id', $this->kelasId);
        })
        ->where('role_id', 4)
        ->get();
    
        return $siswa->map(function ($user) {
            $absen = $user->absensi->first(); // bisa null
            return [
                'Nama' => $user->name,
                'Email' => $user->email,
                'Kehadiran' => $absen->status ?? 'Belum mengisi',
                'Waktu Kehadiran' => $absen->tanggal_absen ?? '-',
                'Kelas' => $user->kelas->first()->name ?? '-',
                'Pertemuan' => $absen->meeting->title ?? '-',
            ];
        });
    }
    

    public function headings(): array
    {
        return ['Nama', 'Email', 'Kehadiran', 'Waktu Kehadiran', 'Kelas', 'Pertemuan'];
    }

    public function styles(Worksheet $sheet)
    {
        // Header style
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '4CAF50'],
            ],
        ]);

        // Data row style
        $sheet->getStyle('A2:F' . $sheet->getHighestRow())->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Lebar kolom
        $sheet->getColumnDimension('A')->setWidth(20); // Nama
        $sheet->getColumnDimension('B')->setWidth(30); // Email
        $sheet->getColumnDimension('C')->setWidth(15); // Kehadiran
        $sheet->getColumnDimension('D')->setWidth(25); // Waktu Kehadiran
        $sheet->getColumnDimension('E')->setWidth(20); // Kelas
        $sheet->getColumnDimension('F')->setWidth(30); // Pertemuan
    }
}
