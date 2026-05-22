<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tambah Akun Baru') }}</h2>
    </x-slot>

    <!-- Pastikan x-data role diatur di sini -->
    <div class="py-12" x-data="{ role: '{{ old('role', 'magang') }}' }">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-8 border border-gray-100">
                
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <!-- 1. Pilih Role (PENTING: x-model harus 'role') -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Peran Akun</label>
                        <select name="role" x-model="role" class="w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                            <option value="magang">Anak Magang</option>
                            <option value="mentor">Mentor</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <!-- 2. Dropdown Data Magang (Muncul jika role === 'magang') -->
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-100" x-show="role === 'magang'">
                        <label class="block text-sm font-bold text-blue-800 mb-2">Pilih Calon Anak Magang</label>
                        <select name="data_magang_id" class="w-full rounded-md border-gray-300">
                            <option value="">-- Cari Nama Anak Magang --</option>
                            @foreach ($pendingInterns as $intern)
                                <option value="{{ $intern->id }}" {{ old('data_magang_id') == $intern->id ? 'selected' : '' }}>
                                    {{ $intern->nama }} ({{ $intern->nim_nisn }})
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-blue-600 mt-2 italic">*Hanya menampilkan data yang belum memiliki akun.</p>
                    </div>

                    <!-- 3. Dropdown Data Mentor (Muncul jika role === 'mentor') -->
                    <!-- Bagian ini yang sering bermasalah, pastikan menggunakan $pendingMentors -->
                    <div class="mb-6 p-4 bg-indigo-50 rounded-lg border border-indigo-100" x-show="role === 'mentor'">
                        <label class="block text-sm font-bold text-indigo-800 mb-2">Pilih Calon Mentor (Data dari Tabel Mentor)</label>
                        <select name="data_mentor_id" class="w-full rounded-md border-gray-300">
                            <option value="">-- Pilih Nama Mentor --</option>
                            @foreach ($pendingMentors as $mentor)
                                <option value="{{ $mentor->id }}" {{ old('data_mentor_id') == $mentor->id ? 'selected' : '' }}>
                                    {{ $mentor->nama }} - ({{ $mentor->bidang }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 4. Input Manual (Muncul jika role === 'admin') -->
                    <div x-show="role === 'admin'" class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Nama Lengkap Admin</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">NIP/Nomor Induk</label>
                            <input type="text" name="nomor_induk" value="{{ old('nomor_induk') }}" class="w-full rounded-md border-gray-300">
                        </div>
                    </div>

                    <!-- 5. Email & Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700">Email Login</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Password</label>
                            <input type="password" name="password" required class="w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required class="w-full rounded-md border-gray-300">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t pt-6">
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md font-bold hover:bg-indigo-700 transition">
                            Buat Akun Sekarang
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>