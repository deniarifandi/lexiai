<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex justify-between items-center">

        <a href="<?= base_url('admin/vocabularies') ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Back to Vocabulary

        </a>

        <div class="text-[10px] bg-zinc-950 text-white px-2.5 py-1 rounded-md font-mono uppercase tracking-widest">
            Vocabulary
        </div>

    </div>

    <div>

        <h1 class="text-2xl font-bold">
            Edit Vocabulary
        </h1>

        <p class="text-sm text-zinc-500 mt-1">
            Update vocabulary information.
        </p>

    </div>

    <form action="<?= base_url('admin/vocabularies/update/'.$vocabulary['id']) ?>" method="post">

        <?= csrf_field() ?>

        <div class="bg-white rounded-xl border border-zinc-200 shadow-sm p-8 space-y-6">

            <div>

                <label class="block text-sm font-semibold mb-2">
                    Category
                </label>

                <select
                    name="category_id"
                    class="w-full border border-zinc-300 rounded-lg px-4 py-3">

                    <?php foreach($categories as $category): ?>

                        <option
                            value="<?= $category['id'] ?>"
                            <?= $category['id'] == $vocabulary['category_id'] ? 'selected' : '' ?>>

                            <?= esc($category['name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div>

                <label class="block text-sm font-semibold mb-2">
                    Word
                </label>

                <input
                    type="text"
                    name="word"
                    value="<?= old('word', $vocabulary['word']) ?>"
                    class="w-full border border-zinc-300 rounded-lg px-4 py-3">

            </div>

            <div>

                <label class="block text-sm font-semibold mb-2">
                    Meaning
                </label>

                <input
                    type="text"
                    name="meaning"
                    value="<?= old('meaning', $vocabulary['meaning']) ?>"
                    class="w-full border border-zinc-300 rounded-lg px-4 py-3">

            </div>

            <div>

                <label class="block text-sm font-semibold mb-2">
                    English Definition
                </label>

                <textarea
                    name="definition"
                    rows="4"
                    class="w-full border border-zinc-300 rounded-lg px-4 py-3"><?= old('definition', $vocabulary['definition']) ?></textarea>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Pronunciation
                    </label>

                    <input
                        type="text"
                        name="pronunciation"
                        value="<?= old('pronunciation', $vocabulary['pronunciation']) ?>"
                        class="w-full border border-zinc-300 rounded-lg px-4 py-3">

                </div>

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Difficulty
                    </label>

                    <select
                        name="difficulty"
                        class="w-full border border-zinc-300 rounded-lg px-4 py-3">

                        <option value="Easy" <?= $vocabulary['difficulty']=='Easy'?'selected':'' ?>>Easy</option>
                        <option value="Medium" <?= $vocabulary['difficulty']=='Medium'?'selected':'' ?>>Medium</option>
                        <option value="Hard" <?= $vocabulary['difficulty']=='Hard'?'selected':'' ?>>Hard</option>

                    </select>

                </div>

            </div>

        

        </div>

        <div class="flex justify-end gap-3 mt-6">

            <a href="<?= base_url('admin/vocabularies') ?>"
               class="px-5 py-3 rounded-lg border border-zinc-300 hover:bg-zinc-100">
                Cancel
            </a>

            <button
                type="submit"
                class="px-5 py-3 bg-zinc-950 hover:bg-zinc-800 text-white rounded-lg font-semibold">
                Update Vocabulary
            </button>

        </div>

    </form>

</div>

<?= $this->endSection() ?>