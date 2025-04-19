<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raport - {{ $student->name }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
        }
        .info {
            margin-bottom: 20px;
        }
        .info table {
            width: 100%;
            font-size: 13px;
        }
        .info td {
            padding: 4px 8px;
        }
        .thanks {
            margin-bottom: 15px;
            font-style: italic;
            text-align: justify;
        }
        .tehk {
            margin-bottom: 15px;
            font-style: italic;
            text-align: justify;
            font-weight: bold;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .report-table th, .report-table td {
            border: 1px solid #555;
            padding: 8px;
            text-align: center;
        }
        .report-table th {
            background-color: #f0f0f0;
        }
        .footer {
            margin-top: 40px;
        }
        .ttd {
            margin-top: 60px;
            text-align: right;
        }
        .ttd p {
            margin: 2px;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h2>Laporan Nilai Siswa</h2>
            <p>Dokumen ini bersifat resmi dan di lindungi oleh PKBM Academia</p>
        </div>

        <div class="info">
            <table>
                <tr>
                    <td><strong>Nama Siswa</strong></td>
                    <td>: {{ $student->name }}</td>
                </tr>
                @php
    $kelas = $student->kelas->first(); // ambil kelas pertama yang dimiliki siswa
@endphp

<tr>
    <td>Pilihan Paket</td>
    <td>: {{ $kelas ? $kelas->grade : '-' }}</td>
</tr>
<tr>
    <td>Kelas</td>
    <td>: {{ $kelas ? $kelas->name : '-' }}</td>
</tr>

                </tr>
                <tr>
                    <td><strong>Jumlah Pertemuan</strong></td>
                    <td>: {{ $reports->count() }}</td>
                </tr>
            </table>
        </div>

        <div class="thanks">
            Terima kasih telah mengikuti program pembelajaran di PKBM Academia dengan baik dan penuh semangat. Kami berharap pengalaman belajar ini bermanfaat dan menjadi bekal yang berharga dalam perjalanan pendidikan selanjutnya.
        </div>
        <div class="tehk">
Berikut terlampir nilai raport berdasarkan pertemuan:         </div>
        <table class="report-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran - Guru</th>
                    <th>Pertemuan</th>
                    <th>Nilai</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $index => $report)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $report->subject->name }} - {{ $report->subject->user->name }}</td>
                        <td>{{ $report->meeting_title }}</td>
                        <td>{{ $report->score }}</td>
                        <td style="text-align: left;">{{ $report->feedback }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <div class="ttd">
                <p>Bogor, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Ketua PKBM Academia</p>
                <br><br><br>
                <p><strong><u> Ketua PKBM</u></strong></p>
            </div>
        </div>

    </div>
</body>
</html>
