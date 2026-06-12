<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('mentor.logbooks.index') }}" class="text-blue-600 text-xs font-bold flex items-center gap-1 hover:underline mb-2">
            « Kembali ke Daftar Siswa
        </a>
        <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight">Logbook: {{ $intern->name }}</h2>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Pencarian Tanggal yang Rapi -->
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span class="text-xs font-bold uppercase tracking-wider">Filter Laporan</span>
                </div>
                <form method="GET" class="flex flex-wrap gap-2 items-center">
                    <span class="text-xs text-slate-500 font-medium">Dari:</span>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" required
                           class="text-xs border-slate-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">

                    <span class="text-xs text-slate-500 font-medium">Sampai:</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" required
                           class="text-xs border-slate-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">

                    <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-slate-900 transition">Cari</button>
                    <a href="{{ route('mentor.logbooks.show', $intern->id) }}" class="text-xs text-slate-500 hover:text-slate-800 underline px-2">Reset (6 Hari)</a>
                </form>
            </div>

            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden">
                @forelse($logbooks as $log)
                <div class="p-6 border-b border-slate-100 hover:bg-slate-50/30 transition-colors">
                    <div class="flex gap-6">
                        <!-- Nomor Urut -->
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-xs">
                                {{ $loop->iteration + ($logbooks->currentPage() - 1) * $logbooks->perPage() }}
                            </div>
                        </div>

                        <!-- Konten Utama -->
                        <div class="flex-1 flex flex-col lg:flex-row gap-6">
                            <div class="flex-1 space-y-3">
                                <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md">
                                    {{ \Carbon\Carbon::parse($log->tanggal)->format('d M Y') }}
                                </span>
                                <h4 class="text-sm font-bold text-slate-900">{{ $log->judul_aktivitas }}</h4>
                                <p class="text-xs text-slate-600 bg-slate-50 p-4 rounded-xl border border-slate-100 leading-relaxed">{{ $log->deskripsi }}</p>

                                @if($log->foto_bukti)
                                    <a href="{{ Storage::url($log->foto_bukti) }}" target="_blank"
                                        class="inline-flex items-center gap-1.5 text-[11px] font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50 border border-indigo-100 px-3 py-1.5 rounded-lg transition-colors shadow-sm">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Lihat Berkas Foto Bukti
                                    </a>
                                @endif
                            </div>

                            <!-- Status & Aksi -->
                            <div class="w-full lg:w-72">
                                @if($log->status_approval === 'Pending')
                                <form action="{{ route('mentor.logbooks.update', $log->id) }}" method="POST" class="bg-white p-3 rounded-xl border border-slate-200 shadow-sm">
                                    @csrf @method('PATCH')
                                    <textarea name="catatan_mentor" placeholder="Berikan catatan..." class="w-full text-xs rounded-lg border-slate-200 mb-2 focus:ring-blue-500"></textarea>
                                    <div class="flex gap-2">
                                        <button name="status_approval" value="Disetujui" class="flex-1 bg-blue-600 text-white text-xs font-bold py-2 rounded-lg hover:bg-blue-700">Setujui</button>
                                        <button name="status_approval" value="Ditolak" class="flex-1 bg-rose-600 text-white text-xs font-bold py-2 rounded-lg hover:bg-rose-700">Tolak</button>
                                    </div>
                                </form>
                                @else
                                <div class="px-3 py-2 rounded-lg text-xs font-bold border {{ $log->status_approval == 'Disetujui' ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-rose-50 text-rose-700 border-rose-100' }}">
                                    {{ $log->status_approval }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-20 text-center text-xs text-slate-400">Tidak ada logbook ditemukan untuk periode ini.</div>
                @endforelse
            </div>
            {{ $logbooks->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
