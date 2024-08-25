<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
</head>

<body>
    <h1>Edit Mahasiswa</h1>

    <!-- Form untuk mengedit mahasiswa -->
    <form method="POST" action="{{ route('update', ['id' => $mahasiswa->id]) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="{{ $mahasiswa->nama }}" required>
        </div>
        <div>
            <label for="npm">NPM:</label>
            <input type="text" id="npm" name="npm" value="{{ $mahasiswa->npm }}" required readonly>
        </div>
        <select id="id_ps" name="id_ps">
            <option value="1" {{ $mahasiswa->id_ps == 1 ? 'selected' : '' }}>Teknik Informatika</option>
            <option value="2" {{ $mahasiswa->id_ps == 2 ? 'selected' : '' }}>Teknik Jaringan</option>
            <option value="3" {{ $mahasiswa->id_ps == 3 ? 'selected' : '' }}>Teknik Multimedia</option>
        </select>
        <button type="submit">Update</button>
    </form>

    <!-- Link untuk kembali ke daftar mahasiswa -->
    <a href="{{ url('/mahasiswa') }}">Kembali ke Daftar Mahasiswa</a>
</body>

</html>
