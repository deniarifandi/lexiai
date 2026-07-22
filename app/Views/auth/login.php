<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lexi AI</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="<?= base_url() ?>logolexiaismall.png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-zinc-50 font-sans antialiased text-zinc-800">

<div class="min-h-screen flex">

    <!-- Left Side: Futuristic Dashboard Vibe -->
    <div class="hidden lg:flex lg:w-1/2 bg-[#090d16] text-white items-center justify-center p-16 relative overflow-hidden border-r border-white/5">
        <!-- Graphic Effects -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(16,185,129,0.1),transparent_50%)]"></div>
        <div class="absolute top-1/3 right-10 w-72 h-72 bg-emerald-500/5 rounded-full blur-[100px]"></div>
        
        <div class="max-w-md relative z-10 space-y-8">
            <img
        src="<?= base_url() ?>logolexiai.png"
        alt="Lexi AI"
        class="h-10 w-auto"
    >

            <div class="space-y-4">
                <h1 class="text-4xl font-extrabold tracking-tight leading-tight">
                    Masuk ke Pusat Kendali Belajar Anda.
                </h1>
                <p class="text-zinc-400 text-sm leading-relaxed font-light">
                    Kembangkan efisiensi berbahasa Inggris akademik agrikultur bersama asisten AI personal Anda.
                </p>
            </div>

            <div class="pt-6 space-y-4 border-t border-white/5">
                <div class="flex items-center gap-4 bg-white/[0.02] border border-white/5 p-4 rounded-xl">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 text-xs font-bold">01</div>
                    <span class="text-sm font-medium text-zinc-300">Reading Comprehension Analyzer</span>
                </div>

                <div class="flex items-center gap-4 bg-white/[0.02] border border-white/5 p-4 rounded-xl">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 text-xs font-bold">02</div>
                    <span class="text-sm font-medium text-zinc-300">Contextual Vocabulary Database</span>
                </div>

                <div class="flex items-center gap-4 bg-white/[0.02] border border-white/5 p-4 rounded-xl">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 text-xs font-bold">03</div>
                    <span class="text-sm font-medium text-zinc-300">Real-time Pronunciation Engine</span>
                </div>
            </div>
            
            <p class="text-xs text-zinc-500 font-mono pt-4">SYSTEM STATUS: OPERATIONAL</p>
        </div>
    </div>

    <!-- Right Side: Minimalist Login Form -->
    <div class="flex-1 flex justify-center items-center p-6 sm:p-12 bg-white">
        <div class="w-full max-w-md space-y-8">
            
            <div class="space-y-2">
                <!-- Mobile Logo Only -->
                <div class="lg:hidden inline-flex items-center gap-2 mb-4">
                    <span class="text-lg font-bold tracking-tight text-zinc-900">Lexi</span>
                    <span class="text-[9px] bg-emerald-500/10 text-emerald-600 px-2 py-0.5 rounded-full border border-emerald-500/20 font-bold">AI</span>
                </div>
                
                <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-zinc-900">
                    Autentikasi Pengguna
                </h2>
                <p class="text-zinc-500 text-sm font-light">
                    Silakan masukkan kredensial akun Anda untuk melanjutkan sesi pembelajaran.
                </p>
            </div>

            <form class="space-y-5" action="<?= site_url('login') ?>" method="post">

            <?= csrf_field() ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <div class="space-y-1.5">
                <label class="text-xs font-bold uppercase tracking-wider text-zinc-500">
                    Alamat Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="<?= old('email') ?>"
                    placeholder="nama@mahasiswa.ac.id"
                    autocomplete="email"
                    required
                    class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-4 py-3.5 text-sm font-medium placeholder-zinc-400 text-zinc-800 transition-all focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
            </div>

            <div class="space-y-1.5">
                <div class="flex justify-between items-center">
                    <label class="text-xs font-bold uppercase tracking-wider text-zinc-500">
                        Kata Sandi
                    </label>

                    <a href="#" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                        Lupa sandi?
                    </a>
                </div>

                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    autocomplete="current-password"
                    required
                    class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-4 py-3.5 text-sm font-medium placeholder-zinc-400 text-zinc-800 transition-all focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2.5 cursor-pointer select-none">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        
                        class="w-4 h-4 rounded text-emerald-600 border-zinc-300 focus:ring-emerald-500/20 accent-emerald-600">

                    <span class="text-xs font-medium text-zinc-600">
                        Biarkan saya tetap masuk
                    </span>
                </label>
            </div>

           <div class="grid grid-cols-2 gap-3 pt-2">

    <!-- Kembali -->
    <a
        href="<?= site_url('/') ?>"
        class="flex items-center justify-center border border-zinc-300 bg-white hover:bg-zinc-50 text-zinc-700 py-3.5 rounded-xl text-sm font-semibold transition-all"
    >
        Kembali
    </a>

    <!-- Masuk -->
    <button
        type="submit"
        class="bg-zinc-950 hover:bg-zinc-900 text-white py-3.5 rounded-xl text-sm font-semibold tracking-wide transition-all shadow-sm active:scale-[0.99]"
    >
        Masuk
    </button>

</div>

<!-- Register -->
<div class="pt-3 text-center">

    <p class="text-sm text-zinc-500">
        Belum memiliki akun?

        <a
            href="<?= site_url('register') ?>"
            class="font-bold text-emerald-600 hover:text-emerald-700 transition-colors"
        > 
            Daftar sekarang
        </a>
    </p>

</div>
        </form>

          <!--   <div class="flex items-center my-6">
                <div class="flex-1 h-px bg-zinc-100"></div>
                <span class="px-4 text-zinc-400 text-[10px] font-bold tracking-widest uppercase">Atau gunakan</span>
                <div class="flex-1 h-px bg-zinc-100"></div>
            </div>

            <button
                class="w-full bg-white border border-zinc-200 py-3.5 rounded-xl text-sm font-semibold text-zinc-700 hover:bg-zinc-50 hover:border-zinc-300 transition-all flex justify-center items-center gap-3 active:scale-[0.99]">
                <img
                    src="https://www.svgrepo.com/show/475656/google-color.svg"
                    class="w-4 h-4" alt="Google">
                Masuk dengan Akun Google
            </button> -->

            <!-- <p class="text-center text-xs text-zinc-500 pt-2 font-medium">
                Baru di Lexi? 
                <a href="#" class="text-emerald-600 font-bold hover:text-emerald-700 transition-colors">
                    Buat Akun Baru
                </a>
            </p> -->

        </div>
    </div>

</div>

</body>
</html>