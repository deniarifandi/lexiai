<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-6">


    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <a href="<?= site_url('admin/dashboard') ?>"
           class="text-sm text-emerald-600 hover:text-emerald-700">
            ← Kembali ke Dashboard
        </a>
            <h1 class="text-3xl font-bold text-zinc-900">
                Kelola User
            </h1>

            <p class="text-sm text-zinc-500 mt-1">
                Manajemen akun administrator dan mahasiswa.
            </p>
        </div>

        <a href="<?= site_url('admin/users/create') ?>"
           class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-3 rounded-xl text-sm font-semibold">
            + Tambah User
        </a>

    </div>

    <!-- Filter -->
    <!-- <div class="bg-white border rounded-2xl p-5">

        <form class="grid md:grid-cols-3 gap-4">

            <input
                type="text"
                placeholder="Cari nama atau email..."
                class="border rounded-xl px-4 py-3">

            <select class="border rounded-xl px-4 py-3">
                <option>Semua Role</option>
                <option>ADMIN</option>
                <option>USER</option>
            </select>

            <button
                class="bg-zinc-900 text-white rounded-xl">
                Cari
            </button>

        </form>

    </div> -->

    <!-- Table -->
    <div class="bg-white border rounded-2xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-zinc-50">

            <tr class="text-left text-xs uppercase text-zinc-500">

                <th class="px-6 py-4">Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th class="text-center">Aksi</th>

            </tr>

            </thead>

            <tbody class="divide-y">

            <?php foreach($users as $user): ?>

            <tr class="hover:bg-zinc-50">

                <td class="px-6 py-5">

                    <div>

                        <p class="font-semibold">
                            <?= esc($user['username']) ?>
                        </p>

                    </div>

                </td>

                <td>
                    <?= esc($user['email']) ?>
                </td>

                <td>

                    <?php if($user['role']=='admin'): ?>

                        <span class="px-2 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">
                            Admin
                        </span>

                    <?php else: ?>

                        <span class="px-2 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">
                            Student
                        </span>

                    <?php endif; ?>

                </td>

                <td>

                    <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                        Aktif
                    </span>

                </td>

                <td>

                    <div class="flex justify-center gap-2">

                        <a href="<?= site_url('admin/users/edit/'.$user['id']) ?>"
                           class="px-3 py-2 rounded-lg border text-xs hover:bg-zinc-100">

                            Edit

                        </a>

                        <a
                            href="<?= site_url('admin/users/delete/'.$user['id']) ?>"
                            onclick="return confirm('Hapus user ini?')"
                            class="px-3 py-2 rounded-lg bg-red-500 text-white text-xs">

                            Hapus

                        </a>

                    </div>

                </td>

            </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>