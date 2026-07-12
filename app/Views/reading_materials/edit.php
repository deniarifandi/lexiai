<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-zinc-900">Edit Reading Material</h1>
            <p class="text-sm text-zinc-500">
                Perbarui informasi materi bacaan.
            </p>
        </div>

        <a href="<?= base_url('admin/reading-materials') ?>"
           class="text-sm text-zinc-600 hover:text-zinc-900">
            ← Kembali
        </a>
    </div>

    <form action="<?= base_url('admin/reading-materials/update/'.$material['id']) ?>" method="post">

        <?= csrf_field() ?>

        <div class="bg-white border border-zinc-200 rounded-xl p-6 space-y-6">

            <div>
                <label class="block text-sm font-medium mb-2">
                    Judul
                </label>

                <input
                    type="text"
                    name="title"
                    value="<?= old('title', $material['title']) ?>"
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
                        value="<?= old('topic', $material['topic']) ?>"
                        class="w-full border border-zinc-300 rounded-lg px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Level
                    </label>

                    <select
                        name="level"
                        class="w-full border border-zinc-300 rounded-lg px-4 py-3">

                        <option value="beginner" <?= $material['level']=='beginner'?'selected':'' ?>>A1 (Beginner)</option>
                        <option value="elementary" <?= $material['level']=='elementary'?'selected':'' ?>>A2 (Elementary)</option>
                        <option value="intermediate" <?= $material['level']=='intermediate'?'selected':'' ?>>B1 (Intermediate)</option>
                        <option value="upper" <?= $material['level']=='upper'?'selected':'' ?>>B2 (Upper Intermediate)</option>
                        <option value="advanced" <?= $material['level']=='advanced'?'selected':'' ?>>C1 (Advanced)</option>
                        <option value="mastery" <?= $material['level']=='mastery'?'selected':'' ?>>C2 (Proficient/Mastery)</option>

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Est. Reading Time (Minutes)
                    </label>

                    <input
                        type="number"
                        name="estimated_minutes"
                        min="1"
                        value="<?= old('estimated_minutes', $material['estimated_minutes']) ?>"
                        class="w-full border border-zinc-300 rounded-lg px-4 py-3">
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
                    required><?= old('content', $material['content']) ?></textarea>

            </div>

            <div>

                <label class="block text-sm font-medium mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border border-zinc-300 rounded-lg px-4 py-3">

                    <option value="1" <?= $material['status']==1?'selected':'' ?>>Active</option>
                    <option value="0" <?= $material['status']==0?'selected':'' ?>>Inactive</option>

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
                Update Reading Material
            </button>

        </div>

    </form>

</div>

<?= $this->endSection() ?>