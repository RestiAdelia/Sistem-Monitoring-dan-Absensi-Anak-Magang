<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Penerbitan Sertifikat Kelulusan') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Validasi kelayakan nilai akhir, pemantauan berkas kelulusan, and manajemen penerbitan sertifikat.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200/50 p-4 rounded-xl shadow-sm flex items-center space-x-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-xs font-semibold text-emerald-800">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200/50 text-rose-800 rounded-xl shadow-sm">
                    <div class="flex items-center space-x-2 mb-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-rose-900">Gagal mengunggah sertifikat:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-0.5 text-rose-700 pl-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-indigo-600 overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100 bg-white">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Daftar Sertifikasi Anak Magang</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Unggah sertifikat kelulusan bagi anak magang yang telah dinilai secara lengkap oleh mentor bimbingan.</p>
                            </div>
                        </div>

                        <div class="relative w-full sm:w-64">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text"
                                   x-model="search"
                                   placeholder="Cari nama atau nomor induk..."
                                   class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 outline-none" />
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto border border-slate-300 rounded-b-2xl bg-white">
                    <table class="min-w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-slate-100 border-b border-slate-300 text-xs font-bold uppercase tracking-wider text-slate-700 divide-x divide-slate-300">
                                <th class="px-6 py-4 w-12 text-center">No</th>
                                <th class="px-6 py-4">Nama / Instansi</th>
                                <th class="px-6 py-4">Mentor</th>
                                <th class="px-6 py-4 text-center w-28">Nilai Akhir</th>
                                <th class="px-6 py-4 w-44">Status Sertifikat</th>
                                <th class="px-6 py-4 text-right pr-8">Aksi Unggah Berkas PDF (Maks 10MB)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-300">
                            @forelse($interns as $index => $intern)
                                <tr class="hover:bg-slate-50 transition-colors duration-150 text-sm divide-x divide-slate-200"
                                    x-show="'{{ strtolower($intern->name ?? '') }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($intern->nomor_induk ?? '') }}'.includes(search.toLowerCase())">

                                    <td class="px-6 py-4 font-mono text-slate-500 text-center text-xs whitespace-nowrap bg-slate-50/50">
                                        {{ $interns->firstItem() + $index }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-slate-800">{{ $intern->name }}</div>
                                        <div class="text-xs text-slate-400 mt-1 font-medium tracking-wide">
                                            NIM. {{ $intern->nomor_induk }} <span class="text-slate-200 mx-1">|</span> {{ $intern->dataMagang->instansi ?? $intern->instansi ?? '-' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-slate-600 font-medium">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-1.5 h-1.5 rounded-full bg-slate-400"></div>
                                            <span>{{ $intern->mentor->name ?? 'Belum diplot' }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($intern->nilaiAkhirDanSertifikat)
                                            <span class="inline-flex items-center justify-center font-black text-xs text-indigo-700 bg-indigo-50 border border-indigo-100 px-3 py-1 rounded-xl shadow-sm min-w-10">
                                                {{ $intern->nilaiAkhirDanSertifikat->nilai_akhir }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-400 font-semibold italic">Belum dinilai</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($intern->nilaiAkhirDanSertifikat && $intern->nilaiAkhirDanSertifikat->file_sertifikat)
                                            <a href="{{ asset('storage/' . $intern->nilaiAkhirDanSertifikat->file_sertifikat) }}" target="_blank" class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200/50 hover:bg-emerald-100/70 transition-colors shadow-sm">
                                                <svg class="h-4 w-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                Unduh Berkas
                                            </a>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-rose-50 text-rose-600 border border-rose-100">
                                                Belum Diterbitkan
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right pr-8">
                                        @if($intern->nilaiAkhirDanSertifikat)
                                            <form action="{{ route('admin.graduation.upload-certificate', $intern->id) }}" method="POST" enctype="multipart/form-data" class="inline-flex items-center justify-end space-x-3">
                                                @csrf
                                                <input type="file" name="file_sertifikat" accept=".pdf" required
                                                       class="text-xs text-slate-500 max-w-56 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 file:cursor-pointer cursor-pointer">
                                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1.5 px-4 rounded-xl text-xs uppercase tracking-wider active:scale-[0.97] transition-all shadow-md shadow-indigo-100 hover:shadow-lg">
                                                    Unggah
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-400 font-medium italic inline-flex items-center justify-end">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Menunggu penilaian mentor
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-400 italic bg-slate-50/50 font-medium">
                                        Belum ada arsip data anak magang yang terdaftar di dalam sistem.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($interns->hasPages())
                <div class="mt-4 p-4 bg-white border border-slate-300 rounded-2xl shadow-sm">
                    {{ $interns->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
