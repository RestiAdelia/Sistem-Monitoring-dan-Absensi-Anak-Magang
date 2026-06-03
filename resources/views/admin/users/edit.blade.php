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
                    {{ __('Ubah Pengguna') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Modifikasi hak akses kontrol kredensial pengguna portal magang.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 p-6 sm:p-8">

                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h3 class="text-base font-bold text-slate-800">Edit Data Pengguna</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Perbarui berkas data otentikasi untuk akun: <span class="font-semibold text-indigo-600">{{ $user->name }}</span></p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-xl shadow-sm">
                        <div class="flex items-center space-x-2 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-wider text-rose-900">Periksa Kembali Input Anda:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-0.5 text-rose-700 pl-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" x-data="{ role: '{{ old('role', $user->role) }}' }">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="role" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Peran / Role</label>
                        <select name="role" id="role" x-model="role" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer">
                            <option value="magang">Anak Magang</option>
                            <option value="mentor">Mentor</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="nomor_induk" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Induk (NIM/NIP)</label>
                        <input type="text" name="nomor_induk" id="nomor_induk" value="{{ old('nomor_induk', $user->nomor_induk) }}" required class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                    </div>

                    <div class="mb-5">
                        <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Sistem</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                    </div>

                    <div class="mb-5 p-5 bg-gradient-to-r from-blue-50/60 to-indigo-50/40 rounded-2xl border border-blue-100/70"
                         x-show="role === 'magang'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-1.5 h-4 bg-blue-500 rounded-full"></div>
                            <label for="mentor_id" class="block text-xs font-bold text-blue-900 uppercase tracking-wider">Plotting Mentor Pendamping</label>
                        </div>
                        <select name="mentor_id" id="mentor_id" class="w-full rounded-xl border-slate-200 text-sm text-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200">
                            <option value="">-- Pilih Mentor --</option>
                            @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}" {{ old('mentor_id', $user->mentor_id) == $mentor->id ? 'selected' : '' }}>
                                    {{ $mentor->name }} ({{ $mentor->nomor_induk }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-start">
                            <span class="bg-white pr-3 text-xs font-bold uppercase tracking-widest text-slate-400">Keamanan Akun</span>
                        </div>
                    </div>

                    <div class="p-5 bg-slate-50/80 border border-slate-200/60 rounded-2xl space-y-4 mb-6">
                        <div>
                            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Ubah Password (Opsional)</h4>
                            <p class="text-[11px] text-slate-400 mt-0.5">*Biarkan kolom di bawah kosong jika Anda tidak berencana mengganti kata sandi akun.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">Password Baru</label>
                                <input type="password" name="password" id="password" placeholder="••••••••" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-3 border-t border-slate-100 pt-5">
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors duration-150">
                            Batal
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-indigo-700 active:scale-[0.98] transition-all duration-200 shadow-md shadow-indigo-100 hover:shadow-lg">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
