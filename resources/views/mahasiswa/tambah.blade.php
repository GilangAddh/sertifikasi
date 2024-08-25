<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa dan KRS</title>
</head>

<body>
    <h1>Tambah Mahasiswa dan KRS</h1>

    <!-- Form untuk menambahkan mahasiswa dan KRS -->
    <form method="POST" action="{{ route('store') }}">
        @csrf
        <div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div>
            <label for="program_studi">Program Studi:</label>
            <select id="id_ps" name="id_ps" required>
                <option value="1">Teknik Informatika</option>
                <option value="2">Teknik Jaringan</option>
                <option value="3">Teknik Multimedia</option>
            </select>
        </div>
        <div>
            <label for="semester">Semester:</label>
            <input type="number" id="semester" name="semester" required>
        </div>
        <div>
            <label for="tahun_ajar">Tahun Ajar:</label>
            <input type="text" id="tahun_ajar" name="tahun_ajar" required>
        </div>
        <button type="submit">Tambah</button>
    </form>
</body>

</html>
