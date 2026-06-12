<nav x-data="{ open: false }"
    class="lg:fixed lg:inset-y-0 lg:left-0 lg:z-20 lg:flex lg:w-72 xl:w-80 lg:flex-col bg-[#0B1329] text-slate-200 rounded-none border-r border-slate-800 shadow-xl transition-all duration-300">

    <div class="hidden lg:flex lg:flex-col lg:h-full">
        <div class="px-6 py-6 border-b border-slate-800 bg-black/10">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 group">
                <div
                    class="p-2.5 bg-gradient-to-tr from-blue-500 via-indigo-500 to-violet-500 rounded-xl shadow-xl shadow-indigo-500/20 group-hover:rotate-6 transition-transform duration-300">
                    <x-application-logo class="h-5 w-5 text-white" />
                </div>
                <div class="overflow-hidden">
                    <p
                        class="text-sm font-extrabold tracking-tight text-white group-hover:text-indigo-400 transition-colors">
                        {{ config('app.name', 'Laravel') }}</p>
                    <p class="text-[10px] text-indigo-400/80 font-semibold uppercase tracking-widest mt-0.5">Monitoring
                        Magang</p>
                </div>
            </a>
        </div>

        <div class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar">
            <a href="{{ route('dashboard') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                <span
                    class="inline-flex h-5 w-5 items-center justify-center transition-colors {{ request()->routeIs('dashboard') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </span>
                Dashboard
            </a>

            @if (Auth::user()->role === 'admin')
                <div
                    class="pt-5 pb-1.5 px-4 flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase tracking-[0.15em]">
                    <span class="w-1 h-1 rounded-full bg-indigo-500/60"></span> Menu Admin
                </div>

                <a href="{{ route('admin.absensi.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.absensi.index') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('admin.absensi.index') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </span>
                    Absensi
                </a>

                <a href="{{ route('admin.absensi.pending') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.absensi.pending') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('admin.absensi.pending') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    Persetujuan Absensi
                </a>



                <a href="{{ route('admin.users.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('admin.users.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </span>
                    Kelola Pengguna
                </a>

                <a href="{{ route('admin.data-anak-magang.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.data-anak-magang.*') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('admin.data-anak-magang.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.26 10.174L10.74 3.697a1.65 1.65 0 012.52 0l6.48 6.477A1.65 1.65 0 0118.574 13h-1.148v7.25A1.75 1.75 0 0115.675 22h-7.35a1.75 1.75 0 01-1.75-1.75V13H5.426a1.65 1.65 0 01-1.165-2.826z" />
                        </svg>
                    </span>
                    Data Anak Magang
                </a>

                <a href="{{ route('admin.data-mentor.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.data-mentor.*') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('admin.data-mentor.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>
                    Data Mentor
                </a>

                <a href="{{ route('admin.graduation.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.graduation.*') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('admin.graduation.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.03 0 1.9.693 2.166 1.638m-7.377 0A48.536 48.536 0 0112 3c1.43 0 2.812.062 4.18.183" />
                        </svg>
                    </span>
                    Kelulusan & Sertifikat
                </a>
            @endif

            @if (Auth::user()->role === 'mentor')
                <div
                    class="pt-5 pb-1.5 px-4 flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase tracking-[0.15em]">
                    <span class="w-1 h-1 rounded-full bg-emerald-500/60"></span> Menu Mentor
                </div>

                <a href="{{ route('mentor.attendance.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('mentor.attendance.*') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('mentor.attendance.*') ? 'text-white font-bold' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>
                    </span>
                    Kehadiran
                </a>

                <a href="{{ route('mentor.interns.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('mentor.interns.*') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('mentor.interns.*') ? 'text-white font-bold' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    </span>
                    Data Anak Magang
                </a>

                <a href="{{ route('mentor.logbooks.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('mentor.logbooks.*') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('mentor.logbooks.*') ? 'text-white font-bold' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </span>
                    Persetujuan Logbook
                </a>

                <a href="{{ route('mentor.tasks.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('mentor.tasks.*') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('mentor.tasks.*') ? 'text-white font-bold' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 6h12M6 10h12M6 14h8m-9 4h10V5.2c0-.663-.537-1.2-1.2-1.2H5.2C4.537 4 4 4.537 4 5.2V18z" />
                        </svg>
                    </span>
                    Kelola Tugas
                </a>

                <a href="{{ route('mentor.grading.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-[13px] font-medium transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('mentor.grading.*') ? 'bg-gradient-to-r from-indigo-500/20 via-blue-500/10 to-transparent text-white border-l-2 border-indigo-500 font-semibold' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <span
                        class="inline-flex h-5 w-5 items-center justify-center {{ request()->routeIs('mentor.grading.*') ? 'text-white font-bold' : 'text-slate-500 group-hover:text-slate-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499c.172-.435.748-.435.92 0l2.184 5.54 5.961.432c.477.034.668.625.303.938l-4.543 3.905 1.397 5.834c.113.474-.412.855-.822.59l-5.18-3.344-5.18 3.344c-.41.265-.935-.116-.822-.59l1.397-5.834-4.543-3.905c-.365-.313-.174-.904.303-.938l5.961-.432 2.184-5.54z" />
                        </svg>
                    </span>
                    Penilaian Akhir
                </a>
            @endif
        </div>

        <div class="p-4 border-t border-slate-800 bg-black/10">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-white/5 transition-colors duration-200">
                <div
                    class="h-9 w-9 rounded-xl bg-gradient-to-tr from-slate-800 to-slate-700 flex items-center justify-center font-bold text-slate-200 border border-slate-700/60 shadow-inner">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden flex-1">
                    <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2 mt-3">
                <a href="{{ route('profile.edit') }}"
                    class="flex justify-center items-center rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-800 px-3 py-2 text-[11px] font-medium text-slate-300 transition-all duration-200 shadow-sm">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full flex justify-center items-center rounded-xl bg-red-950/20 hover:bg-red-500/20 border border-red-900/40 hover:border-red-500/40 px-3 py-2 text-[11px] font-bold text-red-400 transition-all duration-200">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="lg:hidden bg-[#0B1329] border-b border-slate-800/40">
        <div class="flex items-center justify-between px-5 py-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                <div class="p-2 bg-gradient-to-tr from-blue-500 to-indigo-500 rounded-lg">
                    <x-application-logo class="h-4 w-4 text-white" />
                </div>
                <span
                    class="font-extrabold text-white tracking-tight text-sm">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <button @click="open = !open"
                class="inline-flex items-center justify-center rounded-xl bg-slate-800/50 p-2 text-slate-400 hover:text-white transition-all">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="px-4 pb-5 space-y-1 bg-[#0B1329]">

            <a href="{{ route('dashboard') }}"
                class="block rounded-xl px-4 py-2.5 text-[13px] font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-600/20 text-white' : 'text-slate-400' }}">Dashboard</a>

            @if (Auth::user()->role === 'admin')
                <div class="pt-3 pb-1 px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Admin</div>
                <a href="{{ route('admin.users.index') }}"
                    class="block rounded-xl px-4 py-2.5 text-[13px] font-medium text-slate-400">Kelola Pengguna</a>
                <a href="{{ route('admin.graduation.index') }}"
                    class="block rounded-xl px-4 py-2.5 text-[13px] font-medium text-slate-400">Kelulusan &
                    Sertifikat</a>
            @endif

            <div class="pt-3 mt-3 border-t border-slate-800/40 flex items-center justify-between px-4">
                <a href="{{ route('profile.edit') }}" class="text-[13px] font-medium text-slate-400">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[13px] font-bold text-red-400">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
