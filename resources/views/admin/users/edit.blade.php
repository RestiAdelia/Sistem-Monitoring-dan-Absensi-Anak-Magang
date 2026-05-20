<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 p-8">
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Edit Data Pengguna</h3>
                    <p class="text-sm text-gray-500">Perbarui data untuk akun {{ $user->name }}.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" x-data="{ role: '{{ old('role', $user->role) }}' }">
                    @csrf
                    @method('PUT')

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">Peran / Role</label>
                        <select name="role" id="role" x-model="role" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="magang">Anak Magang (magang)</option>
                            <option value="mentor">Mentor (mentor)</option>
                            <option value="admin">Administrator (admin)</option>
                        </select>
                    </div>

                    <!-- Nomor Induk -->
                    <div class="mb-4">
                        <label for="nomor_induk" class="block text-sm font-semibold text-gray-700 mb-1">Nomor Induk (NIM/NIP)</label>
                        <input type="text" name="nomor_induk" id="nomor_induk" value="{{ old('nomor_induk', $user->nomor_induk) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <!-- Magang-specific: Instansi -->
                    <div class="mb-4" x-show="role === 'magang'">
                        <label for="instansi" class="block text-sm font-semibold text-gray-700 mb-1">Asal Instansi / Universitas</label>
                        <input type="text" name="instansi" id="instansi" value="{{ old('instansi', $user->instansi) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <!-- Magang-specific: Plotting Mentor -->
                    <div class="mb-4" x-show="role === 'magang'">
                        <label for="mentor_id" class="block text-sm font-semibold text-gray-700 mb-1">Plotting Mentor</label>
                        <select name="mentor_id" id="mentor_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">-- Pilih Mentor --</option>
                            @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}" {{ old('mentor_id', $user->mentor_id) == $mentor->id ? 'selected' : '' }}>
                                    {{ $mentor->name }} ({{ $mentor->nomor_induk }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password Section -->
                    <div class="mt-8 border-t border-gray-150 pt-6">
                        <h4 class="text-sm font-bold text-gray-700 mb-2">Ubah Password (Opsional)</h4>
                        <p class="text-xs text-gray-400 mb-4">Kosongkan kolom di bawah jika tidak ingin mengubah password.</p>
                        
                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password Baru</label>
                            <input type="password" name="password" id="password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <!-- Password Confirmation -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
