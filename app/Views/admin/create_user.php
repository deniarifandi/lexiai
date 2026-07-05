<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div>
        <a href="<?= site_url('admin/users') ?>"
           class="text-sm text-emerald-600 hover:text-emerald-700">
            ← Kembali ke Kelola User
        </a>

        <h1 class="text-3xl font-bold text-zinc-900 mt-2">
            Tambah User
        </h1>

        <p class="text-sm text-zinc-500 mt-1">
            Tambahkan akun administrator atau mahasiswa.
        </p>
    </div>

    <div class="bg-white border border-zinc-200 rounded-2xl p-8">

        <form action="<?= site_url('admin/users/store') ?>" method="post" class="space-y-6" autocomplete="off">
              <input type="text"
                       name="fake_username"
                       autocomplete="username"
                       tabindex="-1"
                       style="position:absolute;left:-9999px;">

                <input type="password"
                       name="fake_password"
                       autocomplete="current-password"
                       tabindex="-1"
                       style="position:absolute;left:-9999px;">

                       <?= csrf_field() ?>

            <!-- Username -->
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    value="<?= old('username') ?>"
                    required
                      autocomplete="new-email"
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3 focus:border-emerald-500 focus:ring-emerald-500">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                     autocomplete="new-password"
                    value="<?= old('email') ?>"
                    required
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3 focus:border-emerald-500 focus:ring-emerald-500">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3 focus:border-emerald-500 focus:ring-emerald-500">
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirm"
                    required
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3 focus:border-emerald-500 focus:ring-emerald-500">
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Role
                </label>

                <select
                    name="role"
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3">

                    <option value="user">Mahasiswa</option>
                    <option value="admin">Administrator</option>

                </select>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3">

                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>

                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4">

                <a href="<?= site_url('admin/users') ?>"
                   class="px-6 py-3 rounded-xl border border-zinc-300 hover:bg-zinc-100">
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-semibold">
                    Simpan User
                </button>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>