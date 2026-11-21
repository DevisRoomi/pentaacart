<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PentaCart IDN - Katalog QRIS & Pesan Antar Asrama' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-mesh-editorial bg-editorial-grid font-sans text-slate-800 antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen">
    {{-- Header / Navbar --}}
    <header class="sticky top-0 z-40 bg-white/70 backdrop-blur-md border-b border-slate-200/60 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-700 to-indigo-500 flex items-center justify-center text-white font-black text-lg shadow-sm shadow-blue-500/20 group-hover:scale-105 transition-transform">
                    P
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="font-bold text-lg text-slate-900 tracking-tight">PentaCart</span>
                    <span class="text-[10px] font-extrabold uppercase px-1.5 py-0.5 rounded-md bg-blue-50 text-blue-700 border border-blue-200/60 tracking-wider">IDN</span>
                </div>
            </a>

            <nav class="flex items-center gap-2 sm:gap-3 shrink-0">
                <a href="#katalog-lapak" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-blue-700 bg-blue-50/90 hover:bg-blue-100/90 border border-blue-200/80 px-3.5 py-2 rounded-xl shadow-xs transition">
                    <span>Semua Lapak</span>
                    <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
            </nav>
        </div>
    </header>

    {{-- Main Body Slot --}}
    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
        {{ $slot }}
    </main>

    {{-- Footer Editorial --}}
    <footer class="mt-auto border-t border-slate-200/60 bg-white/40 py-6 text-center text-xs text-slate-500">
        <p class="font-medium">PentaCart IDN &copy; {{ date('Y') }} &bull; Solusi QRIS & Pesan Antar Asrama Mahasiswa</p>
    </footer>
</body>
</html>
