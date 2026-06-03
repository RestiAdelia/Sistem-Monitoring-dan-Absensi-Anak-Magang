
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Manajemen Tugas Anak Magang') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200/60 p-4 rounded-xl shadow-sm flex items-center justify-between animate-fade-in">
                    <div class="flex items-center gap-2.5">
                        <div class="p-1 bg-emerald-500 rounded-lg text-white">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-emerald-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <div class="lg:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/60 p-6 sm:p-7">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-slate-900 tracking-tight">Buat Tugas Baru</h3>
                        <p class="text-sm text-slate-500 mt-0.5">Kirim tugas baru beserta materi pendukung kepada anak magang bimbingan Anda.</p>
                    </div>

                    @if($errors->any())
                        <div class="mb-5 p-3.5 bg-rose-50 border border-rose-200/60 text-rose-800 rounded-xl text-xs">
                            <ul class="list-disc list-inside space-y-0.5 font-medium">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('mentor.tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label for="judul_tugas" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Judul Tugas</label>
                            <input type="text" name="judul_tugas" id="judul_tugas" required class="w-full text-sm rounded-xl border-slate-200 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 transition-all placeholder-slate-400" placeholder="Contoh: Integrasi API Payment">
                        </div>

                        <div>
                            <label for="deskripsi_tugas" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Deskripsi Tugas</label>
                            <textarea name="deskripsi_tugas" id="deskripsi_tugas" rows="4" required class="w-full text-sm rounded-xl border-slate-200 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 transition-all placeholder-slate-400" placeholder="Tulis instruksi pengerjaan tugas secara rinci..."></textarea>
                        </div>

                        <div>
                            <label for="file_materi" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Materi Pendukung (Opsional)</label>
                            <input type="file" name="file_materi" id="file_materi" class="w-full text-xs text-slate-500 bg-slate-50 rounded-xl border border-slate-200 border-dashed p-2 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition-all">
                        </div>

                        <div>
                            <label for="deadline" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Batas Waktu (Deadline)</label>
                            <input type="datetime-local" name="deadline" id="deadline" required class="w-full text-sm rounded-xl border-slate-200 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 text-slate-600 font-mono">
                        </div>

                        <button type="submit" class="w-full inline-flex justify-center items-center py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-md shadow-indigo-600/10 transition-all">
                            Kirim Tugas
                        </button>
                    </form>
                </div>

                <!-- Tasks and Submissions lists -->
                <div class="lg:col-span-2 space-y-8" x-data="{ searchQuery: '' }">
                    <!-- Dispatched Tasks Card -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 p-6">
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Daftar Tugas Terkirim</h3>
                            <p class="text-sm text-gray-500">Tugas-tugas yang telah diterbitkan untuk anak magang.</p>
                        </div>

                        <!-- Search Input -->
                        <div class="mb-4 flex gap-2">
                            <input 
                                type="text" 
                                placeholder="Cari judul tugas, deskripsi, atau deadline..." 
                                x-model="searchQuery"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            <button 
                                @click="searchQuery = ''"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                                Reset
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-5 py-3 text-left">Detail Tugas</th>
                                        <th class="px-5 py-3 text-left">Batas Waktu</th>
                                        <th class="px-5 py-3 text-center">Kumpul</th>
                                        <th class="px-5 py-3 text-right">Materi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100">
                                    @forelse($tasks as $task)
                                        @php
                                            $searchKeyword = strtolower(
                                                $task->judul_tugas . ' ' . 
                                                $task->deskripsi_tugas . ' ' . 
                                                $task->deadline->format('d M Y, H:i')
                                            );
                                        @endphp
                                        <tr x-show="searchQuery === '' || '{{ $searchKeyword }}'.includes(searchQuery.toLowerCase().trim())">
                                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                                <div class="font-bold text-gray-800">{{ $task->judul_tugas }}</div>
                                                <div class="text-xs text-gray-400 truncate max-w-xs">{{ Str::limit($task->deskripsi_tugas, 50) }}</div>
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap text-xs text-slate-500 font-mono">
                                                {{ $task->deadline->format('d M Y, H:i') }}
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap text-center">
                                                <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-md text-xs font-bold font-mono {{ $task->pengumpulan_tugas_count > 0 ? 'bg-indigo-50 text-indigo-700 border border-indigo-100/60' : 'bg-slate-100 text-slate-400' }}">
                                                    {{ $task->pengumpulan_tugas_count }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-3 whitespace-nowrap text-right text-sm">
                                                @if($task->file_materi)
                                                    <a href="{{ asset('storage/' . $task->file_materi) }}" target="_blank" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50/50 hover:bg-indigo-50 px-2.5 py-1 rounded-md border border-indigo-100/20 transition-colors">Unduh</a>
                                                @else
                                                    <span class="text-xs text-slate-300 font-mono">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-5 py-8 text-center text-xs text-slate-400 italic">Belum ada dokumen tugas terkirim.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/60 p-6 sm:p-7">
                        <div class="mb-5">
                            <h3 class="text-lg font-bold text-slate-900 tracking-tight">Evaluasi Pengumpulan Tugas</h3>
                            <p class="text-sm text-slate-500 mt-0.5">Berikan penilaian terhadap hasil jawaban berkas tugas yang dikumpulkan anak magang.</p>
                        </div>

                        <div class="space-y-4">
                            @forelse($submissions as $sub)
                                @php
                                    $subSearch = strtolower($sub->tugas->judul_tugas . ' ' . $sub->user->name);
                                @endphp
                                <div class="p-4 border border-gray-200 rounded-md bg-gray-50 space-y-3"
                                     x-show="searchQuery === '' || '{{ $subSearch }}'.includes(searchQuery.toLowerCase().trim())">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-800">{{ $sub->tugas->judul_tugas }}</h4>
                                            <div class="text-xs text-gray-500">
                                                Oleh: <strong class="text-gray-700">{{ $sub->user->name }}</strong> | 
                                                Kumpul: {{ $sub->waktu_kumpul->format('d M Y, H:i') }}
                                            </div>
                                        </div>

                                        <div class="flex-shrink-0 self-start sm:self-auto">
                                            <a href="{{ asset('storage/' . $sub->file_jawaban) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 hover:text-white bg-white hover:bg-indigo-600 border border-slate-200 hover:border-indigo-600 px-3 py-2 rounded-lg transition-all shadow-sm">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                Berkas Jawaban
                                            </a>
                                        </div>
                                    </div>

                                    @if(is_null($sub->nilai))
                                        <form action="{{ route('mentor.tasks.grade', $sub->id) }}" method="POST" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 bg-white p-2.5 border border-slate-200/80 rounded-xl shadow-inner">
                                            @csrf
                                            <div class="w-full sm:w-24">
                                                <input type="number" name="nilai" min="0" max="100" placeholder="Skor" required class="w-full text-xs rounded-lg border-slate-200 focus:border-indigo-400 font-mono shadow-sm" title="Input nilai antara 0-100">
                                            </div>
                                            <div class="flex-1">
                                                <input type="text" name="catatan_nilai" placeholder="Tulis evaluasi ringkas/catatan nilai..." class="w-full text-xs rounded-lg border-slate-200 focus:border-indigo-400 shadow-sm">
                                            </div>
                                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 sm:py-1.5 rounded-lg text-xs transition-colors shadow-sm">
                                                Simpan
                                            </button>
                                        </form>
                                    @else
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-indigo-50/40 p-3.5 border border-indigo-100/50 rounded-xl text-xs">
                                            <div class="text-slate-600">
                                                <strong class="text-indigo-900 font-bold flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                                    Catatan Mentor:
                                                </strong>
                                                <span class="mt-0.5 block italic text-slate-500">{{ $sub->catatan_nilai ?? 'Tidak ada evaluasi tertulis.' }}</span>
                                            </div>
                                            <div class="text-left sm:text-right flex items-center sm:flex-col gap-1.5 sm:gap-0 self-start sm:self-auto bg-white sm:bg-transparent px-3 py-1 sm:p-0 rounded-lg border border-indigo-100 sm:border-0 flex-shrink-0">
                                                <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Nilai Akhir</span>
                                                <span class="text-xl font-black text-indigo-600 font-mono leading-none sm:mt-1">{{ $sub->nilai }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="py-12 text-center text-xs text-slate-400 bg-slate-50 border border-dashed rounded-xl">
                                    Belum ada dokumen lembar pengumpulan tugas masuk dari anak magang saat ini.
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

