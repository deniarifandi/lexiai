<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>



<div class="space-y-6">

     <div class=" mx-auto flex justify-between items-center px-6">
        <a href="<?php echo base_url('admin/modules') ?>" class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Module List
        </a>
        <div class="text-[10px] bg-zinc-950 text-white px-2.5 py-1 rounded-md font-mono tracking-widest uppercase">
           Reading Material
        </div>
    </div>

    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <div>
            <h1 class="text-xl font-bold text-zinc-900">Reading Materials</h1>
            <p class="text-sm text-zinc-500 mt-1">
                Kelola materi reading comprehension.
            </p>
        </div>

        <a href="<?= base_url('admin/reading-materials/create') ?>"
           class="bg-zinc-950 hover:bg-zinc-800 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
            + Tambah Materi
        </a>

    </div>

    <div class="bg-white border border-zinc-200 rounded-xl overflow-hidden shadow-sm">

        <table class="w-full text-sm">

            <thead class="bg-zinc-50 border-b border-zinc-200">
            <tr class="text-left text-zinc-600 uppercase text-xs tracking-wider">
                <th class="px-6 py-4 w-16">No</th>
                <th class="px-6 py-4">Title</th>
                <th class="px-6 py-4">Topic</th>
                <th class="px-6 py-4">Level</th>
                <th class="px-6 py-4">Reading Time</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-center w-44">Action</th>
            </tr>
            </thead>

            <tbody>

            <?php if (!empty($materials)): ?>

                <?php $no=1; ?>

                <?php foreach($materials as $row): ?>

                    <tr class="border-b border-zinc-100 hover:bg-zinc-50">

                        <td class="px-6 py-4">
                            <?= $no++ ?>
                        </td>

                        <td class="px-6 py-4">

                            <div class="font-semibold text-zinc-900">
                                <?= esc($row['title']) ?>
                            </div>

                        </td>

                        <td class="px-6 py-4">
                            <?= esc($row['topic']) ?>
                        </td>

                        <td class="px-6 py-4">

                            <span class="px-2 py-1 rounded bg-zinc-100 text-xs">

                                <?= ucfirst($row['level']) ?>

                            </span>

                        </td>

                        <td class="px-6 py-4">
                            <?= $row['estimated_minutes'] ?> min
                        </td>

                        <td class="px-6 py-4">

                            <?php if($row['status']) : ?>

                                <span class="bg-emerald-100 text-emerald-700 text-xs px-2 py-1 rounded">
                                    Active
                                </span>

                            <?php else: ?>

                                <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded">
                                    Inactive
                                </span>

                            <?php endif; ?>

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-2">

                                <a href="<?= base_url('admin/reading-materials/questions/'.$row['id']) ?>"
                                   class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded text-xs">
                                    Questions
                                </a>

                                <a href="<?= base_url('admin/reading-materials/edit/'.$row['id']) ?>"
                                   class="px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded text-xs">
                                    Edit
                                </a>

                                <a href="<?= base_url('admin/reading-materials/delete/'.$row['id']) ?>"
                                   onclick="return confirm('Delete this material?')"
                                   class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded text-xs">
                                    Delete
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="7" class="text-center py-12 text-zinc-500">

                        Belum ada reading material.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>