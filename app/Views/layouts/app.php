<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Lexi AI' ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

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

    <?= $this->renderSection('css') ?>

</head>

<body class="bg-zinc-50 text-zinc-800 font-sans antialiased">

<nav class="bg-white border-b border-zinc-200/60 sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center" style="max-width: 100rem;">

        <div class="text-lg font-bold tracking-tight flex items-center gap-2">
            <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                Lexi
            </span>

            <span class="text-[10px] bg-emerald-500/10 text-emerald-600 px-2 py-0.5 rounded-full border border-emerald-500/20 font-bold">
                AI
            </span>
        </div>

       <div class="relative">

            <button
                id="user-menu-button"
                type="button"
                class="flex items-center gap-4 focus:outline-none">
                
                <div class="text-right hidden sm:block">
                    <p class="font-semibold text-sm">
                        <?= esc(session('username')) ?>
                    </p>

                    <p class="text-xs text-zinc-400">
                        <?= esc(session('role') ?? 'USER') ?>
                    </p>
                </div>

                <div class="w-10 h-10 rounded-xl bg-zinc-950 text-white flex items-center justify-center text-xs font-bold">
                    <?= strtoupper(substr(session('username'), 0, 2)) ?>
                </div>

            </button>

            <!-- Dropdown -->
            <div
                id="user-menu"
                class="hidden absolute right-0 mt-3 w-52 bg-white border border-zinc-200 rounded-xl shadow-lg overflow-hidden z-50">

                <div class="px-4 py-3 border-b border-zinc-100">
                    <p class="font-semibold text-sm text-zinc-900">
                        <?= esc(session('username')) ?>
                    </p>

                    <p class="text-xs text-zinc-500">
                        <?= esc(session('role') ?? 'USER') ?>
                    </p>
                </div>

               <!--  <a href="<?= site_url('profile') ?>"
                   class="flex items-center px-4 py-3 text-sm hover:bg-zinc-50 transition">

                    👤
                    <span class="ml-3">Profile</span>

                </a> -->

                <a href="<?= site_url('logout') ?>"
                   class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">

                    🚪
                    <span class="ml-3">Logout</span>

                </a>

            </div>

        </div>

    </div>

</nav>

<div class="mx-auto p-6" style="max-width:100rem">

    <?= $this->include('components/flash_message') ?>

    <?= $this->renderSection('content') ?>

</div>

<?= $this->renderSection('js') ?>

<script>
const button = document.getElementById('user-menu-button');
const menu = document.getElementById('user-menu');

button.addEventListener('click', function (e) {
    e.stopPropagation();
    menu.classList.toggle('hidden');
});

document.addEventListener('click', function () {
    menu.classList.add('hidden');
});
</script>

</body>
</html>