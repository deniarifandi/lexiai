<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <div class="mx-auto flex justify-between items-center px-6">

        <a href="<?= base_url('admin/modules') ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2 transition-colors">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Kembali ke Module List

        </a>

        <div class="text-[10px] bg-zinc-950 text-white px-2.5 py-1 rounded-md font-mono tracking-widest uppercase">
            Vocabulary
        </div>

    </div>


    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <div>

            <h1 class="text-xl font-bold text-zinc-900">
                Vocabulary List
            </h1>

            <p class="text-sm text-zinc-500 mt-1">
                Kelola kosakata bahasa Inggris bidang pertanian.
            </p>

        </div>

        <a href="<?= base_url('admin/vocabularies/create') ?>"
           class="bg-zinc-950 hover:bg-zinc-800 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">

            + Tambah Vocabulary

        </a>

    </div>


    <div class="bg-white border border-zinc-200 rounded-xl shadow-sm">

      <!--   <div class="p-5 border-b border-zinc-200">

            <form method="get">

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="keyword"
                        value="<?= esc($_GET['keyword'] ?? '') ?>"
                        placeholder="Search vocabulary..."
                        class="flex-1 border border-zinc-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-zinc-900 focus:outline-none">

                    <button
                        class="px-5 py-2 bg-zinc-900 text-white rounded-lg text-sm">

                        Search

                    </button>

                </div>

            </form>

        </div> -->


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-zinc-50 border-b border-zinc-200">

                <tr class="text-left uppercase tracking-wider text-xs text-zinc-500">

                    <th class="px-6 py-4 w-16">
                        No
                    </th>

                    <th class="px-6 py-4">
                        Word
                    </th>

                    <th class="px-6 py-4">
                        Category
                    </th>

                    <th class="px-6 py-4">
                        Meaning
                    </th>

                    <th class="px-6 py-4">
                        Difficulty
                    </th>

                    <th class="px-6 py-4 text-center" style="display:none">
                        Examples
                    </th>

                    <th class="px-6 py-4 text-center" style="display:none">
                        Exercises
                    </th>

                    <th class="px-6 py-4 text-center">
                        Action
                    </th>

                </tr>

                </thead>

                <tbody>

                <?php if(!empty($vocabularies)): ?>

                    <?php $no=1; ?>

                    <?php foreach($vocabularies as $row): ?>

                        <tr class="border-b border-zinc-100 hover:bg-zinc-50">

                            <td class="px-6 py-4">
                                <?= $no++ ?>
                            </td>

                            <td class="px-6 py-4">

                                <div class="font-semibold text-zinc-900">
                                    <?= esc($row['word']) ?>
                                </div>

                                <?php if(!empty($row['pronunciation'])): ?>

                                    <div class="text-xs text-zinc-400 mt-1">
                                        <?= esc($row['pronunciation']) ?>
                                    </div>

                                <?php endif; ?>

                            </td>

                            <td class="px-6 py-4">

                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">

                                    <?= esc($row['category']) ?>

                                </span>

                            </td>

                            <td class="px-6 py-4">
                                <?= esc($row['meaning']) ?>
                            </td>

                            <td class="px-6 py-4">

                                <?php

                                $badge = match(strtolower($row['difficulty'])){

                                    'easy' => 'bg-green-100 text-green-700',

                                    'medium' => 'bg-yellow-100 text-yellow-700',

                                    'hard' => 'bg-red-100 text-red-700',

                                    default => 'bg-zinc-100 text-zinc-700'

                                };

                                ?>

                                <span class="<?= $badge ?> px-2 py-1 rounded text-xs">

                                    <?= esc($row['difficulty']) ?>

                                </span>

                            </td>

                            <td class="px-6 py-4 text-center" style="display:none">

                                <a href="<?= base_url('admin/vocabularies/examples/'.$row['id']) ?>"
                                   class="inline-flex items-center justify-center px-3 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded text-xs">

                                    Examples

                                </a>

                            </td>

                            <td class="px-6 py-4 text-center" style="display:none">

                                <a href="<?= base_url('admin/vocabularies/exercises/'.$row['id']) ?>"
                                   class="inline-flex items-center justify-center px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded text-xs">

                                    Exercises

                                </a>

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="<?= base_url('admin/vocabularies/edit/'.$row['id']) ?>"
                                       class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs">

                                        Edit

                                    </a>

                                    <a href="<?= base_url('admin/vocabularies/delete/'.$row['id']) ?>"
                                       onclick="return confirm('Delete this vocabulary?')"
                                       class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs">

                                        Delete

                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="8" class="text-center py-16">

                            <div class="space-y-2">

                                <div class="text-lg font-semibold text-zinc-700">
                                    No vocabulary found
                                </div>

                                <div class="text-sm text-zinc-500">
                                    Start by adding your first agricultural vocabulary.
                                </div>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>