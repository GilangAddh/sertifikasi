<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $totalSKS = null;
        if ($request->has('npm')) {
            $npm = $request->input('npm');
            $totalSKS = FacadesDB::select('SELECT HitungTotalSKS(?) AS total_sks', [$npm])[0]->total_sks;
        }

        $mahasiswa = Mahasiswa::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->get();

        $krs = KRS::all();

        return view('mahasiswa.index', [
            'mahasiswa' => $mahasiswa,
            'search' => $search,
            'totalSKS' => $totalSKS,
            'krs' => $krs
        ]);
    }

    public function tambahMhKRS()
    {
        return view('mahasiswa.tambah');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:100',
            'id_ps' => 'required',
            'semester' => 'required|integer',
            'tahun_ajar' => 'required|string|max:10',
        ]);

        DB::statement('CALL TambahMahasiswaDanKRS(?, ?, ?, ?, ?)', [
            $request->input('nama'),
            $request->input('npm'),
            $request->input('id_ps'),
            $request->input('semester'),
            $request->input('tahun_ajar'),
        ]);

        return redirect('/mahasiswa');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', ['mahasiswa' => $mahasiswa]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:100',
            'npm' => 'required|string|max:20',
            'program_studi' => 'required|string|max:50',
        ]);

        // Mengupdate data mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'program_studi' => $request->input('program_studi'),
        ]);

        // Mengarahkan kembali ke halaman daftar mahasiswa dengan pesan sukses
        return redirect('/mahasiswa');
    }

    public function destroy($id)
    {
        $krsCount = DB::table('krs')->where('id_mahasiswa', $id)->count();

        if ($krsCount > 0) {
            return redirect('/mahasiswa')->with('error', 'Data mahasiswa tidak dapat dihapus karena ada data terkait di KRS.');
        }

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect('/mahasiswa');
    }
}
