<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <a href="<?= site_url('admin/users') ?>"
           class="text-sm text-emerald-600 hover:text-emerald-700">
            ← Kembali ke Kelola User
        </a>

        <h1 class="text-3xl font-bold text-zinc-900 mt-2">
            Edit User
        </h1>

        <p class="text-sm text-zinc-500 mt-1">
            Perbarui informasi pengguna.
        </p>
    </div>

    <div class="bg-white border border-zinc-200 rounded-2xl p-8">

        <form action="<?= site_url('admin/users/update/'.$user['id']) ?>"
          method="post"
          autocomplete="off"
          class="space-y-6">

            <?= csrf_field() ?>

            <div>
                <label class="block text-sm font-semibold mb-2">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    value="<?= old('username', $user['username']) ?>"
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3"
                    required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="<?= old('email', $user['email']) ?>"
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3"
                    required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">
                    Password Baru
                </label>

                 <input
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    placeholder="Kosongkan jika tidak diubah"
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">
                    Konfirmasi Password
                </label>

                   <input
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    placeholder="Kosongkan jika tidak diubah"
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">
                    Role
                </label>

                <select
                    name="role"
                    class="w-full border border-zinc-300 rounded-xl px-4 py-3">

                    <option value="user" <?= $user['role']=='user' ? 'selected' : '' ?>>
                        Mahasiswa
                    </option>

                    <option value="admin" <?= $user['role']=='admin' ? 'selected' : '' ?>>
                        Administrator
                    </option>

                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4">

                <a href="<?= site_url('admin/users') ?>"
                   class="px-6 py-3 border border-zinc-300 rounded-xl hover:bg-zinc-100">
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-semibold">
                    Simpan Perubahan
                </button>

            </div>
            
        </form>

    </div>

</div>

<?= $this->endSection() ?>