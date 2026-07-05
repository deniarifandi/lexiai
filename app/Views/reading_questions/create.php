<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex justify-between items-center">

        <div>
            <a href="<?= base_url('admin/reading-materials/questions/'.$material['id']) ?>"
               class="text-sm text-zinc-500 hover:text-zinc-900">
                ← Back to Questions
            </a>

            <h1 class="text-2xl font-bold text-zinc-900 mt-2">
                Add Reading Question
            </h1>

            <p class="text-sm text-zinc-500 mt-1">
                <?= esc($material['title']) ?>
            </p>
        </div>

    </div>

    <form action="<?= base_url('admin/reading-questions/store') ?>" method="post">

        <?= csrf_field() ?>

        <input type="hidden"
               name="material_id"
               value="<?= $material['id'] ?>">

        <div class="bg-white border border-zinc-200 rounded-xl p-6 space-y-6">

            <div>

                <label class="block text-sm font-semibold text-zinc-700 mb-2">
                    Question
                </label>

                <textarea
                    name="question"
                    rows="4"
                    required
                    class="w-full rounded-lg border border-zinc-300 px-4 py-3 focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900"><?= old('question') ?></textarea>

            </div>

            <div>

                <label class="block text-sm font-semibold text-zinc-700 mb-2">
                    Reference Answer
                </label>

                <textarea
                    name="reference_answer"
                    rows="8"
                    required
                    class="w-full rounded-lg border border-zinc-300 px-4 py-3 focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900"><?= old('reference_answer') ?></textarea>

                <p class="text-xs text-zinc-500 mt-2">
                    Jawaban ideal yang akan digunakan AI sebagai acuan evaluasi.
                </p>

            </div>

            <div>

                <label class="block text-sm font-semibold text-zinc-700 mb-2">
                    Keywords
                </label>

                <input
                    type="text"
                    name="keywords"
                    value="<?= old('keywords') ?>"
                    placeholder="organic, fertilizer, pesticide"
                    class="w-full rounded-lg border border-zinc-300 px-4 py-3 focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900">

                <p class="text-xs text-zinc-500 mt-2">
                    Pisahkan dengan tanda koma (,).
                </p>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="block text-sm font-semibold text-zinc-700 mb-2">
                        Question Order
                    </label>

                    <input
                        type="number"
                        name="order_number"
                        min="1"
                        value="<?= old('order_number', 1) ?>"
                        class="w-full rounded-lg border border-zinc-300 px-4 py-3 focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900">

                </div>

            </div>

        </div>

        <div class="flex justify-end gap-3 mt-6">

            <a href="<?= base_url('admin/reading-materials/questions/'.$material['id']) ?>"
               class="px-5 py-3 border border-zinc-300 rounded-lg hover:bg-zinc-50">
                Cancel
            </a>

            <button
                type="submit"
                class="px-5 py-3 bg-zinc-900 hover:bg-zinc-800 text-white rounded-lg">
                Save Question
            </button>

        </div>

    </form>

</div>

<?= $this->endSection() ?>