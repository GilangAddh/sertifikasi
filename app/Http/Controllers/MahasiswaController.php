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
            'program_studi' => 'required|string|max:50',
            'semester' => 'required|integer',
            'tahun_ajar' => 'required|string|max:10',
        ]);

        DB::statement('CALL TambahMahasiswaDanKRS(?, ?, ?, ?, ?)', [
            $request->input('nama'),
            $request->input('npm'),
            $request->input('program_studi'),
            $request->input('semester'),
            $request->input('tahun_ajar'),
        ]);

        return redirect('/mahasiswa');
    }
}
