<?php

namespace App\Http\Controllers;

use App\Models\DataAnakMagang;
use App\Models\DataMentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of mentors and interns.
     */
    // public function index()
    // {
    //       $mentors = DataMentor::orderBy('nama')->get();
    //     return view('admin.data-mentor.index', compact('mentors'));
    //     // $mentors = User::where('role', 'mentor')->get();
    //     // $interns = User::where('role', 'magang')->with(['mentor', 'dataMagang'])->get();

    //     // return view('admin.users.index', compact('mentors', 'interns'));
    // }
    public function index()
    {
        // Mengambil user dengan role mentor
        $mentorAccounts = User::where('role', 'mentor')->orderBy('name')->get();

        // Mengambil user dengan role magang beserta relasi mentor dan dataMagang-nya
        $magangAccounts = User::where('role', 'magang')
            ->with(['mentor', 'dataMagang'])
            ->orderBy('name')
            ->get();

        return view('admin.users.index', compact('mentorAccounts', 'magangAccounts'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(Request $request)
    {
        $mentors = User::where('role', 'mentor')->get();
        $pendingInterns = DataAnakMagang::where('status_akun', 'Belum Dibuat')->orderBy('nama')->get();
        $pendingMentors = DataMentor::where('status_akun', 'Belum Dibuat')->orderBy('nama')->get();
        $selectedIntern = null;
        $selectedMentor = null;
        $selectedInternId = $request->query('data_magang_id') ?: $request->old('data_magang_id');
        $selectedMentorId = $request->query('data_mentor_id') ?: $request->old('data_mentor_id');

        if ($request->query('role') === 'magang' && $selectedInternId) {
            $selectedIntern = $pendingInterns->firstWhere('id', $selectedInternId);
        } elseif ($request->query('role') === 'mentor' && $selectedMentorId) {
            $selectedMentor = $pendingMentors->firstWhere('id', $selectedMentorId);
        }

        return view('admin.users.create', compact('mentors', 'pendingInterns', 'pendingMentors', 'selectedIntern', 'selectedMentor'));
    }

    /**
     * Store a newly created user in storage.
     */
    // public function store(Request $request)
    // {
    //     $rules = [
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'role' => ['required', Rule::in(['admin', 'mentor', 'magang'])],
    //     ];

    //     if ($request->input('role') === 'magang') {
    //         $rules['data_magang_id'] = [
    //             'required',
    //             'integer',
    //             Rule::exists('data_anak_magang', 'id')->where('status_akun', 'Belum Dibuat'),
    //         ];
    //     } elseif ($request->input('role') === 'mentor') {
    //         $rules['data_mentor_id'] = [
    //             'required',
    //             'integer',
    //             Rule::exists('data_mentor', 'id')->where('status_akun', 'Belum Dibuat'),
    //         ];
    //     } else {
    //         $rules['name'] = ['required', 'string', 'max:255'];
    //         $rules['nomor_induk'] = ['required', 'string', 'max:50'];
    //     }

    //     $validated = $request->validate($rules);

    //     if ($validated['role'] === 'magang') {
    //         $internData = DataAnakMagang::findOrFail($validated['data_magang_id']);

    //         User::create([
    //             'name' => $internData->nama,
    //             'email' => $validated['email'],
    //             'password' => Hash::make($validated['password']),
    //             'role' => 'magang',
    //             'nomor_induk' => $internData->nim_nisn,
    //             'mentor_id' => $internData->mentor_id,
    //             'data_magang_id' => $internData->id,
    //             'is_active' => true,
    //         ]);

    //         $internData->update(['status_akun' => 'Aktif']);
    //     } elseif ($validated['role'] === 'mentor') {
    //         $mentorData = DataMentor::findOrFail($validated['data_mentor_id']);

    //         User::create([
    //             'name' => $mentorData->nama,
    //             'email' => $validated['email'],
    //             'password' => Hash::make($validated['password']),
    //             'role' => 'mentor',
    //             'nomor_induk' => $mentorData->nomor_induk,
    //             'data_mentor_id' => $mentorData->id,
    //             'is_active' => true,
    //         ]);

    //         $mentorData->update(['status_akun' => 'Aktif']);
    //     } else {
    //         User::create([
    //             'name' => $validated['name'],
    //             'email' => $validated['email'],
    //             'password' => Hash::make($validated['password']),
    //             'role' => $validated['role'],
    //             'nomor_induk' => $validated['nomor_induk'],
    //             'is_active' => true,
    //         ]);
    //     }

    //     return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    // }
    // public function store(Request $request)
    // {
    //     // 1. Validasi Dasar
    //     $rules = [
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'role' => ['required', Rule::in(['admin', 'mentor', 'magang'])],
    //     ];

    //     // 2. Validasi Khusus berdasarkan Role
    //     if ($request->input('role') === 'magang') {
    //         $rules['data_magang_id'] = [
    //             'required',
    //             Rule::exists('data_anak_magang', 'id')->where('status_akun', 'Belum Dibuat'),
    //         ];
    //     } elseif ($request->input('role') === 'mentor') {
    //         $rules['data_mentor_id'] = [
    //             'required',
    //             Rule::exists('data_mentor', 'id')->where('status_akun', 'Belum Dibuat'),
    //         ];
    //     } else {
    //         // Jika Admin, input manual diperbolehkan
    //         $rules['name'] = ['required', 'string', 'max:255'];
    //         $rules['nomor_induk'] = ['required', 'string', 'max:50'];
    //     }

    //     $validated = $request->validate($rules);

    //     // 3. Proses Penyimpanan
    //     if ($validated['role'] === 'magang') {
    //         $data = \App\Models\DataAnakMagang::findOrFail($validated['data_magang_id']);

    //         User::create([
    //             'name' => $data->nama,
    //             'email' => $validated['email'],
    //             'password' => Hash::make($validated['password']),
    //             'role' => 'magang',
    //             'nomor_induk' => $data->nim_nisn,
    //             'mentor_id' => $data->mentor_id,
    //             'data_magang_id' => $data->id,
    //             'is_active' => true,
    //         ]);
    //         $data->update(['status_akun' => 'Aktif']);
    //     } elseif ($validated['role'] === 'mentor') {
    //         $data = \App\Models\DataMentor::findOrFail($validated['data_mentor_id']);

    //         User::create([
    //             'name' => $data->nama,
    //             'email' => $validated['email'],
    //             'password' => Hash::make($validated['password']),
    //             'role' => 'mentor',
    //             'nomor_induk' => $data->nomor_induk ?? 'MTR-' . rand(100, 999), // Contoh generate jika kosong
    //             'data_mentor_id' => $data->id,
    //             'is_active' => true,
    //         ]);
    //         $data->update(['status_akun' => 'Aktif']);
    //     } else {
    //         // Role Admin
    //         User::create([
    //             'name' => $validated['name'],
    //             'email' => $validated['email'],
    //             'password' => Hash::make($validated['password']),
    //             'role' => 'admin',
    //             'nomor_induk' => $validated['nomor_induk'],
    //             'is_active' => true,
    //         ]);
    //     }

    //     return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dibuat.');
    // }
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:admin,mentor,magang',

            // data_magang_id WAJIB jika role adalah magang, dan harus ada di tabel data_anak_magang
            'data_magang_id' => 'required_if:role,magang|nullable|exists:data_anak_magang,id',

            // data_mentor_id WAJIB jika role adalah mentor, dan harus ada di tabel data_mentor
            'data_mentor_id' => 'required_if:role,mentor|nullable|exists:data_mentor,id',

            // name & nomor_induk WAJIB hanya jika role adalah admin (karena mentor/magang ambil dari database)
            'name' => 'required_if:role,admin|nullable|string|max:255',
            'nomor_induk' => 'required_if:role,admin|nullable|string|max:50',
        ]);

        try {
            // 2. Logika Sesuai Role
            if ($request->role === 'mentor') {
                // Ambil data dari tabel data_mentor
                $mentorData = \App\Models\DataMentor::findOrFail($request->data_mentor_id);

                User::create([
                    'name' => $mentorData->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'mentor',
                    'nomor_induk' => $mentorData->nomor_induk ?? 'MTR-' . rand(1000, 9999),
                    'data_mentor_id' => $mentorData->id,
                    'is_active' => true,
                ]);

                // Update status di tabel asal
                $mentorData->update(['status_akun' => 'Aktif']);
            } elseif ($request->role === 'magang') {
                // Ambil data dari tabel data_anak_magang
                $internData = \App\Models\DataAnakMagang::findOrFail($request->data_magang_id);

                User::create([
                    'name' => $internData->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'magang',
                    'nomor_induk' => $internData->nim_nisn,
                    'data_magang_id' => $internData->id,
                    'mentor_id' => $internData->mentor_id, // Hubungkan langsung dengan mentor jika sudah diplot
                    'is_active' => true,
                ]);

                // Update status di tabel asal
                $internData->update(['status_akun' => 'Aktif']);
            } else {
                // Role Admin (Input Manual)
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'admin',
                    'nomor_induk' => $request->nomor_induk,
                    'is_active' => true,
                ]);
            }

            return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dibuat dan diaktifkan.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $mentors = User::where('role', 'mentor')->get();
        return view('admin.users.edit', compact('user', 'mentors'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'mentor', 'magang'])],
            'nomor_induk' => ['required', 'string', 'max:50'],
            'instansi' => ['nullable', 'string', 'max:255'],
            'mentor_id' => [
                'nullable',
                Rule::requiredIf($request->role === 'magang'),
                'exists:users,id'
            ],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    /**
     * Update the mentor assignment for an intern.
     */
    public function assignMentor(Request $request, User $intern)
    {
        $validated = $request->validate([
            'mentor_id' => ['nullable', 'exists:users,id'],
        ]);

        if ($validated['mentor_id']) {
            $mentor = User::find($validated['mentor_id']);
            if ($mentor->role !== 'mentor') {
                return back()->withErrors(['mentor_id' => 'User yang dipilih bukan mentor.']);
            }
        }

        $intern->update(['mentor_id' => $validated['mentor_id']]);

        return redirect()->route('admin.users.index')->with('success', 'Mentor berhasil diplot ke anak magang.');
    }

    /**
     * Toggle active/inactive status for a user.
     */
    public function toggleStatus(User $user)
    {
        $user->update([
            'is_active' => !$user->is_active
        ]);

        $statusText = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.users.index')->with('success', "Akun {$user->name} berhasil {$statusText}.");
    }
}
