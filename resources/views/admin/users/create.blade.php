<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.users.index') }}" class="p-2 bg-white text-slate-600 hover:text-indigo-600 rounded-xl border border-slate-200/70 shadow-sm transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Tambah Akun Baru') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Dafrarkan hak akses baru untuk pengguna ke dalam ekosistem portal.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ role: '{{ old('role', 'magang') }}' }">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl p-6 sm:p-8 border border-slate-100">

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pilih Peran Akun</label>
                        <div class="relative">
                            <select name="role" x-model="role" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-800 shadow-inner focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer appearance-none">
                                <option value="magang">Anak Magang</option>
                                <option value="mentor">Mentor</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6 p-5 bg-gradient-to-r from-blue-50/60 to-indigo-50/40 rounded-2xl border border-blue-100/70"
                         x-show="role === 'magang'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-1.5 h-4 bg-blue-500 rounded-full"></div>
                            <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">Pilih Calon Anak Magang</label>
                        </div>
                        <select name="data_magang_id" class="w-full rounded-xl border-slate-200 text-sm text-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200">
                            <option value="">-- Cari Nama Anak Magang --</option>
                            @foreach ($pendingInterns as $intern)
                                <option value="{{ $intern->id }}" {{ old('data_magang_id') == $intern->id ? 'selected' : '' }}>
                                    {{ $intern->nama }} ({{ $intern->nim_nisn }})
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[11px] text-blue-600/80 mt-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            *Hanya menampilkan data peserta magang resmi yang belum memiliki kredensial akun login.
                        </p>
                    </div>

                    <div class="mb-6 p-5 bg-gradient-to-r from-indigo-50/60 to-purple-50/40 rounded-2xl border border-indigo-100/70"
                         x-show="role === 'mentor'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-1.5 h-4 bg-indigo-500 rounded-full"></div>
                            <label class="block text-xs font-bold text-indigo-900 uppercase tracking-wider">Pilih Calon Mentor (Data dari Tabel Mentor)</label>
                        </div>
                        <select name="data_mentor_id" class="w-full rounded-xl border-slate-200 text-sm text-slate-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                            <option value="">-- Pilih Nama Mentor --</option>
                            @foreach ($pendingMentors as $mentor)
                                <option value="{{ $mentor->id }}" {{ old('data_mentor_id') == $mentor->id ? 'selected' : '' }}>
                                    {{ $mentor->nama }} - ({{ $mentor->bidang }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="role === 'admin'"
                         class="space-y-4 mb-6"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap Admin</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Admin Utama" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">NIP/Nomor Induk</label>
                            <input type="text" name="nomor_induk" value="{{ old('nomor_induk') }}" placeholder="Contoh: ADM-2026-01" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                        </div>
                    </div>

                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-start">
                            <span class="bg-white pr-3 text-xs font-bold uppercase tracking-widest text-slate-400">Kredensial Login</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Login</label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="user@example.com" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Password</label>
                            <input type="password" name="password" required placeholder="••••••••" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required placeholder="••••••••" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                        </div>
                    </div>

                    <div class="flex justify-end items-center gap-4 border-t border-slate-100 pt-6">
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors duration-150">
                            Batal
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-indigo-700 active:scale-[0.98] transition-all duration-200 shadow-md shadow-indigo-100 hover:shadow-lg">
                            Buat Akun Sekarang
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
