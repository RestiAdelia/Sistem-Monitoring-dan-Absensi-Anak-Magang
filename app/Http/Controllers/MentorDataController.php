<?php

namespace App\Http\Controllers;

use App\Models\DataMentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MentorDataController extends Controller
{

    /**
     * Halaman list data mentor
     */

    public function index()
    {
        $mentors = DataMentor::orderBy('nama')->get();
        return view('admin.data-mentor.index', compact('mentors'));
    }
    /**
     * menapilkan form tambbah mentor 
     */

    public function create()
    {
        return view('admin.data-mentor.create');
    }
    /**
     * Store data mentor baru ke database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'nama' => ['required', 'string', 'max:255'],
            'bidang' => ['required', 'string', 'max:255'],
        ]);

        $validator->validate();

        $mentorData = DataMentor::create([
            'nama' => $request->input('nama'),
            'bidang' => $request->input('bidang'),
            'status_akun' => 'Belum Dibuat',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Data mentor berhasil disimpan.',
                'data' => $mentorData,
            ], 201);
        }

        return redirect()->route('admin.data-mentor.index')->with('success', 'Data mentor berhasil disimpan.');
    }
    public function edit(DataMentor $data_mentor)
    {
        return view('admin.data-mentor.edit', compact('data_mentor'));
    }

    /**
     * Update data mentor di database
     */
    public function update(Request $request, DataMentor $data_mentor)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'bidang' => ['required', 'string', 'max:255'],
        ]);

        $data_mentor->update([
            'nama' => $request->nama,
            'bidang' => $request->bidang,
        ]);

        // Opsional: Jika akun user sudah ada, update juga nama di tabel users
        User::where('data_mentor_id', $data_mentor->id)->update([
            'name' => $request->nama
        ]);

        return redirect()->route('admin.data-mentor.index')->with('success', 'Data mentor berhasil diperbarui.');
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
}
