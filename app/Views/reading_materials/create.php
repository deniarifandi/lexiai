<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-zinc-900">Tambah Reading Material</h1>
            <p class="text-sm text-zinc-500">
                Tambahkan materi bacaan baru.
            </p>
        </div>

        <a href="<?= base_url('admin/reading-materials') ?>"
           class="text-sm text-zinc-600 hover:text-zinc-900">
            ← Kembali
        </a>
    </div>

    <form action="<?= base_url('admin/reading-materials/store') ?>" method="post">

        <?= csrf_field() ?>

        <div class="bg-white border border-zinc-200 rounded-xl p-6 space-y-6">

            <div>
                <label class="block text-sm font-medium mb-2">
                    Judul
                </label>

                <input
                    type="text"
                    name="title"
                    class="w-full border border-zinc-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-zinc-900"
                    required>
            </div>

            <div class="grid md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Topic
                    </label>

                    <input
                        type="text"
                        name="topic"
                        class="w-full border border-zinc-300 rounded-lg px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Level
                    </label>

                    <select
                        name="level"
                        class="w-full border border-zinc-300 rounded-lg px-4 py-3">

                     
                        <option value="beginner" >A1 (Beginner)</option>
                        <option value="elementary" >A2 (Elementary)</option>
                        <option value="intermediate" >B1 (Intermediate)</option>
                        <option value="upper" >B2 (Upper Intermediate)</option>
                        <option value="advanced">C1 (Advanced)</option>
                        <option value="mastery" >C2 (Proficient/Mastery)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Est. Reading Time (Minutes)
                    </label>

                    <input
                        type="number"
                        name="estimated_minutes"
                        class="w-full border border-zinc-300 rounded-lg px-4 py-3"
                        min="1">
                </div>

            </div>

            <div>

                <label class="block text-sm font-medium mb-2">
                    Reading Content
                </label>

                <textarea
                    name="content"
                    rows="18"
                    class="w-full border border-zinc-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-zinc-900"
                    required></textarea>

            </div>

            <div>

                <label class="block text-sm font-medium mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border border-zinc-300 rounded-lg px-4 py-3">

                    <option value="1">Active</option>
                    <option value="0">Inactive</option>

                </select>

            </div>

        </div>

        <div class="flex justify-end gap-3 mt-6">

            <a href="<?= base_url('admin/reading-materials') ?>"
               class="px-5 py-3 rounded-lg border border-zinc-300 hover:bg-zinc-50">
                Cancel
            </a>

            <button
                type="submit"
                class="px-5 py-3 rounded-lg bg-zinc-900 text-white hover:bg-zinc-800">
                Save Reading Material
            </button>

        </div>

    </form>

</div>

<?= $this->endSection() ?>