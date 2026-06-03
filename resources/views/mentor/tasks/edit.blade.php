<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-slate-400 mb-1">
            <a href="{{ route('mentor.tasks.index') }}" class="hover:text-white transition-colors">Manajemen Tugas</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-200">Edit Tugas</span>
        </div>
        <h2 class="font-bold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Edit Tugas Anak Magang') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-200/60 p-5 sm:p-6 lg:p-8">
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h3 class="text-base font-bold text-slate-900 tracking-tight">Perbarui Informasi Tugas</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Ubah detail instruksi, batas waktu, atau ganti file materi pendukung tugas bimbingan.</p>
                </div>

                @if($errors->any())
                    <div class="mb-4 p-3 bg-rose-50 border border-rose-200/60 text-rose-800 rounded-xl text-xs">
                        <ul class="list-disc list-inside space-y-0.5 font-medium">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mentor.tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="judul_tugas" class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Judul Tugas</label>
                        <input type="text" name="judul_tugas" id="judul_tugas" value="{{ old('judul_tugas', $task->judul_tugas) }}" required class="w-full text-xs rounded-xl border-slate-200 shadow-sm focus:border-indigo-400 focus:ring-0 transition-all py-2.5">
                    </div>

                    <div>
                        <label for="deskripsi_tugas" class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Deskripsi Tugas</label>
                        <textarea name="deskripsi_tugas" id="deskripsi_tugas" rows="5" required class="w-full text-xs rounded-xl border-slate-200 shadow-sm focus:border-indigo-400 focus:ring-0 transition-all">{{ old('deskripsi_tugas', $task->deskripsi_tugas) }}</textarea>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/60 space-y-2.5">
                        <div>
                            <label for="file_materi" class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Ganti Berkas Materi (Opsional)</label>
                            <input type="file" name="file_materi" id="file_materi" class="w-full text-[11px] text-slate-500 bg-white rounded-lg border border-slate-200 p-1.5 file:mr-3 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition-all">
                        </div>

                        @if($task->file_materi)
                            <div class="flex items-center gap-2 text-[11px] text-slate-500 pl-0.5">
                                <svg class="w-3.5 h-3.5 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span>File aktif saat ini:</span>
                                <a href="{{ asset('storage/' . $task->file_materi) }}" target="_blank" class="font-bold text-indigo-600 hover:underline truncate max-w-xs">Lihat Materi Lama</a>
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="deadline" class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Batas Waktu Baru (Deadline)</label>
                        <input type="datetime-local" name="deadline" id="deadline" value="{{ old('deadline', $task->deadline ? $task->deadline->format('Y-m-d\TH:i') : '') }}" required class="w-full text-xs rounded-xl border-slate-200 shadow-sm focus:border-indigo-400 focus:ring-0 text-slate-600 font-mono py-2">
                    </div>

                    <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100 mt-2">
                        <a href="{{ route('mentor.tasks.index') }}" class="inline-flex items-center justify-center h-9 px-4 border border-slate-200 text-slate-500 hover:bg-slate-50 font-bold rounded-xl text-xs transition-colors shadow-sm">
                            Batalkan
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center h-9 px-5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs shadow-sm transition-all">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
