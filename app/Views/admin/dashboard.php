<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-8">

    <!-- Header -->
    <div class="bg-[#090d16] rounded-2xl p-8 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,0.12),transparent_45%)]"></div>

        <div class="relative z-10">
            <span class="inline-flex px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold">
                ADMIN PANEL
            </span>

            <h1 class="text-4xl font-bold mt-4">
                Selamat Datang, <?= esc(session('username')) ?>
            </h1>

            <p class="text-zinc-400 mt-2">
                Kelola pengguna, modul pembelajaran, dan sistem Lexi AI.
            </p>
        </div>
    </div>

    <!-- Statistics -->
    <!-- <div class="grid md:grid-cols-4 gap-5">

        <div class="bg-white rounded-2xl border p-6">
            <p class="text-xs uppercase text-zinc-400">Mahasiswa</p>
            <h2 class="text-3xl font-bold mt-2">245</h2>
        </div>

        <div class="bg-white rounded-2xl border p-6">
            <p class="text-xs uppercase text-zinc-400">Modul</p>
            <h2 class="text-3xl font-bold mt-2">18</h2>
        </div>

        <div class="bg-white rounded-2xl border p-6">
            <p class="text-xs uppercase text-zinc-400">Active Today</p>
            <h2 class="text-3xl font-bold mt-2">97</h2>
        </div>

        <div class="bg-white rounded-2xl border p-6">
            <p class="text-xs uppercase text-zinc-400">Reading Test</p>
            <h2 class="text-3xl font-bold mt-2">56</h2>
        </div>

    </div> -->

    <!-- Quick Menu -->
    <div>
        <h2 class="text-xs uppercase tracking-widest text-zinc-400 font-bold mb-4">
            Menu Administrasi
        </h2>

        <div class="grid md:grid-cols-3 gap-5">

            <a href="<?= site_url('admin/users') ?>"
               class="bg-white rounded-2xl border p-6 hover:border-emerald-500 transition">
                <h3 class="font-bold">Kelola User</h3>
                <p class="text-sm text-zinc-500 mt-2">
                    Tambah, ubah, dan hapus akun mahasiswa.
                </p>
            </a>

            <a href="<?= site_url('admin/modules') ?>"
               class="bg-white rounded-2xl border p-6 hover:border-emerald-500 transition">
                <h3 class="font-bold">Kelola Modul</h3>
                <p class="text-sm text-zinc-500 mt-2">
                    Reading, Vocabulary, Pronunciation.
                </p>
            </a>

          <!--   <a href="<?= site_url('admin/reports') ?>"
               class="bg-white rounded-2xl border p-6 hover:border-emerald-500 transition">
                <h3 class="font-bold">Laporan</h3>
                <p class="text-sm text-zinc-500 mt-2">
                    Statistik pembelajaran mahasiswa.
                </p>
            </a> -->

        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-2xl border p-6">
        <h2 class="font-bold mb-5">
            Aktivitas Terbaru
        </h2>

       <!--  <div class="space-y-4 text-sm">

            <div class="flex justify-between border-b pb-3">
                <span>Budi Santoso menyelesaikan Reading 2</span>
                <span class="text-zinc-400">10 menit lalu</span>
            </div>

            <div class="flex justify-between border-b pb-3">
                <span>Admin menambahkan Modul Vocabulary</span>
                <span class="text-zinc-400">1 jam lalu</span>
            </div>

            <div class="flex justify-between">
                <span>25 mahasiswa login hari ini</span>
                <span class="text-zinc-400">Hari ini</span>
            </div>

        </div> -->
    </div>

</div>

<?= $this->endSection() ?>