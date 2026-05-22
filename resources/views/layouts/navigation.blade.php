<nav x-data="{ open: false }"
    class="lg:fixed lg:inset-y-0 lg:z-20 lg:flex lg:w-72 xl:w-80 lg:flex-col bg-[#1E3A5F] text-white shadow-xl">
    
    <!-- Desktop Sidebar -->
    <div class="hidden lg:flex lg:flex-col lg:h-full">
        <!-- Logo Section -->
        <div class="px-8 py-8 border-b border-white/10">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4">
                <div class="p-2 bg-white/10 rounded-xl">
                    <x-application-logo class="h-9 w-9 text-white" />
                </div>
                <div>
                    <p class="text-lg font-bold tracking-tight text-white">{{ config('app.name', 'Laravel') }}</p>
                    <p class="text-xs text-blue-200/60 font-medium uppercase tracking-widest">Monitoring Magang</p>
                </div>
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white shadow-lg' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg {{ request()->routeIs('dashboard') ? 'bg-white text-[#1E3A5F]' : 'bg-white/10 text-white group-hover:bg-white/20' }} font-bold transition-colors">
                    D
                </span>
                Dashboard
            </a>

            @if (Auth::user()->role === 'admin')
            <div class="pt-4 pb-2 px-4 text-[10px] font-bold text-blue-300/50 uppercase tracking-[0.2em]">Menu Administrator</div>
            
            <a href="{{ route('admin.users.index') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.users.*') ? 'bg-white/20 text-white shadow-lg' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white font-bold transition-colors group-hover:bg-white/20">U</span>
                Kelola Pengguna
            </a>
            <a href="{{ route('admin.data-anak-magang.index') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.data-anak-magang.*') ? 'bg-white/20 text-white shadow-lg' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white font-bold transition-colors group-hover:bg-white/20">P</span>
                Data Anak Magang
            </a>
            <a href="{{ route('admin.data-mentor.index') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.data-mentor.*') ? 'bg-white/20 text-white shadow-lg' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white font-bold transition-colors group-hover:bg-white/20">M</span>
                Data Mentor
            </a>
            <a href="{{ route('admin.graduation.index') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.graduation.*') ? 'bg-white/20 text-white shadow-lg' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white font-bold transition-colors group-hover:bg-white/20">G</span>
                Kelulusan & Sertifikat
            </a>
            @endif

            @if (Auth::user()->role === 'mentor')
            <div class="pt-4 pb-2 px-4 text-[10px] font-bold text-blue-300/50 uppercase tracking-[0.2em]">Menu Mentor</div>
            
            <a href="{{ route('mentor.attendance.index') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('mentor.attendance.*') ? 'bg-white/20 text-white shadow-lg' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white font-bold">K</span>
                Kehadiran
            </a>
            <a href="{{ route('mentor.interns.index') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('mentor.interns.index') ? 'bg-white/20 text-white shadow-lg' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white font-bold">D</span>
                Data Anak Magang
            </a>
            <a href="{{ route('mentor.logbooks.index') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('mentor.logbooks.*') ? 'bg-white/20 text-white shadow-lg' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white font-bold">L</span>
                Persetujuan Logbook
            </a>
            <a href="{{ route('mentor.tasks.index') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('mentor.tasks.*') ? 'bg-white/20 text-white shadow-lg' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white font-bold">T</span>
                Kelola Tugas
            </a>
            <a href="{{ route('mentor.grading.index') }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('mentor.grading.*') ? 'bg-white/20 text-white shadow-lg' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white font-bold">P</span>
                Penilaian Akhir
            </a>
            @endif
        </div>

        <!-- User Profile Section -->
        <div class="px-6 py-6 border-t border-white/10 bg-black/10">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-10 w-10 rounded-full bg-white/20 flex items-center justify-center font-bold text-white border border-white/30">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-blue-200/60 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('profile.edit') }}"
                    class="flex justify-center items-center rounded-xl bg-white/10 px-3 py-2.5 text-xs font-semibold text-white hover:bg-white/20 transition-all">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex justify-center items-center rounded-xl bg-red-500 px-3 py-2.5 text-xs font-bold text-white hover:bg-red-600 shadow-lg shadow-red-900/20 transition-all">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="lg:hidden bg-[#1E3A5F] border-b border-white/10">
        <div class="flex items-center justify-between px-6 py-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <x-application-logo class="h-8 w-8 text-white" />
                <span class="font-bold text-white tracking-tight">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <button @click="open = !open"
                class="inline-flex items-center justify-center rounded-xl bg-white/10 p-2 text-white hover:bg-white/20 transition-all">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="px-4 pb-6 space-y-2 bg-[#1E3A5F]">
            <a href="{{ route('dashboard') }}"
                class="block rounded-xl px-4 py-3 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white">Dashboard</a>

            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.users.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white">Kelola Pengguna</a>
                <a href="{{ route('admin.graduation.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white">Kelulusan & Sertifikat</a>
            @endif

            @if (Auth::user()->role === 'mentor')
                <a href="{{ route('mentor.attendance.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white">Kehadiran</a>
                <a href="{{ route('mentor.grading.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white">Penilaian Akhir</a>
            @endif

            <div class="pt-4 mt-4 border-t border-white/10">
                <a href="{{ route('profile.edit') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-blue-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left rounded-xl px-4 py-3 text-sm font-bold text-red-400">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>