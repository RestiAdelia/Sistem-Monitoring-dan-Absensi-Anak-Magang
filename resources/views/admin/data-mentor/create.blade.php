<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.data-mentor.index') }}" class="p-2 bg-white text-slate-600 hover:text-indigo-600 rounded-xl border border-slate-200/70 shadow-sm transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Tambah Mentor') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Pencatatan data induk fisik pembimbing baru ke dalam pangkalan data.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-indigo-600 p-6 sm:p-8">

                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h3 class="text-base font-bold text-slate-800">Form Pendaftaran Mentor</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Tambah data mentor yang sudah terdaftar secara resmi untuk dibuatkan akun setelah proses verifikasi.</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200/50 text-emerald-800 rounded-xl flex items-center space-x-2.5 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

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

                <form action="{{ route('admin.data-mentor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-5">

                        <div>
                            <label for="nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                            <input id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap mentor beserta gelar" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" />
                        </div>

                        <div>
                            <label for="bidang" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Bidang / Spesialisasi Kompetensi</label>
                            <input id="bidang" name="bidang" value="{{ old('bidang') }}" required placeholder="Contoh: Web Developer, UI/UX Designer, HRD" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email Resmi</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Contoh: mentor@gmail.com" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" />
                            </div>
                            <div>
                                <label for="no_hp" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">No. HP / WhatsApp</label>
                                <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="jk" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jenis Kelamin</label>
                                <select id="jk" name="jk" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer text-slate-600 font-medium">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" {{ old('jk') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jk') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status Aktif Mentor</label>
                                <select id="status" name="status" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer text-slate-600 font-medium">
                                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="foto" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Foto Profile Resmi</label>
                            <div class="mt-1 flex items-center justify-center border-2 border-slate-200 border-dashed rounded-xl p-4 bg-slate-50/50 hover:bg-slate-50 transition-colors duration-150">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-8 w-8 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4-4m4 24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-xs text-slate-600 justify-center">
                                        <label for="foto" class="relative cursor-pointer rounded-md font-bold text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                            <span>Pilih File Gambar</span>
                                            <input id="foto" name="foto" type="file" accept="image/*" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-[10px] text-slate-400 font-medium">Format: JPG, JPEG, PNG maks 2MB</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-slate-100 pt-5">
                        <a href="{{ route('admin.data-mentor.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors duration-150">
                            Batal
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-indigo-700 active:scale-[0.98] transition-all duration-200 shadow-md shadow-indigo-100 hover:shadow-lg">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
