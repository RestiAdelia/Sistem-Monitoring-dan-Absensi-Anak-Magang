<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Administrator') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Dashboard Administrator</h1>
                <p class="text-gray-600 mt-2">Monitor kehadiran anak magang {{ \Carbon\Carbon::now()->format('F Y') }}</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Interns -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Anak Magang</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalInterns }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Mentors -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Mentor</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalMentors }}</p>
                        </div>
                        <div class="bg-emerald-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Today Attendance -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Kehadiran Hari Ini</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $todayAttendance }}</p>
                        </div>
                        <div class="bg-orange-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- This Month Attendance -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Kehadiran Bulan Ini</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $thisMonthAttendance }}</p>
                        </div>
                        <div class="bg-purple-100 rounded-lg p-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Summary by Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <h2 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Kehadiran Bulan Ini</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <p class="text-green-600 text-sm font-medium">Hadir</p>
                        <p class="text-2xl font-bold text-green-700 mt-2">{{ $attendanceByStatus->get('Hadir', 0) }}</p>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                        <p class="text-yellow-600 text-sm font-medium">Izin</p>
                        <p class="text-2xl font-bold text-yellow-700 mt-2">{{ $attendanceByStatus->get('Izin', 0) }}</p>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                        <p class="text-red-600 text-sm font-medium">Sakit</p>
                        <p class="text-2xl font-bold text-red-700 mt-2">{{ $attendanceByStatus->get('Sakit', 0) }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-gray-600 text-sm font-medium">Alpha</p>
                        <p class="text-2xl font-bold text-gray-700 mt-2">{{ $attendanceByStatus->get('Alpha', 0) }}</p>
                    </div>
                </div>
            </div>

            <!-- Attendance Monitoring Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <h2 class="text-lg font-bold text-gray-900">Monitor Kehadiran Anak Magang</h2>
                    
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="w-full md:w-auto">
                        <div class="flex flex-col sm:flex-row gap-2">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari nama atau NIM..." 
                                   class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            
                            <select name="mentor_id" 
                                    onchange="this.form.submit()" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Mentor</option>
                                @foreach($mentors as $mentor)
                                    <option value="{{ $mentor->id }}" 
                                            {{ request('mentor_id') == $mentor->id ? 'selected' : '' }}>
                                        {{ $mentor->nama }}
                                    </option>
                                @endforeach
                            </select>

                            @if(request('search') || request('mentor_id'))
                                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 transition-colors text-center">Reset</a>
                            @endif
                            
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">Cari</button>
                        </div>
                    </form>
                </div>

                <!-- Attendance Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-200">
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">No</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama Anak Magang</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Mentor</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Jam Masuk</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Jam Pulang</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($attendanceRecords as $record)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ ($attendanceRecords->currentPage() - 1) * $attendanceRecords->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                        {{ $record->user->dataMagang->nama ?? $record->user->name }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        @php
                                            $mentorName = 'N/A';
                                            if ($record->user->dataMagang && $record->user->dataMagang->mentor) {
                                                $mentorData = $record->user->dataMagang->mentor->dataMentor;
                                                $mentorName = $mentorData->nama ?? $record->user->dataMagang->mentor->name;
                                            }
                                        @endphp
                                        {{ $mentorName }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $record->tanggal->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $record->jam_masuk ? $record->jam_masuk->format('H:i:s') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $record->jam_pulang ? $record->jam_pulang->format('H:i:s') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @php
                                            $statusColors = [
                                                'Hadir' => 'bg-green-100 text-green-800',
                                                'Izin' => 'bg-yellow-100 text-yellow-800',
                                                'Sakit' => 'bg-red-100 text-red-800',
                                                'Alpha' => 'bg-gray-100 text-gray-800',
                                            ];
                                            $colorClass = $statusColors[$record->status_kehadiran] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $colorClass }}">
                                            {{ $record->status_kehadiran }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Tidak ada data kehadiran
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($attendanceRecords->hasPages())
                    <div class="mt-6">
                        {{ $attendanceRecords->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
