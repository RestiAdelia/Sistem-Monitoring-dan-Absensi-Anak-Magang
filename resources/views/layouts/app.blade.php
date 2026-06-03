<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <div class="lg:pl-72 xl:pl-80 transition-all duration-300">
                @isset($header)
                    <header class="bg-[#0B1329] text-white sticky top-0 z-10 border-b border-slate-800">
                        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 flex items-center justify-between">

                            <div class="font-bold text-white [&&_h2]:text-white [&&_h2]:font-bold [&&_h2]:text-xl [&&_h2]:tracking-tight">
                                {{ $header }}
                            </div>

                            <div class="text-[11px] font-bold uppercase tracking-wider text-slate-300 bg-white/10 border border-white/10 px-3.5 py-1.5 rounded-xl backdrop-blur-sm">
                                {{ Auth::user()->role ?? 'Mentor' }} Mode
                            </div>
                        </div>
                    </header>
                @endisset

                <main class="py-8 px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
