<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Anak Bimbingan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-6 border-b border-gray-100 bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-800">Anak Magang Aktif</h3>
                    <p class="text-sm text-slate-500">Daftar mahasiswa/siswa yang sedang Anda bimbing saat ini.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-100 text-slate-600 uppercase text-xs font-bold">
                            <tr>
                                <th class="px-6 py-4">Nama Lengkap / NIM</th>
                                <th class="px-6 py-4">Instansi</th>
                                <th class="px-6 py-4">Periode Magang</th>
                                <th class="px-6 py-4 text-center">Status Akun</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($myInterns as $intern)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $intern->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $intern->nomor_induk }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $intern->dataMagang->instansi ?? 'Data instansi tidak tersedia' }}
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-600">
                                    @if($intern->dataMagang)
                                    <div class="font-medium">Mulai: {{ \Carbon\Carbon::parse($intern->dataMagang->tanggal_mulai_magang)->format('d M Y') }}</div>
                                    <div>Selesai: {{ \Carbon\Carbon::parse($intern->dataMagang->tanggal_selesai_magang)->format('d M Y') }}</div>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($intern->is_active)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Aktif</span>
                                    @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <!-- Contoh tombol aksi untuk mentor -->
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm font-bold">Presensi</a>
                                    <a href="#" class="text-blue-600 hover:text-blue-900 text-sm font-bold">Nilai</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-500 italic">
                                    Anda belum memiliki anak bimbingan yang terdaftar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>