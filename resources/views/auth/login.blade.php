<x-guest-layout>
    <style>
        body {
            background-color: #0f172a !important;
        }

        /* Menyembunyikan komponen pembungkus default bawaan guest layout */
        .min-h-screen.bg-gray-100,
        .min-h-screen.bg-slate-100,
        div[class*="bg-gray-100"],
        div[class*="bg-slate-100"] {
            background-color: #0f172a !important;
            background: #0f172a !important;
            padding: 0 !important;
            box-shadow: none !important;
        }

        /* Menyembunyikan kotak putih bawaan */
        div.w-full.sm:max-w-md.bg-white,
        div[class*="bg-white"] {
            background-color: transparent !important;
            box-shadow: none !important;
            border: none !important;
        }

        /* Menyembunyikan logo Laravel default di atas */
        svg.w-20.h-20.fill-current.text-gray-500 {
            display: none !important;
        }
    </style>

    <div
        class="fixed inset-0 min-h-screen w-screen flex items-center justify-center bg-[#0f172a] font-sans antialiased px-4 sm:px-6 z-50 overflow-y-auto py-8">

        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 opacity-30 blur-[130px] pointer-events-none animate-pulse"
            style="animation-duration: 8s;"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] rounded-full bg-gradient-to-tr from-blue-600 to-emerald-500 opacity-25 blur-[150px] pointer-events-none animate-pulse"
            style="animation-duration: 12s;"></div>

        <div class="w-full max-w-md my-auto relative z-10">

            <div class="flex flex-col items-center mb-6 text-center">
                <div
                    class="p-3 bg-white rounded-full border border-white/20 shadow-xl mb-4 transform hover:scale-105 transition-transform duration-300 w-20 h-20 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('build/assets/img/logo_mediatama.jpeg') }}" alt="Logo Mediatama"
                        class="w-full h-full object-contain">
                </div>
                <h1 class="text-xl font-black text-white tracking-wider uppercase">MONITORING MAGANG</h1>
                <p class="text-[10px] text-indigo-300/80 tracking-widest uppercase font-semibold mt-0.5">Portal Akses
                    Sistem</p>
            </div>

            <div
                class="bg-white/[0.06] backdrop-blur-xl rounded-3xl p-6 sm:p-8 border border-white/10 shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] relative overflow-hidden">

                <div
                    class="absolute top-0 inset-x-0 h-[1px] bg-gradient-to-r from-transparent via-white/20 to-transparent">
                </div>

                <div class="mb-5 text-center">
                    <h2 class="text-lg font-bold text-white tracking-tight">Selamat Datang</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Silakan masukkan akun Anda untuk masuk ke dashboard.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')"
                            class="text-slate-300 font-medium text-xs tracking-wide mb-1" />
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-indigo-400 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email"
                                class="block w-full pl-12 pr-4 py-2.5 bg-white/[0.04] border border-white/10 rounded-2xl focus:bg-white/[0.08] focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-200 text-sm text-white placeholder-slate-500 outline-none"
                                type="email" name="email" :value="old('email')" required autofocus
                                autocomplete="username" placeholder="Masukkan alamat email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-400" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <x-input-label for="password" :value="__('Password')"
                                class="text-slate-300 font-medium text-xs tracking-wide" />
                            @if (Route::has('password.request'))
                                {{-- <a class="text-xs font-medium text-indigo-400 hover:text-indigo-300 transition-colors duration-150 focus:outline-none"
                                    href="{{ route('password.request') }}">
                                    {{ __('Lupa?') }}
                                </a> --}}
                            @endif
                        </div>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-indigo-400 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password"
                                class="block w-full pl-12 pr-4 py-2.5 bg-white/[0.04] border border-white/10 rounded-2xl focus:bg-white/[0.08] focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-200 text-sm text-white placeholder-slate-500 outline-none"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-400" />
                    </div>

                    {{-- <div class="flex items-center pt-0.5">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-white/10 bg-white/[0.04] text-indigo-500 focus:ring-indigo-500/30 focus:ring-offset-0 w-4 h-4 cursor-pointer transition-colors"
                                name="remember">
                            <span
                                class="ms-2.5 text-xs font-medium text-slate-400 group-hover:text-slate-300 transition-colors select-none">{{ __('Ingat sesi saya') }}</span>
                        </label>
                    </div> --}}

                    <div class="flex items-center justify-center pt-4 w-full">
                        {{-- <a class="text-xs font-medium text-indigo-400 hover:text-indigo-300 transition-colors duration-150 focus:outline-none focus:underline"
        href="{{ route('register') }}">
        {{ __('Belum punya akun?') }}
    </a> --}}

                        <button type="submit"
                            class="w-full sm:w-auto py-2.5 px-8 bg-gradient-to-r from-indigo-600 to-[#4f46e5] hover:from-indigo-500 hover:to-indigo-600 text-white font-bold rounded-2xl shadow-lg shadow-indigo-600/30 hover:shadow-xl hover:shadow-indigo-500/40 active:scale-[0.98] transition-all duration-200 text-sm tracking-wider text-center focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-[#0f172a]">
                            {{ __('MASUK') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-6 text-xs text-slate-500 tracking-wide">
                &copy; {{ date('Y') }} Monitoring Magang.
            </div>

        </div>
    </div>
</x-guest-layout>
