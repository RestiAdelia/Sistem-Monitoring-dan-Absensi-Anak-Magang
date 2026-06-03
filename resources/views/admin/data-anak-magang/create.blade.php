<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <!-- Tombol Kembali Modern -->
            <a href="{{ route('admin.data-anak-magang.index') }}" class="p-2 bg-white text-slate-600 hover:text-emerald-600 rounded-xl border border-slate-200/70 shadow-sm transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Tambah Anak Magang') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Pencatatan data induk fisik peserta magang baru ke dalam pangkalan data.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- BINGKAI UTAMA DENGAN PILAR WARNA EMERALD KHAS DATA MAGANG -->
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-emerald-500 p-6 sm:p-8">

                <!-- Judul Internal Box -->
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h3 class="text-base font-bold text-slate-800">Form Pendaftaran Anak Magang</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Tambah data anak magang yang sudah terdaftar secara resmi untuk dibuatkan akun setelah proses verifikasi.</p>
                </div>

                <!-- Notifikasi Sukses Bawaan Session -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200/50 text-emerald-800 rounded-xl flex items-center space-x-2.5 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Notifikasi Pesan Gagal/Error Validasi -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200/50 text-rose-800 rounded-xl shadow-sm">
                        <div class="flex items-center space-x-2 mb-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-wider text-rose-900">Periksa Kembali Isian Form:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-0.5 text-rose-700 pl-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.data-anak-magang.store') }}" method="POST">
                    @csrf

                    <div class="space-y-5">
                        <!-- Input NIM / NISN -->
                        <div>
                            <label model="nim_nisn" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">NIM / NISN</label>
                            <input id="nim_nisn" name="nim_nisn" value="{{ old('nim_nisn') }}" required placeholder="Contoh: 23110012" class="w-full rounded-xl border-slate-200 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200" />
                        </div>

                        <!-- Input Nama Lengkap -->
                        <div>
                            <label model="nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                            <input id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap peserta" class="w-full rounded-xl border-slate-200 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200" />
                        </div>

                        <!-- Input Instansi -->
                        <div>
                            <label model="instansi" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Asal Instansi / Universitas</label>
                            <input id="instansi" name="instansi" value="{{ old('instansi') }}" required placeholder="Contoh: Universitas Putra Indonesia YPTK" class="w-full rounded-xl border-slate-200 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200" />
                        </div>

                        <!-- Input Group Grid Tanggal (Periode) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 p-4 bg-slate-50 rounded-2xl border border-slate-200/60">
                            <div>
                                <label model="tanggal_mulai_magang" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">Tanggal Mulai Magang</label>
                                <input id="tanggal_mulai_magang" name="tanggal_mulai_magang" type="date" value="{{ old('tanggal_mulai_magang') }}" required class="w-full rounded-xl border-slate-200 text-sm text-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 cursor-pointer" />
                            </div>
                            <div>
                                <label model="tanggal_selesai_magang" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1">Tanggal Selesai Magang</label>
                                <input id="tanggal_selesai_magang" name="tanggal_selesai_magang" type="date" value="{{ old('tanggal_selesai_magang') }}" required class="w-full rounded-xl border-slate-200 text-sm text-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 cursor-pointer" />
                            </div>
                        </div>

                        <!-- Input Select Mentor -->
                        <div>
                            <label model="mentor_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Pilih Mentor Pembimbing</label>
                            <select id="mentor_id" name="mentor_id" required class="w-full rounded-xl border-slate-200 text-sm text-slate-800 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 cursor-pointer">
                                <option value="">-- Pilih Mentor Lapangan --</option>
                                @foreach($mentors as $mentor)
                                    <option value="{{ $mentor->id }}" {{ old('mentor_id') == $mentor->id ? 'selected' : '' }}>
                                        {{ $mentor->name }} ({{ $mentor->nomor_induk }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Footer Tombol Submit Form -->
                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-slate-100 pt-5">
                        <a href="{{ route('admin.data-anak-magang.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors duration-150">
                            Batal
                        </a>
                        <button type="submit" class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-emerald-700 active:scale-[0.98] transition-all duration-200 shadow-md shadow-emerald-100 hover:shadow-lg">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
