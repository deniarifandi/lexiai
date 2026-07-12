<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <div class="mx-auto flex justify-between items-center px-6">

        <a href="<?= base_url('admin/vocabularies') ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2.5"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Back to Vocabulary

        </a>

        <div class="text-[10px] bg-zinc-950 text-white px-2.5 py-1 rounded-md font-mono tracking-widest uppercase">
            Examples
        </div>

    </div>


    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <div>

            <h1 class="text-xl font-bold text-zinc-900">
                Vocabulary Examples
            </h1>

            <p class="text-sm text-zinc-500 mt-1">

                <span class="font-semibold">
                    <?= esc($vocabulary['word']) ?>
                </span>

                <span class="mx-2">•</span>

                <?= esc($vocabulary['meaning']) ?>

            </p>

        </div>

        <a href="<?= base_url('admin/vocabulary-examples/create/'.$vocabulary['id']) ?>"
           class="bg-zinc-950 hover:bg-zinc-800 text-white px-4 py-2 rounded-lg text-sm font-semibold">

            + Add Example

        </a>

    </div>


    <div class="bg-white border border-zinc-200 rounded-xl overflow-hidden shadow-sm">

        <table class="w-full text-sm">

            <thead class="bg-zinc-50 border-b border-zinc-200">

            <tr class="text-left uppercase tracking-wider text-xs text-zinc-500">

                <th class="px-6 py-4 w-16">
                    No
                </th>

                <th class="px-6 py-4">
                    Example Sentence
                </th>

                <th class="px-6 py-4">
                    Translation
                </th>

                <th class="px-6 py-4 text-center w-44">
                    Action
                </th>

            </tr>

            </thead>

            <tbody>

            <?php if(!empty($examples)): ?>

                <?php $no = 1; ?>

                <?php foreach($examples as $example): ?>

                    <tr class="border-b border-zinc-100 hover:bg-zinc-50">

                        <td class="px-6 py-4">

                            <?= $no++ ?>

                        </td>

                        <td class="px-6 py-4">

                            <div class="font-medium text-zinc-900 leading-7">

                                <?= esc($example['sentence']) ?>

                            </div>

                        </td>

                        <td class="px-6 py-4 text-zinc-600">

                            <?= esc($example['translation']) ?>

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-2">

                                <a href="<?= base_url('admin/vocabulary-examples/edit/'.$example['id']) ?>"
                                   class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs">

                                    Edit

                                </a>

                                <a href="<?= base_url('admin/vocabulary-examples/delete/'.$example['id']) ?>"
                                   onclick="return confirm('Delete this example?')"
                                   class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs">

                                    Delete

                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="4" class="py-16 text-center">

                        <div class="space-y-2">

                            <div class="text-lg font-semibold text-zinc-700">

                                No examples available

                            </div>

                            <div class="text-sm text-zinc-500">

                                Add your first example sentence for this vocabulary.

                            </div>

                        </div>

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>