<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto space-y-6">

    <div class="flex justify-between items-center">

        <div>
            <a href="<?= base_url('admin/reading-materials') ?>"
               class="text-sm text-zinc-500 hover:text-zinc-900">
                ← Reading Materials
            </a>

            <h1 class="text-2xl font-bold text-zinc-900 mt-2">
                <?= esc($material['title']) ?>
            </h1>

            <div class="flex gap-2 mt-2">

                <span class="text-xs bg-zinc-100 px-3 py-1 rounded-full">
                    <?= esc($material['topic']) ?>
                </span>

                <span class="text-xs bg-zinc-100 px-3 py-1 rounded-full">
                    <?= ucfirst($material['level']) ?>
                </span>

            </div>

        </div>

        <a href="<?= base_url('admin/reading-questions/create/'.$material['id']) ?>"
           class="bg-zinc-900 hover:bg-zinc-800 text-white px-4 py-2 rounded-lg text-sm">
            + Add Question
        </a>

    </div>

    <?php if(empty($questions)): ?>

        <div class="bg-white border rounded-xl p-12 text-center">

            <h3 class="font-semibold text-lg">
                Belum ada pertanyaan
            </h3>

            <p class="text-zinc-500 mt-2">
                Tambahkan pertanyaan pertama untuk materi ini.
            </p>

        </div>

    <?php else: ?>

        <div class="space-y-4">

            <?php foreach($questions as $q): ?>

                <div class="bg-white border rounded-xl p-6">

                    <div class="flex justify-between items-start">

                        <div>

                            <span class="text-xs text-zinc-500">
                                Question #<?= $q['order_number'] ?>
                            </span>

                            <h2 class="font-semibold text-zinc-900 mt-2">
                                <?= esc($q['question']) ?>
                            </h2>

                        </div>

                        <div class="flex gap-2">

                            <a href="<?= base_url('admin/reading-questions/edit/'.$q['id']) ?>"
                               class="px-3 py-2 rounded-lg border text-sm hover:bg-zinc-50">
                                Edit
                            </a>

                            <a href="<?= base_url('admin/reading-questions/delete/'.$q['id']) ?>"
                               onclick="return confirm('Delete this question?')"
                               class="px-3 py-2 rounded-lg bg-red-600 text-white text-sm">
                                Delete
                            </a>

                        </div>

                    </div>

                    <div class="mt-5">

                        <div class="text-xs uppercase tracking-wide text-zinc-400 mb-2">
                            Reference Answer
                        </div>

                        <div class="bg-zinc-50 rounded-lg p-4 text-sm leading-relaxed">
                            <?= nl2br(esc($q['reference_answer'])) ?>
                        </div>

                    </div>

                    <?php if(!empty($q['keywords'])): ?>

                        <div class="mt-5">

                            <div class="text-xs uppercase tracking-wide text-zinc-400 mb-2">
                                Keywords
                            </div>

                            <div class="flex flex-wrap gap-2">

                                <?php foreach(explode(',', $q['keywords']) as $keyword): ?>

                                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs">
                                        <?= trim($keyword) ?>
                                    </span>

                                <?php endforeach; ?>

                            </div>

                        </div>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>