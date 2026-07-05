<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto space-y-8">

      <div class="bg-[#090d16] rounded-2xl py-5 px-10 text-white relative overflow-hidden border border-white/5 shadow-sm">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,0.12),transparent_45%)]"></div>
                <div class="relative z-10 max-w-xl space-y-4">
                   
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                        Hello,  <?= esc(session('username')) ?>.
                    </h2>
                   <p id="motivation" class="text-zinc-400 text-sm leading-relaxed font-light"></p>
                   <!--  <div class="pt-2">
                        <button class="bg-emerald-500 hover:bg-emerald-400 text-slate-950 px-6 py-3 rounded-xl font-semibold text-xs tracking-wider uppercase transition-all duration-300">
                            Lanjutkan Belajar
                        </button>
                    </div> -->
                </div>
            </div>

    <div>
        <h1 class="text-3xl font-bold text-zinc-900">
            Learning Modules
        </h1>

        <p class="text-zinc-500 mt-2">
            Choose a module to begin your English for Agriculture learning.
        </p>
    </div>



    <div class="grid lg:grid-cols-3 gap-6">

        <!-- Reading -->
        <a href="<?= base_url('student/reading') ?>"
           class="group bg-white rounded-2xl border border-zinc-200 p-7 hover:border-zinc-900 hover:shadow-lg transition">

            <div class="flex justify-between items-start">

                <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">

                    <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.483 9.246 5 7.5 5A4.5 4.5 0 003 9.5V19a4.5 4.5 0 014.5-4.5c1.746 0 3.332.483 4.5 1.253m0-9.247C13.168 5.483 14.754 5 16.5 5A4.5 4.5 0 0121 9.5V19a4.5 4.5 0 00-4.5-4.5c-1.746 0-3.332.483-4.5 1.253"/>
                    </svg>

                </div>

                <span class="text-xs uppercase tracking-widest text-zinc-400">
                    Module 1
                </span>

            </div>

            <h2 class="text-xl font-bold mt-6">
                Reading
            </h2>

            <p class="text-sm text-zinc-500 mt-3 leading-relaxed">
                Read agricultural texts and answer essay questions. Your answers will be evaluated by AI.
            </p>

            <div class="mt-6 text-sm font-semibold text-zinc-900">
                Start →
            </div>

        </a>

        <!-- Vocabulary -->

        <a href="<?= base_url('student/vocabulary') ?>"
           class="group bg-white rounded-2xl border border-zinc-200 p-7 hover:border-zinc-900 hover:shadow-lg transition">

            <div class="flex justify-between items-start">

                <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center">

                    <svg class="w-7 h-7 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                    </svg>

                </div>

                <span class="text-xs uppercase tracking-widest text-zinc-400">
                    Module 2
                </span>

            </div>

            <h2 class="text-xl font-bold mt-6">
                Vocabulary in Context
            </h2>

            <p class="text-sm text-zinc-500 mt-3 leading-relaxed">
                Learn agricultural vocabulary, meanings, examples, pronunciation, and AI-assisted exercises.
            </p>

            <div class="mt-6 text-sm font-semibold text-zinc-900">
                Start →
            </div>

        </a>

        <!-- Pronunciation -->

        <a href="<?= base_url('student/pronunciation') ?>"
           class="group bg-white rounded-2xl border border-zinc-200 p-7 hover:border-zinc-900 hover:shadow-lg transition">

            <div class="flex justify-between items-start">

                <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center">

                    <svg class="w-7 h-7 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 1v22m5-18a5 5 0 01-10 0m10 8a5 5 0 01-10 0"/>
                    </svg>

                </div>

                <span class="text-xs uppercase tracking-widest text-zinc-400">
                    Module 3
                </span>

            </div>

            <h2 class="text-xl font-bold mt-6">
                Pronunciation
            </h2>

            <p class="text-sm text-zinc-500 mt-3 leading-relaxed">
                Practice speaking agricultural vocabulary and receive AI pronunciation feedback.
            </p>

            <div class="mt-6 text-sm font-semibold text-zinc-900">
                Start →
            </div>

        </a>

    </div>

</div>

<script>
const messages = [
    "Terus belajar. Kemajuan kecil setiap hari menghasilkan perubahan besar.",
    "Satu pelajaran hari ini lebih baik daripada menunda sampai besok.",
    "Practice a little every day. Consistency beats intensity.",
    "Setiap kalimat yang dipelajari membawa Anda lebih dekat ke kefasihan.",
    "Jangan takut salah. Kesalahan adalah bagian dari proses belajar bahasa.",
    "Vocabulary grows one word at a time.",
    "Latihan singkat hari ini akan mempermudah percakapan di masa depan.",
    "English becomes easier with every lesson you complete.",
    "Tetap konsisten. AI siap membantu Anda di setiap langkah.",
    "Selesaikan satu modul hari ini dan rayakan kemajuan Anda."
];

document.getElementById("motivation").textContent =
    messages[Math.floor(Math.random() * messages.length)];
</script>

<?= $this->endSection() ?>