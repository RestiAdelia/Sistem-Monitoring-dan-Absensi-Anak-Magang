<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('mentor.tasks.index') }}" class="text-blue-600 text-xs font-bold mb-2 flex items-center gap-1 hover:underline">
            « Kembali ke Daftar Tugas
        </a>
        <h2 class="font-black text-2xl text-slate-800 tracking-tight">{{ $task->judul_tugas }}</h2>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 space-y-6">
            
            <div class="flex gap-2">
                <a href="{{ route('mentor.tasks.show', ['id' => $task->id, 'filter_nilai' => 'semua']) }}" 
                   class="px-4 py-2 text-[11px] font-bold rounded-xl border transition-colors {{ request('filter_nilai', 'semua') == 'semua' ? 'bg-slate-800 text-white border-slate-800 shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">Semua</a>
                
                <a href="{{ route('mentor.tasks.show', ['id' => $task->id, 'filter_nilai' => 'belum']) }}" 
                   class="px-4 py-2 text-[11px] font-bold rounded-xl border transition-colors {{ request('filter_nilai') == 'belum' ? 'bg-amber-500 text-white border-amber-500 shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">Belum Dinilai</a>
                
                <a href="{{ route('mentor.tasks.show', ['id' => $task->id, 'filter_nilai' => 'sudah']) }}" 
                   class="px-4 py-2 text-[11px] font-bold rounded-xl border transition-colors {{ request('filter_nilai') == 'sudah' ? 'bg-emerald-500 text-white border-emerald-500 shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">Sudah Dinilai</a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="text-sm font-bold text-slate-800">Daftar Pengumpul Tugas</h3>
                    <span class="text-xs bg-slate-200/70 text-slate-700 px-2.5 py-1 rounded-lg font-semibold">Total: {{ $submissions->total() }} Data</span>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($submissions as $index => $sub)
                        <div class="p-6 hover:bg-slate-50/30 transition-all flex flex-col lg:flex-row gap-6 items-start">
                            
                            {{-- ✨ Tambahan Komponen Nomor Urut Looping --}}
                            <div class="flex-shrink-0 pt-0.5">
                                <div class="h-7 w-7 rounded-lg bg-slate-100 border border-slate-200 text-slate-500 flex items-center justify-center font-bold font-mono text-xs shadow-xs">
                                    @if(method_exists($submissions, 'currentPage'))
                                        {{ $loop->iteration + ($submissions->currentPage() - 1) * $submissions->perPage() }}
                                    @else
                                        {{ $loop->iteration }}
                                    @endif
                                </div>
                            </div>

                            <div class="flex-1 space-y-2">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs shadow-sm uppercase">
                                        {{ substr($sub->user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">{{ $sub->user->name }}</h4>
                                        <p class="text-[10px] text-slate-400 font-medium">
                                            Kumpul: <span class="text-slate-600 font-semibold">{{ \Carbon\Carbon::parse($sub->waktu_kumpul)->translatedFormat('d M Y, H:i') }} WIB</span>
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $sub->file_jawaban) }}" target="_blank" 
                                   class="inline-flex items-center gap-1 text-[11px] font-bold text-indigo-600 bg-indigo-50 border border-indigo-100 px-3 py-1.5 rounded-lg hover:bg-indigo-100 transition-colors shadow-sm">
                                    Lihat Jawaban File
                                </a>
                            </div>

                            <div class="w-full lg:w-96">
                                @if(is_null($sub->nilai))
                                    <form action="{{ route('mentor.tasks.grade', $sub->id) }}" method="POST" class="bg-slate-50/80 p-3 rounded-xl border border-slate-200 space-y-2">
                                        @csrf @method('PATCH')
                                        <div class="flex gap-2">
                                            <input type="number" name="nilai" min="0" max="100" placeholder="Nilai (0-100)" required 
                                                   class="w-24 text-xs rounded-lg border-slate-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                            <input type="text" name="catatan_nilai" placeholder="Catatan bimbingan..." 
                                                   class="flex-1 text-xs rounded-lg border-slate-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        </div>
                                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 rounded-lg transition shadow-sm">
                                            Simpan Nilai
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-emerald-50/60 p-3 rounded-xl border border-emerald-100 flex items-center justify-between">
                                        <div>
                                            <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Nilai Akhir</p>
                                            <p class="text-xl font-black text-emerald-700">{{ $sub->nilai }}<span class="text-xs text-emerald-500 font-medium">/100</span></p>
                                        </div>
                                        <p class="text-xs text-slate-600 italic bg-white px-3 py-1.5 rounded-lg border border-slate-100 shadow-xs max-w-[200px] truncate">
                                            "{{ $sub->catatan_nilai ?? 'Tanpa catatan' }}"
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-16 text-center text-xs text-slate-400 italic">Tidak ada pengumpulan anak magang yang sesuai dengan kategori filter ini.</div>
                    @endforelse
                </div>
            </div>

            <div class="mt-4">
                {{ $submissions->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</x-app-layout>