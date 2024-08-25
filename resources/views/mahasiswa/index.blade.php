<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <div style="display: flex">
        <div style="margin-right: 20px">
            <h1>Daftar Mahasiswa</h1>
            <form method="GET" action="{{ url('/mahasiswa') }}">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama...">
                <button type="submit">Cari</button>
            </form>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Program Studi</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->npm }}</td>
                            <td>{{ $item->programStudi->nama }}</td>
                            <td><a href="{{ route('edit', ['id' => $item->id]) }}">Edit</a></td>
                            <td>
                                <form action="{{ route('destroy', ['id' => $item->id]) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <form method="GET" action="{{ url('/mahasiswa') }}">
                <input type="text" name="npm" placeholder="Masukkan NPM">
                <button type="submit">Hitung Total SKS</button>
            </form>
            @if ($totalSKS !== null)
                <h2>Total SKS untuk NPM {{ request('npm') }}: {{ $totalSKS }}</h2>
            @endif
        </div>
        <div>
            <h1>Daftar KRS Mahasiswa</h1>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tahun Ajar</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($krs as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>{{ $item->tahun_ajar }}</td>
                            <td>{{ $item->semester }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div>
        <a href="{{ route('tambahMhKRS') }}">Tambah Mahasiswa Berserta KRS nya</a>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('error'))
            alert('{{ session('error') }}');
        @endif
    });
</script>

</html>
