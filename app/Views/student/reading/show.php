<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Breadcrumb -->
    <div class="text-xs font-medium text-zinc-400 uppercase tracking-wider flex items-center gap-2">
        <a href="<?= site_url('dashboard') ?>" class="hover:text-zinc-600 transition-colors">
            Dashboard
        </a>
        <span>/</span>
        <a href="<?= site_url('student/reading') ?>" class="hover:text-zinc-600 transition-colors">
            Reading
        </a>
        <span>/</span>
        <span class="text-zinc-900">
            <?= esc($material['title']) ?>
        </span>
    </div>

    <!-- Hero -->
    <div class="bg-[#090d16] rounded-2xl p-8 sm:p-10 text-white relative overflow-hidden border border-white/5">

        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,.12),transparent_45%)]"></div>

        <div class="relative z-10">

            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] uppercase tracking-widest bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold">
                <?= ucfirst($material['level']) ?>
            </span>

            <h1 class="text-4xl font-extrabold mt-4">
                <?= esc($material['title']) ?>
            </h1>

            <?php if (!empty($material['topic'])): ?>
                <p class="text-emerald-300 mt-2">
                    <?= esc($material['topic']) ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($material['description'])): ?>
                <p class="text-zinc-400 mt-6 max-w-3xl leading-relaxed">
                    <?= esc($material['description']) ?>
                </p>
            <?php endif; ?>

        </div>

    </div>

    <div class="grid lg:grid-cols-12 gap-8">

        <!-- Left -->
        <div class="lg:col-span-8 space-y-6">

            <div class="bg-white rounded-2xl border border-zinc-200 p-6">

                <h2 class="text-lg font-bold text-zinc-900 mb-5">
                    Reading Information
                </h2>

                <div class="grid md:grid-cols-3 gap-5">

                    <div class="border rounded-xl p-5">

                        <p class="text-xs uppercase tracking-widest text-zinc-400">
                            Level
                        </p>

                        <p class="mt-2 font-semibold">
                            <?= ucfirst($material['level']) ?>
                        </p>

                    </div>

                    <div class="border rounded-xl p-5">

                        <p class="text-xs uppercase tracking-widest text-zinc-400">
                            Duration
                        </p>

                        <p class="mt-2 font-semibold">
                            <?= esc($material['estimated_minutes']) ?> Minutes
                        </p>

                    </div>

                    <div class="border rounded-xl p-5">

                        <p class="text-xs uppercase tracking-widest text-zinc-400">
                            Questions
                        </p>

                        <p class="mt-2 font-semibold">
                            <?= esc($material['total_questions']) ?> Essay
                        </p>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl border border-zinc-200 p-6">

                <h2 class="text-lg font-bold mb-4">
                    Instructions
                </h2>

                <ul class="space-y-3 text-sm text-zinc-600">

                    <li>✓ Read the passage carefully before answering.</li>

                    <li>✓ Answer every question in English.</li>

                    <li>✓ Use your own words whenever possible.</li>

                    <li>✓ Avoid copying sentences directly from the passage.</li>

                    <li>✓ AI will evaluate comprehension, grammar, vocabulary, and writing quality.</li>

                </ul>

            </div>

        </div>

        <!-- Right -->
        <div class="lg:col-span-4 space-y-6">

            <div class="bg-white rounded-2xl border border-zinc-200 p-6">

                <h3 class="font-bold text-zinc-900">
                    Ready to Start?
                </h3>

                <p class="text-sm text-zinc-500 mt-3 leading-relaxed">
                    Once you start, read the passage carefully and answer each question before submitting your work.
                </p>

                <div class="mt-6 space-y-3">

                    <a href="<?= site_url('student/reading/test/'.$material['id']) ?>"
                       class="w-full inline-flex justify-center items-center bg-zinc-900 hover:bg-zinc-800 text-white py-3 rounded-xl font-semibold transition">

                        Start Reading Test

                    </a>

                    <a href="<?= site_url('student/reading') ?>"
                       class="w-full inline-flex justify-center items-center border border-zinc-300 py-3 rounded-xl font-semibold hover:bg-zinc-50 transition">

                        Back to Reading List

                    </a>

                </div>

            </div>

            <div class="bg-white rounded-2xl border border-zinc-200 p-6">

                <h3 class="text-sm font-bold uppercase tracking-widest text-zinc-400">
                    AI Assessment
                </h3>

                <ul class="mt-5 space-y-3 text-sm text-zinc-600">

                    <li>• Reading Comprehension</li>

                    <li>• Grammar Accuracy</li>

                    <li>• Vocabulary Usage</li>

                    <li>• Writing Clarity</li>

                    <li>• Improvement Suggestions</li>

                </ul>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>