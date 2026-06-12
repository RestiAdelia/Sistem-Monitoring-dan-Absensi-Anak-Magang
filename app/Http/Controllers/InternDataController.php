<?php

namespace App\Http\Controllers;

use App\Models\DataAnakMagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class InternDataController extends Controller
{
    /**
     * Display a listing of interns.
     */
    public function index()
    {
        $interns = DataAnakMagang::with('mentor')
            ->orderByRaw("CASE
            WHEN status_magang = 'Pending' THEN 1
            WHEN status_magang = 'Berjalan' THEN 2
            WHEN status_magang = 'Selesai' THEN 3
            ELSE 4
        END ASC")
            ->orderBy('nama', 'asc')
            ->paginate(10);

        return view('admin.data-anak-magang.index', compact('interns'));
    }

    /**
     * Show the form to register a new intern candidate.
     */
    public function create()
    {
        $mentors = User::where('role', 'mentor')->get();
        return view('admin.data-anak-magang.create', compact('mentors'));
    }

    /**
     * Store a new intern raw data record.
     */

    public function store(Request $request)
    {
        $this->validateIntern($request);

        DataAnakMagang::create([
            'nim_nisn' => $request->nim_nisn,
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'jk' => $request->jk,
            'status_magang' => $request->status_magang ?? 'Berjalan',
            'instansi' => $request->instansi,
            'tanggal_mulai_magang' => $request->tanggal_mulai_magang,
            'tanggal_selesai_magang' => $request->tanggal_selesai_magang,
            'mentor_id' => $request->mentor_id,
            'status_akun' => 'Belum Dibuat',
        ]);

        return redirect()->route('admin.data-anak-magang.index')->with('success', 'Data berhasil disimpan.');
    }

    // Update method update
    public function update(Request $request, $id)
    {
        $intern = DataAnakMagang::findOrFail($id);
        $this->validateIntern($request, $id);

        $intern->update([
            'nim_nisn' => $request->nim_nisn,
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'jk' => $request->jk,
            'status_magang' => $request->status_magang,
            'instansi' => $request->instansi,
            'tanggal_mulai_magang' => $request->tanggal_mulai_magang,
            'tanggal_selesai_magang' => $request->tanggal_selesai_magang,
            'mentor_id' => $request->mentor_id,
        ]);

        return redirect()->route('admin.data-anak-magang.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Show the form for editing the specified intern.
     */
    public function edit($id)
    {
        $intern = DataAnakMagang::findOrFail($id);
        $mentors = User::where('role', 'mentor')->get();
        return view('admin.data-anak-magang.edit', compact('intern', 'mentors'));
    }


    /**
     * Remove the specified intern from storage.
     */
    public function destroy($id)
    {
        $intern = DataAnakMagang::findOrFail($id);

        // Jangan izinkan hapus jika akun user masih aktif
        if ($intern->status_akun === 'Aktif') {
            return back()->with('error', 'Data tidak bisa dihapus karena akun user sudah aktif. Hapus akun user terlebih dahulu di menu Kelola Akun.');
        }

        $intern->delete();
        return redirect()->route('admin.data-anak-magang.index')->with('success', 'Data anak magang berhasil dihapus.');
    }

    /**
     * Reusable validation logic for Store and Update.
     */
    protected function validateIntern(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'nim_nisn' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'bidang' => ['required', 'string', 'max:255'],
            'jk' => ['required', 'in:Laki-laki,Perempuan'],
            'status_magang' => ['required', 'in:Berjalan,Selesai,Diberhentikan'],
            'instansi' => ['required', 'string', 'max:255'],
            'tanggal_mulai_magang' => ['required', 'date'],
            'tanggal_selesai_magang' => ['required', 'date', 'after_or_equal:tanggal_mulai_magang'],
            'mentor_id' => ['required', 'integer', 'exists:users,id'],
        ]);
        $validator->after(function ($validator) use ($request, $id) {
            $instansi = $request->input('instansi');
            $startDate = $request->input('tanggal_mulai_magang');
            $endDate = $request->input('tanggal_selesai_magang');

            // Hitung duplikasi instansi di rentang tanggal yang sama
            $query = DataAnakMagang::where('instansi', $instansi)
                ->where(function ($q) use ($startDate, $endDate) {
                    $q->where('tanggal_mulai_magang', '<=', $endDate)
                        ->where('tanggal_selesai_magang', '>=', $startDate);
                });

            if ($id) {
                $query->where('id', '!=', $id);
            }

            if ($query->count() >= 5) {
                $validator->errors()->add(
                    'instansi',
                    "Kuota untuk instansi $instansi pada periode tersebut sudah mencapai batas maksimal (5 orang)."
                );
            }
        });

        return $validator->validate();
    }

    /**
     * Create a user account for an existing intern raw data record.
     */
    public function createUserAccount(Request $request, $id)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $internData = DataAnakMagang::findOrFail($id);

        $user = DB::transaction(function () use ($internData, $request) {
            $user = User::create([
                'name' => $internData->nama,
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'magang',
                'data_magang_id' => $internData->id,
                'is_active' => true,
            ]);

            $internData->update([
                'status_akun' => 'Aktif',
            ]);

            return $user;
        });

        return response()->json([
            'message' => 'Akun magang berhasil dibuat dan status akun diperbarui.',
            'user' => $user,
        ], 201);
    }
}
