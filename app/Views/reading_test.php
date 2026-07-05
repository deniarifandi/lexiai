<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
        <a href="<?php echo base_url('reading-dashboard') ?>" class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Reading List
        </a>
        <div class="text-[10px] bg-zinc-950 text-white px-2.5 py-1 rounded-md font-mono tracking-widest uppercase">
           Reading Test
        </div>
    </div>

    <!-- TOP PROFILE & PROGRESS PANEL -->
    <div class="bg-white border border-zinc-200/60 rounded-xl p-5 flex flex-col sm:flex-row justify-between sm:items-center gap-4 shadow-sm">
        <div class="space-y-0.5">
            <h1 class="font-extrabold text-base text-zinc-900 tracking-tight">Reading Comprehension</h1>
            <p class="text-xs text-zinc-400 font-medium">Pelajaran 2 • Sustainable Farming</p>
        </div>

        <div class="flex-1 max-w-md w-full sm:px-6 space-y-1.5">
            <div class="flex justify-between text-xs font-bold tracking-wide text-zinc-400 uppercase">
                <span>Progres Pengerjaan</span>
                <span class="text-zinc-900">40%</span>
            </div>
            <div class="w-full bg-zinc-100 rounded-full h-1.5">
                <div class="bg-emerald-500 h-1.5 rounded-full transition-all duration-500" style="width: 40%"></div>
            </div>
        </div>

        <div class="text-right shrink-0">
            <span class="inline-block bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 text-xs font-bold px-3 py-1 rounded-lg">
                Pertanyaan 2 / 5
            </span>
        </div>
    </div>

    <!-- MAIN INTERACTIVE WORKSPACE -->
    <div class="grid lg:grid-cols-12 gap-6 items-start">

        <!-- LEFT SIDE: READING PASSAGE PANEL (8 Cols) -->
        <div class="lg:col-span-7 lg:sticky lg:top-24">
            <div class="bg-white border border-zinc-200/60 rounded-xl p-6 sm:p-8 flex flex-col max-h-[calc(100vh-12rem)] shadow-sm">
                <div class="flex justify-between items-center pb-4 border-b border-zinc-100 shrink-0">
                    <h2 class="text-sm font-bold uppercase tracking-widest text-zinc-400 flex items-center gap-2">
                        Reading Passage
                    </h2>
                    <span class="bg-zinc-100 text-zinc-800 text-[10px] font-bold tracking-wider uppercase px-2.5 py-1 rounded-md">
                        Medium Level
                    </span>
                </div>

                <!-- Scrollable Article Text -->
                <div class="custom-scroll overflow-y-auto pr-2 mt-6 text-zinc-700 text-sm leading-relaxed font-light space-y-4">
                    <p>
                        Sustainable farming is an agricultural practice that aims to produce food while protecting the environment,
                        maintaining natural resources, and supporting local communities. Farmers use methods that reduce pollution,
                        conserve water, improve soil quality, and minimize the use of harmful chemicals.
                    </p>
                    <p>
                        One common practice is crop rotation. Instead of planting the same crop every season, farmers alternate different
                        types of crops to maintain soil fertility and reduce pests naturally. Another important technique is using organic
                        fertilizers instead of excessive chemical fertilizers.
                    </p>
                    <p>
                        Water conservation is also essential in sustainable agriculture. Modern irrigation systems help farmers use water
                        more efficiently while reducing waste. These practices not only benefit the environment but also improve long-term
                        agricultural productivity.
                    </p>
                    <p>
                        As climate change becomes a global concern, sustainable farming is increasingly recognized as one of the most
                        important approaches to ensuring future food security.
                    </p>
                    <p>
                        Researchers continue developing innovative technologies, such as precision agriculture and AI-powered monitoring
                        systems, to help farmers make better decisions while preserving the environment.
                    </p>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: QUESTION & METADATA (5 Cols) -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- EXERCISE & ANSWER INPUT -->
            <div class="bg-white border border-zinc-200/60 rounded-xl p-6 space-y-5 shadow-sm">
                <div class="flex justify-between items-center pb-3 border-b border-zinc-100">
                    <h3 class="text-sm font-bold text-zinc-900 tracking-tight">Pertanyaan Esai</h3>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400">BOBOT: ESSAY</span>
                </div>

                <div class="p-4 bg-zinc-50 rounded-xl border border-zinc-100">
                    <p class="text-sm font-semibold text-zinc-900 leading-relaxed">
                        According to the passage, what are two benefits of sustainable farming? Explain your answer using your own words.
                    </p>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-zinc-400 uppercase tracking-wider">Lembar Jawaban Anda</label>
                    <textarea rows="8" class="w-full text-sm border border-zinc-200 rounded-xl p-4 focus:ring-1 focus:ring-zinc-950 focus:border-zinc-950 focus:outline-none transition-all placeholder-zinc-300 bg-zinc-50/30" placeholder="Tuliskan analisis atau esai jawaban Anda di sini dalam bahasa Inggris..."></textarea>
                    
                    <div class="flex justify-between text-[11px] font-medium text-zinc-400 pt-1">
                        <span>Word Count: <b class="text-zinc-600">0</b></span>
                        <span>Rekomendasi: 30–80 kata</span>
                    </div>
                </div>

                <!-- AI TIPS INSIDE BOX -->
                <div class="p-4 bg-emerald-500/[0.02] border border-emerald-500/10 rounded-xl space-y-2">
                    <p class="text-xs font-bold text-emerald-700 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> AI Writing Tips
                    </p>
                    <ul class="text-[11px] text-zinc-500 space-y-1 font-medium pl-3 list-disc">
                        <li>Gunakan struktur kalimat bahasa Inggris yang utuh dan baku.</li>
                        <li>Hindari menyalin frasa langsung (plagiasi) dari teks bacaan.</li>
                        <li>Sampaikan informasi inti secara lugas dan efisien.</li>
                    </ul>
                </div>

                <!-- NAVIGATION BUTTONS -->
                <div class="flex justify-between gap-4 pt-2">
                    <button class="flex-1 bg-white hover:bg-zinc-50 text-zinc-800 border border-zinc-200 px-4 py-3 rounded-xl text-xs font-semibold transition-all">
                        Sebelumnya
                    </button>
                    <a href="<?php echo base_url('reading-feedback') ?>" class="flex-1 bg-zinc-950 hover:bg-zinc-900 text-white px-4 py-3 rounded-xl text-xs font-semibold tracking-wide transition-all shadow-md flex items-center justify-center gap-2">
                        Selanjutnya
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- METADATA INFORMATION BOX -->
           

        </div>

    </div>
</div>

<?= $this->endSection() ?>  