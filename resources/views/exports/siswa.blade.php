<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Kehadiran</th>
            <th>Waktu Kehadiran</th>
            <th>Kelas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($siswa as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->absensi->first()->status ?? 'Belum ada data' }}</td>
                <td>{{ $item->absensi->first()->tanggal_absen ?? 'Belum ada data' }}</td>
                <td>{{ $kelas->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
