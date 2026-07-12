<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex justify-between items-center">

        <a href="<?= base_url('admin/vocabularies/examples/'.$vocabulary['id']) ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2.5"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Back to Examples

        </a>

        <div class="text-[10px] bg-zinc-950 text-white px-2.5 py-1 rounded-md font-mono uppercase tracking-widest">
            Example
        </div>

    </div>

    <div>

        <h1 class="text-2xl font-bold">
            Edit Vocabulary Example
        </h1>

        <p class="text-sm text-zinc-500 mt-1">

            Vocabulary:
            <span class="font-semibold">
                <?= esc($vocabulary['word']) ?>
            </span>

        </p>

    </div>

    <form action="<?= base_url('admin/vocabulary-examples/update/'.$example['id']) ?>" method="post">

        <?= csrf_field() ?>

        <div class="bg-white rounded-xl border border-zinc-200 shadow-sm p-8 space-y-6">

            <div>

                <label class="block text-sm font-semibold mb-2">
                    Example Sentence
                </label>

                <textarea
                    name="sentence"
                    rows="4"
                    required
                    class="w-full border border-zinc-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-zinc-900 focus:outline-none"><?= old('sentence', $example['sentence']) ?></textarea>

            </div>

            <div>

                <label class="block text-sm font-semibold mb-2">
                    Indonesian Translation
                </label>

                <textarea
                    name="translation"
                    rows="3"
                    class="w-full border border-zinc-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-zinc-900 focus:outline-none"><?= old('translation', $example['translation']) ?></textarea>

            </div>

        </div>

        <div class="flex justify-end gap-3 mt-6">

            <a href="<?= base_url('admin/vocabularies/examples/'.$vocabulary['id']) ?>"
               class="px-5 py-3 rounded-lg border border-zinc-300 hover:bg-zinc-100">

                Cancel

            </a>

            <button
                type="submit"
                class="px-5 py-3 bg-zinc-950 hover:bg-zinc-800 text-white rounded-lg font-semibold">

                Update Example

            </button>

        </div>

    </form>

</div>

<?= $this->endSection() ?>