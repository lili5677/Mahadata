<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MahasiswaController extends Controller
{
    //HOME daftar (NIM descending), pencarian, total, statistik gender.
    public function home(Request $request)
    {
        $kata = $request->query('q');

        return view('home', [
            'mahasiswa' => Mahasiswa::cari($kata)->orderByDesc('nim')->get(),
            'kata'      => $kata,
            'total'     => Mahasiswa::count(),   // total semua data, tidak ikut terfilter
            'rekap'     => Mahasiswa::rekapGender(),
        ]);
    }

    /** ADMIN: daftar data. */
    public function index()
    {
        return view('admin', ['mahasiswa' => Mahasiswa::orderByDesc('nim')->get()]);
    }

    /** Form tambah. */
    public function create()
    {
        return view('form', ['mahasiswa' => new Mahasiswa()]);
    }

    /** Simpan data baru. */
    public function store(Request $request)
    {
        $data = $request->validate($this->aturan());
        Mahasiswa::create($data);
        $this->catat('tambah', $data['nim']);

        return redirect()->route('admin.index')->with('sukses', 'Data berhasil ditambahkan.');
    }

    /** Form edit. */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('form', compact('mahasiswa'));
    }

    /** Simpan perubahan. NIM tidak masuk aturan edit, sehingga tidak pernah berubah. */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update($request->validate($this->aturan($mahasiswa)));
        $this->catat('ubah', $mahasiswa->nim);

        return redirect()->route('admin.index')->with('sukses', 'Data berhasil diubah.');
    }

    /** Hapus data. */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        $this->catat('hapus', $mahasiswa->nim);

        return redirect()->route('admin.index')->with('sukses', 'Data berhasil dihapus.');
    }

    /**
     * FUNGSI: aturan validasi. Jika $mahasiswa diisi (mode edit), NIM tidak divalidasi.
     */
    private function aturan(?Mahasiswa $mahasiswa = null): array //
    {
        $aturan = [
            'nama'          => ['required', 'string', 'max:100'],
            'alamat'        => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'gender'        => ['required', 'in:L,P'],
        ];

        if ($mahasiswa === null) {
            $aturan['nim'] = ['required', 'regex:/^[A-Za-z0-9]{7,15}$/', 'unique:mahasiswa,nim'];
        }

        return $aturan;
    }

    /** PROSEDUR: mencatat aktivitas ke storage/logs/laravel.log (tanpa nilai kembali). */
    private function catat(string $aksi, string $nim): void
    {
        Log::info('Data mahasiswa ' . $aksi . ': NIM ' . $nim);
    }
}