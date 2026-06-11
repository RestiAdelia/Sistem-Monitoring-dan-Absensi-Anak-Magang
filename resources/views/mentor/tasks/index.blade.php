<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tight">Manajemen Tugas Bimbingan</h2>

        </div>
    </x-slot>

    <!-- Menambahkan x-data untuk search -->
    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ searchQuery: '' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl text-xs font-medium shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <!-- Search Bar -->
            <!-- Wrapper untuk Search dan Tombol -->
            <div class="flex flex-col sm:flex-row gap-3 items-center">

                <!-- Input Search -->
                <div class="relative flex-1 w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" x-model="searchQuery" placeholder="Cari judul tugas..."
                        class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                </div>

                <!-- Tombol Tambah -->
                <a href="{{ route('mentor.tasks.create') }}"
                    class="w-full sm:w-auto flex justify-center items-center bg-blue-600 text-white text-xs font-bold px-6 py-3.5 rounded-2xl hover:bg-blue-700 transition-colors shadow-sm whitespace-nowrap">
                    + Buat Tugas Baru
                </a>
            </div>

            <div class="space-y-4">
                <h3 class="text-sm font-black text-slate-500 uppercase tracking-wider">Daftar Tugas Anda</h3>

                <div class="space-y-4">
                    @forelse($tasks as $task)
                    <!-- Filter dengan Alpine.js -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:border-blue-200 transition-all"
                        x-show="'{{ strtolower($task->judul_tugas) }}'.includes(searchQuery.toLowerCase())">

                        <div class="flex items-start gap-4">
                            <!-- Nomor Urut -->
                            <div class="flex-shrink-0 h-9 w-9 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center font-black text-sm">
                                {{ $loop->iteration }}
                            </div>

                            <!-- Isi Kartu -->
                            <div class="flex-1 space-y-3">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-sm font-bold text-slate-900 leading-snug">{{ $task->judul_tugas }}</h4>
                                    <span class="text-[10px] font-bold px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded">
                                        {{ $task->pengumpulan_tugas_count }} Pengumpul
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed">{{ $task->deskripsi_tugas }}</p>

                                <div class="pt-3 border-t border-slate-100 flex justify-between items-center text-[11px]">
                                    <span class="text-slate-400 font-medium">
                                        Deadline: <strong class="text-slate-700">{{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y, H:i') }}</strong>
                                    </span>

                                    <div class="flex gap-2">
                                        <!-- Fitur Lihat Materi (Unduh) -->
                                        @if($task->file_materi)
                                        <a href="{{ Storage::url($task->file_materi) }}" target="_blank"
                                            class="font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors">
                                            Materi
                                        </a>
                                        @endif

                                        <!-- Tombol Detail Pengumpul -->
                                        <a href="{{ route('mentor.tasks.show', $task->id) }}"
                                            class="font-bold text-blue-600 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                                            Detail Pengumpul
                                        </a>

                                        <!-- Tombol Edit -->
                                        <a href="{{ route('mentor.tasks.edit', $task->id) }}"
                                            class="font-bold text-amber-600 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-lg transition-colors">
                                            Edit
                                        </a>
                                        <form action="{{ route('mentor.tasks.destroy', $task->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini? Data pengumpulan juga akan terhapus.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-bold text-rose-600 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white p-12 text-center text-xs text-slate-400 rounded-2xl border border-slate-200">
                        Belum ada tugas yang dibuat.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>