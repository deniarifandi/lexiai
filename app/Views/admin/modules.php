<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto space-y-8">

    <div>
         <a href="<?= site_url('admin/dashboard') ?>"
           class="text-sm text-emerald-600 hover:text-emerald-700">
            ← Kembali ke Dashboard
        </a>
        <h1 class="text-2xl font-bold text-zinc-900">
            Learning Modules
        </h1>

        <p class="text-sm text-zinc-500 mt-2">
            Kelola seluruh modul pembelajaran English for Agriculture.
        </p>
    </div>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">

        <!-- Reading -->
        <a href="<?= base_url('admin/reading-materials') ?>"
           class="group bg-white border border-zinc-200 rounded-2xl p-6 hover:border-zinc-900 hover:shadow-lg transition">

            <div class="flex items-center justify-between">

                <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">

                    <svg class="w-7 h-7 text-blue-700"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.483 9.246 5 7.5 5A4.5 4.5 0 003 9.5V19a4.5 4.5 0 014.5-4.5c1.746 0 3.332.483 4.5 1.253m0-9.247C13.168 5.483 14.754 5 16.5 5A4.5 4.5 0 0121 9.5V19a4.5 4.5 0 00-4.5-4.5c-1.746 0-3.332.483-4.5 1.253"/>

                    </svg>

                </div>

                <span class="text-xs uppercase tracking-wider text-zinc-400">
                    Module
                </span>

            </div>

            <h2 class="text-lg font-bold mt-6">
                Reading
            </h2>

            <p class="text-sm text-zinc-500 mt-2">
                Kelola reading materials, essay questions, dan evaluasi AI.
            </p>

        </a>

        <!-- Vocabulary -->

        <a href="<?= base_url('admin/vocabularies') ?>"
           class="group bg-white border border-zinc-200 rounded-2xl p-6 hover:border-zinc-900 hover:shadow-lg transition">

            <div class="flex items-center justify-between">

                <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center">

                    <svg class="w-7 h-7 text-emerald-700"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>

                    </svg>

                </div>

                <span class="text-xs uppercase tracking-wider text-zinc-400">
                    Module
                </span>

            </div>

            <h2 class="text-lg font-bold mt-6">
                Vocabulary in Context
            </h2>

            <p class="text-sm text-zinc-500 mt-2">
                Kelola vocabulary, contoh kalimat, audio, dan latihan.
            </p>

        </a>

        <!-- Pronunciation -->

        <a href="<?= base_url('pronunciation') ?>"
           class="group bg-white border border-zinc-200 rounded-2xl p-6 hover:border-zinc-900 hover:shadow-lg transition">

            <div class="flex items-center justify-between">

                <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center">

                    <svg class="w-7 h-7 text-purple-700"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 1v22m5-18a5 5 0 01-10 0m10 8a5 5 0 01-10 0"/>

                    </svg>

                </div>

                <span class="text-xs uppercase tracking-wider text-zinc-400">
                    Module
                </span>

            </div>

            <h2 class="text-lg font-bold mt-6">
                Pronunciation
            </h2>

            <p class="text-sm text-zinc-500 mt-2">
                Kelola latihan pengucapan dan penilaian AI.
            </p>

        </a>

    </div>

</div>

<?= $this->endSection() ?>