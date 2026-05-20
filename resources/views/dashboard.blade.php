<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 p-8">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-6 md:space-y-0">
                    <div>
                        <h3 class="text-2xl font-black text-gray-800 mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-sm text-gray-500">Anda masuk sebagai peserta <strong>Anak Magang</strong>.</p>
                        
                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div class="bg-gray-50 p-4 rounded-md border">
                                <span class="block text-xs uppercase font-bold text-gray-400">Nomor Induk</span>
                                <span class="text-gray-800 font-semibold">{{ Auth::user()->nomor_induk }}</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-md border">
                                <span class="block text-xs uppercase font-bold text-gray-400">Asal Instansi</span>
                                <span class="text-gray-800 font-semibold">{{ Auth::user()->instansi ?? 'Tidak dicantumkan' }}</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-md border sm:col-span-2">
                                <span class="block text-xs uppercase font-bold text-gray-400">Mentor Pembimbing</span>
                                <span class="text-indigo-700 font-bold">{{ Auth::user()->mentor->name ?? 'Belum diplot oleh Admin' }}</span>
                                @if(Auth::user()->mentor)
                                    <span class="text-xs text-gray-400">({{ Auth::user()->mentor->email }})</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Certificate Card if graded -->
                    @if(Auth::user()->nilaiAkhirDanSertifikat)
                        <div class="bg-indigo-50 border border-indigo-150 p-6 rounded-lg text-center md:max-w-xs w-full">
                            <div class="text-xs uppercase font-bold text-indigo-400 mb-1">Nilai Akhir Kelulusan</div>
                            <div class="text-4xl font-black text-indigo-900 mb-4">{{ Auth::user()->nilaiAkhirDanSertifikat->nilai_akhir }}</div>
                            
                            @if(Auth::user()->nilaiAkhirDanSertifikat->file_sertifikat)
                                <a href="{{ asset('storage/' . Auth::user()->nilaiAkhirDanSertifikat->file_sertifikat) }}" target="_blank" class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded font-semibold text-xs uppercase tracking-widest transition">
                                    Unduh Sertifikat PDF
                                </a>
                            @else
                                <span class="block text-xs text-gray-400 italic">Sertifikat PDF sedang diproses Admin</span>
                            @endif
                        </div>
                    @else
                        <div class="bg-gray-50 border p-6 rounded-lg text-center md:max-w-xs w-full text-sm text-gray-500 italic">
                            Evaluasi akhir bimbingan belum diterbitkan oleh Mentor.
                        </div>
                    @endif
                </div>

                <div class="mt-8 border-t border-gray-150 pt-6">
                    <h4 class="text-sm font-bold text-gray-700 mb-2">Informasi Akses Mobile</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Presensi harian berbasis geofencing, pengisian laporan harian (logbook), serta pengumpulan materi tugas bimbingan dilakukan secara eksklusif menggunakan <strong>Aplikasi Mobile Monitoring & Absensi Anak Magang</strong>. Silakan masuk di aplikasi mobile menggunakan alamat email dan kata sandi akun web ini.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
