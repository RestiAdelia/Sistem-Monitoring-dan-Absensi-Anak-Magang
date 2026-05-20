<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of mentors and interns.
     */
    public function index()
    {
        $mentors = User::where('role', 'mentor')->get();
        $interns = User::where('role', 'magang')->with('mentor')->get();

        return view('admin.users.index', compact('mentors', 'interns'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $mentors = User::where('role', 'mentor')->get();
        return view('admin.users.create', compact('mentors'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'mentor', 'magang'])],
            'nomor_induk' => ['required', 'string', 'max:50'],
            'instansi' => ['nullable', 'string', 'max:255'],
            'mentor_id' => [
                'nullable',
                Rule::requiredIf($request->role === 'magang'),
                'exists:users,id'
            ],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
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
