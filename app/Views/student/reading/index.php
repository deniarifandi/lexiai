<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Breadcrumb -->
    <div class="text-xs font-medium text-zinc-400 uppercase tracking-wider flex items-center gap-2">
        <a href="<?= site_url('dashboard') ?>" class="hover:text-zinc-600 transition-colors">Dashboard</a>
        <span>/</span>
        <span class="text-zinc-900">Reading Comprehension</span>
    </div>

    <!-- HERO / STATS OVERVIEW -->
    <div class="bg-[#090d16] rounded-2xl p-8 sm:p-10 text-white relative overflow-hidden border border-white/5 shadow-sm">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,0.12),transparent_45%)]"></div>

        <div class="relative z-10 flex flex-col lg:flex-row justify-between gap-8 items-start lg:items-center">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full text-[10px] font-bold tracking-wider text-emerald-400 uppercase">
                    Modul 01
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    Reading Comprehension
                </h1>
                <p class="text-zinc-400 text-sm leading-relaxed font-light">
                    Pertajam kemampuan pemahaman bacaan akademik melalui artikel berbasis sains pertanian global. Analisis teks secara mendalam, jawab esai pendek, dan dapatkan evaluasi sintaksis langsung dari kecerdasan buatan.
                </p>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT GRID -->
    <div class="grid lg:grid-cols-12 gap-8 pt-4">

        <!-- LEFT: LESSON LIST (8 Cols) -->
        <div class="lg:col-span-8 space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400 mb-4">Daftar Pelajaran Tersedia</h3>

            <?php
            $levelOrder = ['beginner', 'elementary', 'intermediate', 'upper', 'advanced', 'mastery'];
            $passThreshold = 80;
            $previousPassed = true; // beginner always unlocked

            $badge = [
                'beginner'     => 'text-emerald-600 bg-emerald-50',
                'elementary'   => 'text-teal-600 bg-teal-50',
                'intermediate' => 'text-amber-600 bg-amber-50',
                'upper'        => 'text-orange-600 bg-orange-50',
                'advanced'     => 'text-red-600 bg-red-50',
                'mastery'      => 'text-purple-600 bg-purple-50',
            ];
            ?>

            <?php foreach ($levelOrder as $level): ?>

                <?php
                $items = $materials[$level] ?? [];
                $isLocked = !$previousPassed;

                $levelPassed = false;
                if (!$isLocked && !empty($items)) {
                    foreach ($items as $item) {
                        if ($item['highest_score'] >= $passThreshold) {
                            $levelPassed = true;
                            break;
                        }
                    }
                }
                ?>

                <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400 mt-8 flex items-center gap-2">
                    <?= ucfirst($level) ?>
                    <?php if ($isLocked): ?>
                        <span class="inline-flex items-center gap-1 text-[10px] text-zinc-400 font-medium normal-case tracking-normal">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v2"/>
                            </svg>
                            Selesaikan level sebelumnya dengan skor 80+ untuk membuka
                        </span>
                    <?php endif; ?>
                </h3>

                <?php $no = 1; ?>

                <?php if (empty($items)): ?>

                    <div class="bg-white border border-dashed border-zinc-200 rounded-xl p-6 text-center text-sm text-zinc-500">
                        No reading materials available.
                    </div>

                <?php endif; ?>

                <?php foreach ($items as $row): ?>

                    <div class="bg-white border border-zinc-200/60 rounded-xl p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 transition-all
                        <?= $isLocked ? 'opacity-60 grayscale-[30%]' : 'hover:border-zinc-300' ?>">

                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg <?= $isLocked ? 'bg-zinc-100 text-zinc-400' : 'bg-emerald-500/10 text-emerald-600' ?> flex items-center justify-center font-bold text-xs">
                                <?php if ($isLocked): ?>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v2"/>
                                    </svg>
                                <?php else: ?>
                                    <?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-zinc-900">
                                    <?= esc($row['title']) ?>
                                </h4>
                                <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1 text-xs text-zinc-400 font-medium">

                                    <span class="<?= $badge[$row['level']] ?? 'text-zinc-600 bg-zinc-50' ?> font-semibold px-1.5 py-0.5 rounded">
                                        <?= ucfirst($row['level']) ?>
                                    </span>
                                    <span>• <?= $row['estimated_minutes'] ?> Minutes</span>
                                    <span>• <?= $row['total_questions'] ?> Essay</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex sm:flex-col items-center sm:items-end justify-between w-full sm:w-auto border-t sm:border-t-0 border-zinc-100 pt-3 sm:pt-0">

                            <?php if ($isLocked): ?>
                                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-1 hidden sm:block">
                                    Terkunci
                                </span>
                            <?php elseif ($row['has_in_progress']): ?>
                                <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wider mb-1 hidden sm:block">
                                    Sedang Berjalan
                                </span>
                            <?php elseif ($row['highest_score'] > 0): ?>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-1 hidden sm:block">
                                    Skor: <?= round($row['highest_score'], 1) ?>
                                </span>
                            <?php else: ?>
                                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-1 hidden sm:block">
                                    Belum Dimulai
                                </span>
                            <?php endif; ?>

                            <?php if ($isLocked): ?>
                                <span class="w-full sm:w-auto bg-zinc-100 text-zinc-400 border border-zinc-200 px-4 py-2 rounded-lg text-xs font-semibold text-center cursor-not-allowed">
                                    Terkunci
                                </span>
                            <?php else: ?>
                                <a href="<?= site_url('student/reading/start/' . $row['id']) ?>"
                                   class="w-full sm:w-auto bg-zinc-950 hover:bg-zinc-800 text-white border border-zinc-900 px-4 py-2 rounded-lg text-xs font-semibold transition-all text-center">
                                    <?php
                                    if ($row['has_in_progress']) {
                                        echo 'Lanjutkan Test';
                                    } elseif ($row['highest_score'] > 0) {
                                        echo 'Ulangi Test';
                                    } else {
                                        echo 'Mulai Test';
                                    }
                                    ?>
                                </a>
                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

                <?php $previousPassed = $levelPassed; ?>

            <?php endforeach; ?>

        </div>

        <!-- RIGHT: SIDEBAR (4 Cols) -->
        <div class="lg:col-span-4 space-y-6">

            <div class="bg-white border border-zinc-200/60 rounded-xl p-6 space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400">Saran Pembelajaran</h3>
                <ul class="space-y-3 text-xs text-zinc-600 font-medium">
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">▪</span> Telaah struktur paragraf secara menyeluruh.</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">▪</span> Fokus pada gagasan utama (main idea) tiap segmen.</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">▪</span> Konstruksikan jawaban esai dengan bahasa sendiri.</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">▪</span> Evaluasi komparasi koreksi sintaksis dari AI.</li>
                </ul>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>