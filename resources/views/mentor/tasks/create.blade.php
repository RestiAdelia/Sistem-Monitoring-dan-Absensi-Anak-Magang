
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('mentor.tasks.index') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-slate-600 hover:border-slate-300 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-bold text-xl text-slate-800 leading-tight tracking-tight">
                {{ __('Buat Tugas Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/60 p-6 sm:p-8">
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-slate-900 tracking-tight">Detail Instruksi Tugas</h3>
                    <p class="text-sm text-slate-500 mt-0.5">Kirim tugas baru beserta materi pendukung kepada seluruh anak magang bimbingan Anda.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200/60 text-rose-800 rounded-2xl text-sm">
                        <ul class="list-disc list-inside space-y-1 font-medium">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mentor.tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label for="judul_tugas" class="block text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Judul Tugas</label>
                        <input type="text" name="judul_tugas" id="judul_tugas" required class="w-full text-sm rounded-2xl border-slate-200 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 transition-all py-3 px-4 placeholder-slate-400" placeholder="Masukkan judul tugas yang jelas...">
                    </div>

                    <div class="space-y-2">
                        <label for="deskripsi_tugas" class="block text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Deskripsi Tugas</label>
                        <textarea name="deskripsi_tugas" id="deskripsi_tugas" rows="6" required class="w-full text-sm rounded-2xl border-slate-200 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 transition-all py-3 px-4 placeholder-slate-400" placeholder="Tulis instruksi pengerjaan tugas secara rinci dan langkah-langkahnya..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="file_materi" class="block text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Materi Pendukung (Opsional)</label>
                            <div class="relative group">
                                <input type="file" name="file_materi" id="file_materi" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="w-full text-sm text-slate-500 bg-slate-50 rounded-2xl border-2 border-slate-200 border-dashed p-4 flex flex-col items-center justify-center gap-2 group-hover:border-indigo-300 group-hover:bg-indigo-50/30 transition-all">
                                    <svg class="w-8 h-8 text-slate-300 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                    <span class="text-xs font-semibold text-slate-400 group-hover:text-indigo-600 transition-colors">Pilih file atau seret ke sini</span>
                                    <span class="text-[10px] text-slate-300">Maks. 5MB (PDF, DOCX, ZIP, JPG)</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="deadline" class="block text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Batas Waktu (Deadline)</label>
                            <input type="datetime-local" name="deadline" id="deadline" required class="w-full text-sm rounded-2xl border-slate-200 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 text-slate-600 font-mono py-3 px-4">
                        </div>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <a href="{{ route('mentor.tasks.index') }}" class="flex-1 inline-flex justify-center items-center py-3 px-4 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-2xl text-sm font-bold transition-all">
                            Batalkan
                        </a>
                        <button type="submit" class="flex-[2] inline-flex justify-center items-center py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl text-sm font-bold shadow-lg shadow-indigo-600/20 transition-all">
                            Terbitkan Tugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
