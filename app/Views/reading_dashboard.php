<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Breadcrumb -->
    <div class="text-xs font-medium text-zinc-400 uppercase tracking-wider flex items-center gap-2">
        <a href="<?= site_url('dashboard') ?>" class="hover:text-zinc-600 transition-colors">Dashboard</a>
        <span>/</span>
        <span class="text-zinc-900">Reading Comprehension</span>
    </div>

    <!-- HERO / STATS OVERVIEW (Futuristic Dark Panel) -->
    <div class="bg-[#090d16] rounded-2xl p-8 sm:p-10 text-white relative overflow-hidden border border-white/5 shadow-sm">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,0.12),transparent_45%)]"></div>
        
        <div class="relative z-10 flex flex-col lg:flex-row justify-between gap-8 items-start lg:items-center">
            <div class=" space-y-4">
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

            <!-- Stats Analytics Box -->
            <!-- <div class="bg-white/[0.02] border border-white/10 rounded-xl p-6 w-full lg:w-80 backdrop-blur-sm space-y-6">
                <div>
                    <div class="flex justify-between items-end">
                        <p class="text-xs font-bold uppercase tracking-wider text-zinc-400">Total Progres</p>
                        <p class="text-2xl font-black text-white">72%</p>
                    </div>
                    <div class="w-full bg-white/10 rounded-full h-1 mt-2">
                        <div class="bg-emerald-400 h-1 rounded-full" style="width:72%"></div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 border-t border-white/5 pt-4">
                    <div>
                        <p class="text-2xl font-bold tracking-tight text-white">8</p>
                        <p class="text-[10px] font-medium text-zinc-400 uppercase tracking-wide">Selesai</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold tracking-tight text-white">3</p>
                        <p class="text-[10px] font-medium text-zinc-400 uppercase tracking-wide">Tersisa</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold tracking-tight text-emerald-400">88</p>
                        <p class="text-[10px] font-medium text-zinc-400 uppercase tracking-wide">Rerata Skor</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold tracking-tight text-white">3 <span class="text-xs font-normal text-zinc-500">Jam</span></p>
                        <p class="text-[10px] font-medium text-zinc-400 uppercase tracking-wide">Durasi Belajar</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <!-- MAIN CONTENT GRID -->
    <div class="grid lg:grid-cols-12 gap-8 pt-4">
        
        <!-- LEFT: LESSON LIST (8 Cols) -->
        <div class="lg:col-span-8 space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400 mb-4">Daftar Pelajaran Tersedia</h3>

            <!-- Lesson 1 (Completed) -->
            <div class="bg-white border border-zinc-200/60 rounded-xl p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 hover:border-zinc-300 transition-all">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-600 flex items-center justify-center font-bold text-xs">01</div>
                    <div>
                        <h4 class="text-sm font-bold text-zinc-900">Introduction to Agriculture</h4>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1 text-xs text-zinc-400 font-medium">
                            <span class="text-emerald-600 font-semibold bg-emerald-50 px-1.5 py-0.5 rounded">Easy</span>
                            <span>• 10 Menit</span>
                            <span>• 5 Esai</span>
                        </div>
                    </div>
                </div>
                <div class="flex sm:flex-col items-center sm:items-end justify-between w-full sm:w-auto border-t sm:border-t-0 border-zinc-100 pt-3 sm:pt-0">
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-1 hidden sm:block">Selesai</span>
                    <button class="w-full sm:w-auto bg-zinc-50 hover:bg-zinc-100 text-zinc-800 border border-zinc-200 px-4 py-2 rounded-lg text-xs font-semibold transition-all">
                        Tinjau Ulang
                    </button>
                </div>
            </div>

            <!-- Lesson 2 (Current Active) -->
            <div class="bg-white border-2 border-emerald-500/30 rounded-xl p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 shadow-sm relative">
                <div class="absolute -top-2.5 right-4 bg-emerald-500 text-slate-950 font-bold text-[9px] tracking-widest uppercase px-2 py-0.5 rounded-full">AKTIF</div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-emerald-500 text-slate-950 flex items-center justify-center font-bold text-xs">02</div>
                    <div>
                        <h4 class="text-sm font-bold text-zinc-900">Sustainable Farming</h4>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1 text-xs text-zinc-400 font-medium">
                            <span class="text-amber-600 font-semibold bg-amber-50 px-1.5 py-0.5 rounded">Medium</span>
                            <span>• 15 Menit</span>
                            <span>• 5 Esai</span>
                        </div>
                    </div>
                </div>
                <a href="<?= site_url('reading-test') ?>" class="w-full sm:w-auto bg-zinc-950 hover:bg-zinc-900 text-white px-5 py-2.5 rounded-xl text-xs font-semibold tracking-wide transition-all shadow-md">
                    Mulai Sesi
                </a>
            </div>

            <!-- Lesson 3 (Locked Style) -->
            <div class="bg-white/60 border border-zinc-200/40 rounded-xl p-5 flex justify-between items-center opacity-60 backdrop-blur-sm select-none">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-zinc-100 text-zinc-400 flex items-center justify-center text-xs font-bold">03</div>
                    <div>
                        <h4 class="text-sm font-bold text-zinc-400">Organic Agriculture</h4>
                        <p class="text-xs text-zinc-400 mt-0.5 font-medium">Terbuka setelah menyelesaikan Pelajaran 2</p>
                    </div>
                </div>
                <div class="text-zinc-400 pr-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
            </div>

            <!-- Lesson 4 (Locked) -->
            <div class="bg-white/60 border border-zinc-200/40 rounded-xl p-5 flex justify-between items-center opacity-60 backdrop-blur-sm select-none">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-zinc-100 text-zinc-400 flex items-center justify-center text-xs font-bold">04</div>
                    <div>
                        <h4 class="text-sm font-bold text-zinc-400">Hydroponic Farming</h4>
                        <p class="text-xs text-zinc-400 mt-0.5 font-medium">Modul Belum Terbuka</p>
                    </div>
                </div>
                <div class="text-zinc-400 pr-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
            </div>

            <!-- Lesson 5 (Locked) -->
            <div class="bg-white/60 border border-zinc-200/40 rounded-xl p-5 flex justify-between items-center opacity-60 backdrop-blur-sm select-none">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-zinc-100 text-zinc-400 flex items-center justify-center text-xs font-bold">05</div>
                    <div>
                        <h4 class="text-sm font-bold text-zinc-400">Climate Smart Agriculture</h4>
                        <p class="text-xs text-zinc-400 mt-0.5 font-medium">Modul Belum Terbuka</p>
                    </div>
                </div>
                <div class="text-zinc-400 pr-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
            </div>
        </div>

        <!-- RIGHT: SIDEBAR INTELLIGENCE (4 Cols) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- AI RECOMMENDATION -->
           <!--  <div class="bg-white border border-zinc-200/60 rounded-xl p-6 space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-widest text-emerald-600 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> AI Recommendation
                </h3>
                <div class="p-4 bg-zinc-50 rounded-xl border border-zinc-100 space-y-2">
                    <p class="text-xs font-bold text-zinc-900">Lanjutkan: Sustainable Farming</p>
                    <p class="text-xs text-zinc-500 leading-relaxed font-light">
                        Berdasarkan riwayat pengerjaan Anda, pemahaman bacaan kontekstual Anda terus meningkat secara linear. AI menyarankan untuk merampungkan bab ini guna menstabilkan retensi metrik pemahaman Anda.
                    </p>
                </div>
            </div> -->

            <!-- LEARNING TIPS (Clean Minimalism) -->
            <div class="bg-white border border-zinc-200/60 rounded-xl p-6 space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400">Saran Pembelajaran</h3>
                <ul class="space-y-3 text-xs text-zinc-600 font-medium">
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">▪</span> Telaah struktur paragraf secara menyeluruh.</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">▪</span> Fokus pada gagasan utama (main idea) tiap segmen.</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">▪</span> Konstruksikan jawaban esai dengan bahasa sendiri.</li>
                    <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">▪</span> Evaluasi komparasi koreksi sintaksis dari AI.</li>
                </ul>
            </div>

            <!-- ACHIEVEMENT PANEL -->
           <!--  <div class="bg-zinc-950 text-white border border-white/5 rounded-xl p-6 relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(16,185,129,0.08),transparent_40%)]"></div>
                <div class="relative z-10 space-y-3">
                    <span class="text-xs bg-white/10 text-zinc-300 border border-white/10 px-2 py-0.5 rounded font-mono">TARGET BADGE</span>
                    <h4 class="text-lg font-bold text-white tracking-tight pt-1">Reading Master Badge</h4>
                    <p class="text-xs text-zinc-400 font-light leading-relaxed">
                        Selesaikan akumulasi sisa materi dalam jalur pembelajaran ini untuk mengesahkan lencana kompetensi bahasa Anda.
                    </p>
                </div>
            </div>
 -->
        </div>

    </div>
</div>

<?= $this->endSection() ?>