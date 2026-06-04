<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // API: Mengambil Detail Magang
    public function getDetailMagang(Request $request)
    {
        $user = $request->user();

        // 1. Cari data magangnya dulu
        $dataMagang = DB::table('data_anak_magang')
                        ->where('nama', $user->name)
                        ->first();

        if ($dataMagang) {
            // 2. Cari nama mentornya di tabel data_mentor berdasarkan mentor_id
            $namaMentor = 'Belum ada mentor'; // Default text

            if ($dataMagang->mentor_id) {
                $mentor = DB::table('data_mentor')
                            ->where('id', $dataMagang->mentor_id)
                            ->first();

                // Mengambil kolom 'nama' dari tabel data_mentor
                if ($mentor) {
                    $namaMentor = $mentor->nama;
                }
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'instansi' => $dataMagang->instansi,
                    'tanggal_mulai_magang' => $dataMagang->tanggal_mulai_magang,
                    'tanggal_selesai_magang' => $dataMagang->tanggal_selesai_magang,
                    'nama_mentor' => $namaMentor, // 🔥 Kita ganti jadi ngirim nama aslinya
                ]
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data detail magang belum tersedia.',
            'data' => null
        ], 404);
    }

    // API: Update Nama & Email
    // API: Update Nama & Email
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$request->user()->id],
        ]);

        $user = $request->user();

        // 🔥 1. Simpan nama lama SEBELUM diubah
        $namaLama = $user->name;

        $user->fill($request->only('name', 'email'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // 🔥 2. Update juga nama di tabel data_anak_magang agar sinkron!!
        DB::table('data_anak_magang')
            ->where('nama', $namaLama)
            ->update(['nama' => $user->name]);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'user' => $user
        ]);
    }

    // API: Update Password
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diperbarui'
        ]);
    }
}
