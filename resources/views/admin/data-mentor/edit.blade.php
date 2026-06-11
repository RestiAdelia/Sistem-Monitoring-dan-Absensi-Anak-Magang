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
                    {{ __('Edit Data Mentor') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Lakukan pembaruan profil berkas induk fisik data pembimbing magang.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-indigo-600 p-6 sm:p-8">

                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h3 class="text-base font-bold text-slate-800">Form Perubahan Data Mentor</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Sesuaikan informasi profil pembimbing lapangan. Perubahan data di bawah otomatis menyatu dengan akun login pengguna jika sudah dibuat aktif.</p>
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

                <form action="{{ route('admin.data-mentor.update', $data_mentor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">

                        <div>
                            <label for="nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama', $data_mentor->nama) }}" required placeholder="Nama lengkap pembimbing lapangan beserta gelar" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" />
                        </div>

                        <div>
                            <label for="bidang" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Bidang / Spesialisasi Kompetensi</label>
                            <input type="text" id="bidang" name="bidang" value="{{ old('bidang', $data_mentor->bidang) }}" required placeholder="Contoh: Web Developer, UI/UX Designer, HRD" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email Resmi</label>
                                <input id="email" type="email" name="email" value="{{ old('email', $data_mentor->email) }}" placeholder="Contoh: mentor@gmail.com" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" />
                            </div>
                            <div>
                                <label for="no_hp" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">No. HP / WhatsApp</label>
                                <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp', $data_mentor->no_hp) }}" placeholder="Contoh: 081234567890" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="jk" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jenis Kelamin</label>
                                <select id="jk" name="jk" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer text-slate-600 font-medium">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" {{ old('jk', $data_mentor->jk) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jk', $data_mentor->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status Aktif Mentor</label>
                                <select id="status" name="status" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer text-slate-600 font-medium">
                                    <option value="Aktif" {{ old('status', $data_mentor->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status', $data_mentor->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Foto Profile Resmi</label>
                            <div class="flex flex-col sm:flex-row items-center gap-4 p-4 bg-slate-50/50 border border-slate-200 rounded-xl">
                                <div class="shrink-0 text-center">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Foto Saat Ini</p>
                                    @if($data_mentor->foto)
                                        <img src="{{ asset('storage/' . $data_mentor->foto) }}" alt="Foto {{ $data_mentor->nama }}" class="h-16 w-16 rounded-xl object-cover border border-slate-200 shadow-sm mx-auto">
                                    @else
                                        <div class="h-16 w-16 rounded-xl bg-slate-200 flex items-center justify-center text-slate-400 font-extrabold text-sm mx-auto uppercase">
                                            {{ substr($data_mentor->nama, 0, 2) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 w-full">
                                    <div class="flex text-xs text-slate-600">
                                        <input id="foto" name="foto" type="file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer" />
                                    </div>
                                    <p class="text-[10px] text-slate-400 font-medium mt-1.5">Pilih file baru jika ingin mengganti foto profile (Format: JPG, JPEG, PNG maks 2MB).</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-slate-100 pt-5">
                        <a href="{{ route('admin.data-mentor.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors duration-150">
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
