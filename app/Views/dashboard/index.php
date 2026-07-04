<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

    <div class="grid lg:grid-cols-12 gap-8">

        <!-- LEFT CONTENT (8 Cols) -->
        <div class="lg:col-span-12 space-y-12">

            <!-- HERO BANNER (Futuristic Dark Concept) -->
            <div class="bg-[#090d16] rounded-2xl p-8 sm:p-10 text-white relative overflow-hidden border border-white/5 shadow-sm">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,0.12),transparent_45%)]"></div>
                <div class="relative z-10 max-w-xl space-y-4">
                    <div class="inline-flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full text-[10px] font-bold tracking-wider text-emerald-400 uppercase">
                        Sesi Aktif
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                        Halo, Budi.
                    </h2>
                    <p class="text-zinc-400 text-sm leading-relaxed font-light">
                        Lanjutkan modul integrasi bahasa hari ini. Sistem AI telah memperbarui dasbor rekomendasi personal Anda berdasarkan performa kemarin.
                    </p>
                    <div class="pt-2">
                        <button class="bg-emerald-500 hover:bg-emerald-400 text-slate-950 px-6 py-3 rounded-xl font-semibold text-xs tracking-wider uppercase transition-all duration-300">
                            Lanjutkan Belajar
                        </button>
                    </div>
                </div>
            </div>

            <!-- MODULES / LEARNING PATH -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400">Learning Path</h3>
                    <span class="text-xs text-zinc-500 font-medium">3 Garis Kerja Aktif</span>
                </div>

                <div class="space-y-4">
                    <!-- Reading -->
                    <div class="bg-white border border-zinc-200/60 rounded-2xl p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 hover:border-zinc-300 transition-all duration-300">
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <div class="w-12 h-12 rounded-xl bg-zinc-50 border border-zinc-100 flex items-center justify-center text-zinc-700 font-bold text-sm shrink-0">01</div>
                            <div class="space-y-1 w-full">
                                <h4 class="text-base font-bold text-zinc-900">Reading Comprehension</h4>
                                <div class="flex items-center gap-4">
                                    <p class="text-xs text-zinc-400 font-medium shrink-0">18 / 25 Selesai</p>
                                    <div class="w-full sm:w-32 bg-zinc-100 rounded-full h-1.5">
                                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width:72%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="<?= base_url('reading-dashboard') ?>" class="w-full sm:w-auto bg-zinc-50 hover:bg-zinc-100 text-zinc-900 border border-zinc-200/80 px-4 py-2 rounded-xl text-xs font-semibold transition-all">
                            Akses Modul
                        </a>
                    </div>

                    <!-- Vocabulary -->
                    <div class="bg-white border border-zinc-200/60 rounded-2xl p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 hover:border-zinc-300 transition-all duration-300">
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <div class="w-12 h-12 rounded-xl bg-zinc-50 border border-zinc-100 flex items-center justify-center text-zinc-700 font-bold text-sm shrink-0">02</div>
                            <div class="space-y-1 w-full">
                                <h4 class="text-base font-bold text-zinc-900">Vocabulary in Context</h4>
                                <div class="flex items-center gap-4">
                                    <p class="text-xs text-zinc-400 font-medium shrink-0">150 Istilah</p>
                                    <div class="w-full sm:w-32 bg-zinc-100 rounded-full h-1.5">
                                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width:60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="w-full sm:w-auto bg-zinc-50 hover:bg-zinc-100 text-zinc-900 border border-zinc-200/80 px-4 py-2 rounded-xl text-xs font-semibold transition-all">
                            Akses Modul
                        </button>
                    </div>

                    <!-- Pronunciation -->
                    <div class="bg-white border border-zinc-200/60 rounded-2xl p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 hover:border-zinc-300 transition-all duration-300">
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <div class="w-12 h-12 rounded-xl bg-zinc-50 border border-zinc-100 flex items-center justify-center text-zinc-700 font-bold text-sm shrink-0">03</div>
                            <div class="space-y-1 w-full">
                                <h4 class="text-base font-bold text-zinc-900">AI Pronunciation Assessment</h4>
                                <div class="flex items-center gap-4">
                                    <p class="text-xs text-emerald-600 font-bold shrink-0">AI Score: 89</p>
                                    <div class="w-full sm:w-32 bg-zinc-100 rounded-full h-1.5">
                                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width:89%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="w-full sm:w-auto bg-zinc-50 hover:bg-zinc-100 text-zinc-900 border border-zinc-200/80 px-4 py-2 rounded-xl text-xs font-semibold transition-all">
                            Mulai Latihan
                        </button>
                    </div>
                </div>
            </div>

            

        </div>

        <!-- RIGHT SIDEBAR (4 Cols) -->
        <?php if (false): ?>
            <div class="lg:col-span-4 space-y-6">

            <!-- STATS PANEL -->
            <div class="grid grid-cols-2 gap-4">
                <!-- XP -->
                <div class="bg-white border border-zinc-200/60 rounded-2xl p-5 space-y-3">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-zinc-400">Target Harian</p>
                    <p class="text-2xl font-extrabold text-zinc-900">45 <span class="text-xs font-medium text-zinc-400">/ 100 XP</span></p>
                    <div class="w-full bg-zinc-100 rounded-full h-1">
                        <div class="bg-zinc-950 h-1 rounded-full w-5/12"></div>
                    </div>
                </div>
                <!-- STREAK -->
                <div class="bg-white border border-zinc-200/60 rounded-2xl p-5 space-y-1">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-zinc-400">Sesi Beruntun</p>
                    <p class="text-2xl font-extrabold text-orange-500">7 <span class="text-xs font-medium text-zinc-400">Hari</span></p>
                    <p class="text-[10px] text-zinc-400 font-medium">🔥 Konsisten dipertahankan</p>
                </div>
            </div>

            <!-- AI RECOMMENDATION -->
            <div class="bg-white border border-zinc-200/60 rounded-2xl p-6 space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-widest text-emerald-600 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> AI Engine Recommendation
                </h3>
                
                <div class="space-y-3">
                    <div class="p-3.5 bg-zinc-50 rounded-xl border border-zinc-100">
                        <p class="text-xs font-bold text-zinc-900">Reading: Modul Komparatif 5</p>
                        <p class="text-xs text-zinc-500 mt-0.5">Optimasi struktur esai ilmiah pendek.</p>
                    </div>

                    <div class="p-3.5 bg-zinc-50 rounded-xl border border-zinc-100">
                        <p class="text-xs font-bold text-zinc-900">Leksikon: "Irrigation System"</p>
                        <p class="text-xs text-zinc-500 mt-0.5">Penambahan 10 istilah agronomis baru.</p>
                    </div>

                    <div class="p-3.5 bg-zinc-50 rounded-xl border border-zinc-100">
                        <p class="text-xs font-bold text-zinc-900">Fonetik: "Fertilizer"</p>
                        <p class="text-xs text-zinc-500 mt-0.5">Perbaikan artikulasi penekanan suku kata.</p>
                    </div>
                </div>
            </div>

            <!-- MILESTONES / ACHIEVEMENTS -->
            <div class="bg-white border border-zinc-200/60 rounded-2xl p-6 space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400">Pencapaian</h3>
                
                <div class="grid grid-cols-3 gap-3 text-center">
                    <div class="p-3 border border-zinc-100 rounded-xl bg-zinc-50/50">
                        <div class="text-xs font-bold text-zinc-800">READ</div>
                        <p class="text-[9px] text-zinc-400 font-medium uppercase mt-1">A1</p>
                    </div>
                    <div class="p-3 border border-zinc-100 rounded-xl bg-zinc-50/50">
                        <div class="text-xs font-bold text-zinc-800">VOCAB</div>
                        <p class="text-[9px] text-zinc-400 font-medium uppercase mt-1">B2</p>
                    </div>
                   
                    <div class="p-3 border border-zinc-100 rounded-xl bg-zinc-50/50">
                        <div class="text-xs font-bold text-zinc-800">MAX</div>
                        <p class="text-[9px] text-zinc-400 font-medium uppercase mt-1">Skor Tinggi</p>
                    </div>
                    <div class="p-3 border border-zinc-100 rounded-xl bg-zinc-50/50">
                        <div class="text-xs font-bold text-zinc-800">STREAK</div>
                        <p class="text-[9px] text-zinc-400 font-medium uppercase mt-1">7 Hari</p>
                    </div>
                   
                </div>
            </div>

        </div>    
        <?php endif ?>
        

    </div>

<?= $this->endSection() ?>