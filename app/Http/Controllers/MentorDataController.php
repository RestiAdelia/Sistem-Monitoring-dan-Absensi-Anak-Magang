<?php

namespace App\Http\Controllers;

use App\Models\DataMentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MentorDataController extends Controller
{

    /**
     * Halaman list data mentor
     */
    public function index()
    {
        // Menggunakan paginate(10) agar data tidak menumpuk
        $mentors = DataMentor::orderBy('nama')->paginate(10);
        return view('admin.data-mentor.index', compact('mentors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'jk' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = $request->hasFile('foto') ? $request->file('foto')->store('mentor_photos', 'public') : null;

        DataMentor::create([
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'jk' => $request->jk,
            'status' => $request->status,
            'foto' => $fotoPath,
            'status_akun' => 'Belum Dibuat',
        ]);

        return redirect()->route('admin.data-mentor.index')->with('success', 'Mentor berhasil ditambahkan.');
    }

    public function update(Request $request, DataMentor $data_mentor)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'jk' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama', 'bidang', 'no_hp', 'email', 'jk', 'status']);

        if ($request->hasFile('foto')) {
            if ($data_mentor->foto) Storage::disk('public')->delete($data_mentor->foto);
            $data['foto'] = $request->file('foto')->store('mentor_photos', 'public');
        }

        $data_mentor->update($data);

        return redirect()->route('admin.data-mentor.index')->with('success', 'Data berhasil diperbarui.');
    }
    /**
     * Hapus data mentor
     */
    public function destroy(DataMentor $data_mentor)
    {
        // Cek apakah sudah ada akun user
        if ($data_mentor->status_akun === 'Aktif') {
            return back()->with('error', 'Data mentor tidak bisa dihapus karena akun user sudah aktif. Hapus akun user terlebih dahulu.');
        }

        $data_mentor->delete();
        return redirect()->route('admin.data-mentor.index')->with('success', 'Data mentor berhasil dihapus.');
    }
    public function show(DataMentor $data_mentor)
    {
        return view('admin.data-mentor.show', compact('data_mentor'));
    }

}
