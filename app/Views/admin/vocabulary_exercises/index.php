<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <div class="flex justify-between items-center">

        <a href="<?= base_url('admin/vocabularies') ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Back to Vocabulary

        </a>

        <div class="text-[10px] bg-zinc-950 text-white px-2 py-1 rounded font-mono uppercase">
            Exercises
        </div>

    </div>

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-xl font-bold">

                Vocabulary Exercises

            </h1>

            <p class="text-sm text-zinc-500 mt-1">

                <strong><?= esc($vocabulary['word']) ?></strong>

            </p>

        </div>

        <a href="<?= base_url('admin/vocabulary-exercises/create/'.$vocabulary['id']) ?>"
           class="bg-zinc-950 text-white px-4 py-2 rounded-lg">

            + Add Exercise

        </a>

    </div>

    <div class="bg-white rounded-xl border border-zinc-200 overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-zinc-50">

            <tr>

                <th class="px-6 py-4 w-16">No</th>
                <th class="px-6 py-4">Question</th>
                <th class="px-6 py-4">Expected Answer</th>
                <th class="px-6 py-4">Difficulty</th>
                <th class="px-6 py-4 text-center">Action</th>

            </tr>

            </thead>

            <tbody>

            <?php if($exercises): ?>

                <?php $no=1; ?>

                <?php foreach($exercises as $row): ?>

                <tr class="border-t">

                    <td class="px-6 py-4"><?= $no++ ?></td>

                    <td class="px-6 py-4">
                        <?= esc($row['question']) ?>
                    </td>

                    <td class="px-6 py-4">
                        <?= esc($row['expected_answer']) ?>
                    </td>

                    <td class="px-6 py-4">

                        <span class="px-2 py-1 rounded bg-zinc-100 text-xs">

                            <?= $row['difficulty'] ?>

                        </span>

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex justify-center gap-2">

                            <a href="<?= base_url('admin/vocabulary-exercises/edit/'.$row['id']) ?>"
                               class="bg-blue-600 text-white px-3 py-1 rounded text-xs">

                                Edit

                            </a>

                            <a href="<?= base_url('admin/vocabulary-exercises/delete/'.$row['id']) ?>"
                               onclick="return confirm('Delete?')"
                               class="bg-red-600 text-white px-3 py-1 rounded text-xs">

                                Delete

                            </a>

                        </div>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="5" class="text-center py-12 text-zinc-500">

                        No exercises available.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>