<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.data-anak-magang.index') }}" class="p-2 bg-white text-slate-600 hover:text-emerald-600 rounded-xl border border-slate-200/70 shadow-sm transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Edit Data Anak Magang') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Lakukan pembaruan berkas riwayat fisik dan plotting mentor eksternal.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-emerald-500 p-6 sm:p-8">

                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h3 class="text-base font-bold text-slate-800">Form Perubahan Data</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Sesuaikan informasi anak magang. Perubahan pada nama atau NIM akan otomatis memperbarui akun user jika sudah aktif.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200/50 text-rose-800 rounded-xl shadow-sm">
                        <div class="flex items-center space-x-2 mb-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-wider text-rose-900">Terjadi kesalahan input:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-0.5 text-rose-700 pl-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.data-anak-magang.update', $intern->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="nim_nisn" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">NIM / NISN</label>
                                <input type="text" id="nim_nisn" name="nim_nisn"
                                    value="{{ old('nim_nisn', $intern->nim_nisn) }}"
                                    required
                                    class="w-full rounded-xl border-slate-200 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200" />
                            </div>

                            <div>
                                <label for="nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama"
                                    value="{{ old('nama', $intern->nama) }}"
                                    required
                                    class="w-full rounded-xl border-slate-200 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200" />
                            </div>
                        </div>

                        <div>
                            <label for="instansi" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Asal Universitas / Instansi</label>
                            <input type="text" id="instansi" name="instansi"
                                value="{{ old('instansi', $intern->instansi) }}"
                                required
                                class="w-full rounded-xl border-slate-200 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 p-4 bg-slate-50 rounded-2xl border border-slate-200/60">
                            <div>
                                <label for="tanggal_mulai_magang" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai_magang" name="tanggal_mulai_magang"
                                    value="{{ old('tanggal_mulai_magang', $intern->tanggal_mulai_magang ? \Carbon\Carbon::parse($intern->tanggal_mulai_magang)->format('Y-m-d') : '') }}"
                                    required
                                    class="w-full rounded-xl border-slate-200 text-sm text-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 cursor-pointer" />
                            </div>

                            <div>
                                <label for="tanggal_selesai_magang" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">Tanggal Selesai</label>
                                <input type="date" id="tanggal_selesai_magang" name="tanggal_selesai_magang"
                                    value="{{ old('tanggal_selesai_magang', $intern->tanggal_selesai_magang ? \Carbon\Carbon::parse($intern->tanggal_selesai_magang)->format('Y-m-d') : '') }}"
                                    required
                                    class="w-full rounded-xl border-slate-200 text-sm text-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 cursor-pointer" />
                            </div>
                        </div>

                        <div>
                            <label for="mentor_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Mentor Pendamping</label>
                            <select id="mentor_id" name="mentor_id" required
                                class="w-full rounded-xl border-slate-200 text-sm text-slate-800 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 cursor-pointer">
                                <option value="">-- Pilih Mentor Lapangan --</option>
                                @foreach($mentors as $mentor)
                                    <option value="{{ $mentor->id }}" {{ old('mentor_id', $intern->mentor_id) == $mentor->id ? 'selected' : '' }}>
                                        {{ $mentor->name }} ({{ $mentor->nomor_induk }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-[11px] text-slate-400 italic">*Pilihan personil mentor disaring eksklusif dari daftar pengguna bersistem hak akses 'mentor'.</p>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-slate-100 pt-5">
                        <a href="{{ route('admin.data-anak-magang.index') }}"
                            class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors duration-150">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-emerald-700 active:scale-[0.98] transition-all duration-200 shadow-md shadow-emerald-100 hover:shadow-lg">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-6 p-4 rounded-2xl bg-gradient-to-r from-indigo-50/70 to-blue-50/50 border border-indigo-100/70 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shadow-sm shadow-indigo-50/20">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-indigo-600 rounded-xl text-white shadow-md shadow-indigo-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-indigo-950 uppercase tracking-wide">Status Kredensial Akun:</p>
                        <span class="inline-flex items-center text-xs font-black {{ $intern->status_akun === 'Aktif' ? 'text-emerald-600' : 'text-amber-600' }} tracking-wide mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full {{ $intern->status_akun === 'Aktif' ? 'bg-emerald-500' : 'bg-amber-500' }} mr-1.5 animate-pulse"></span>
                            AKUN {{ $intern->status_akun }}
                        </span>
                    </div>
                </div>
                @if($intern->status_akun === 'Belum Dibuat')
                    <a href="{{ route('admin.users.create') }}?role=magang&data_magang_id={{ $intern->id }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 hover:underline flex items-center transition-colors">
                        Buat akses akun login sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
