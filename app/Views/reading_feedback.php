<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Feedback - AgriEnglish AI</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Score Ring dengan Modifikasi Grafis Halus */
        .score-ring {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: conic-gradient(#10b981 313deg, #e4e4e7 0deg);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .score-ring-inner {
            width: 116px;
            height: 116px;
            border-radius: 50%;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="bg-zinc-50 text-zinc-800 font-sans antialiased">

<nav class="bg-white border-b border-zinc-200/60 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto h-16 flex justify-between items-center px-6">
        <a href="<?php echo base_url('reading-test') ?>" class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Reading
        </a>
        <div class="text-[10px] bg-zinc-950 text-white px-2.5 py-1 rounded-md font-mono tracking-widest uppercase">
            AI Evaluation Matrix
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto p-6">
    <div class="grid lg:grid-cols-12 gap-8 items-start">

        <div class="lg:col-span-8 space-y-6">

            <div class="bg-white border border-zinc-200/60 rounded-xl p-6 sm:p-8 shadow-sm">
                <div class="flex flex-col sm:flex-row items-center gap-8">
                    
                    <div class="score-ring shrink-0">
                        <div class="score-ring-inner">
                            <span class="text-4xl font-black text-zinc-900 tracking-tight">87</span>
                            <span class="text-[9px] font-bold uppercase tracking-wider text-emerald-600 mt-0.5">Excellent</span>
                        </div>
                    </div>

                    <div class="space-y-3 text-center sm:text-left">
                        <h2 class="text-2xl font-extrabold tracking-tight text-zinc-900">
                            Evaluasi Performa Luar Biasa!
                        </h2>
                        <p class="text-zinc-500 text-sm font-light leading-relaxed">
                            Konstruksi jawaban Anda menunjukkan pemahaman kontekstual yang sangat kuat terhadap esensi artikel ilmiah. Analisis AI mendeteksi akurasi substansi yang tinggi, namun terdapat beberapa area penguatan pada tatanan sintaksis (grammar) dan variasi leksikon akademis.
                        </p>
                    </div>

                </div>
            </div>

           <!--  <div class="bg-white border border-zinc-200/60 rounded-xl p-6 sm:p-8 shadow-sm space-y-5">
                <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400">Analisis Matrik Kompetensi</h3>
                
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-zinc-500 uppercase tracking-wide">Grammar Acuity</span>
                            <span class="text-zinc-900">82%</span>
                        </div>
                        <div class="w-full bg-zinc-100 h-1 rounded-full">
                            <div class="bg-zinc-950 h-1 rounded-full" style="width: 82%"></div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-zinc-500 uppercase tracking-wide">Content Comprehension</span>
                            <span class="text-emerald-600">94%</span>
                        </div>
                        <div class="w-full bg-zinc-100 h-1 rounded-full">
                            <div class="bg-emerald-500 h-1 rounded-full" style="width: 94%"></div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-zinc-500 uppercase tracking-wide">Lexical Lexicon Range</span>
                            <span class="text-zinc-900">76%</span>
                        </div>
                        <div class="w-full bg-zinc-100 h-1 rounded-full">
                            <div class="bg-zinc-950 h-1 rounded-full" style="width: 76%"></div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-zinc-500 uppercase tracking-wide">Sentence Structural Density</span>
                            <span class="text-zinc-900">85%</span>
                        </div>
                        <div class="w-full bg-zinc-100 h-1 rounded-full">
                            <div class="bg-zinc-950 h-1 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="grid sm:grid-cols-2 gap-4">
                <div class="bg-white border border-zinc-200/60 rounded-xl p-5 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-400">Jawaban Anda</h4>
                    <p class="text-xs text-zinc-700 leading-relaxed font-medium bg-zinc-50 p-3.5 rounded-lg border border-zinc-100">
                        Sustainable farming is good because it helps farmers produce food while protecting nature and using less water. Farmers can also keep the land healthy for the future.
                    </p>
                </div>

                <div class="bg-white border border-2 border-emerald-500/20 rounded-xl p-5 space-y-3 relative">
                    <span class="absolute top-3 right-4 text-[9px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded uppercase tracking-wider">Rekomendasi AI</span>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-900">Saran Optimalisasi</h4>
                    <p class="text-xs text-zinc-800 leading-relaxed font-semibold bg-emerald-500/[0.02] p-3.5 rounded-lg border border-emerald-500/10">
                        Sustainable farming improves food production while protecting natural resources through efficient water management, soil conservation, and environmentally friendly agricultural practices.
                    </p>
                </div>
            </div>

            <div class="bg-white border border-zinc-200/60 rounded-xl p-6 sm:p-8 space-y-4 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400">Diagnostik Detil Engine AI</h3>
                
                <div class="space-y-3 text-xs font-medium">
                    <div class="flex items-start gap-3 p-3.5 border border-zinc-100 bg-zinc-50/50 rounded-xl">
                        <span class="text-emerald-600 font-bold shrink-0">✓</span>
                        <p class="text-zinc-700 leading-relaxed">Struktur logika Anda berhasil mengidentifikasi esensi fundamental dari <span class="font-bold text-zinc-900">sustainable farming</span> dengan tepat.</p>
                    </div>
                    <div class="flex items-start gap-3 p-3.5 border border-zinc-100 bg-zinc-50/50 rounded-xl">
                        <span class="text-amber-500 font-bold shrink-0">!</span>
                        <p class="text-zinc-700 leading-relaxed">Disarankan untuk mengganti kosakata umum seperti <span class="font-bold text-amber-600">"good"</span> dengan istilah akademis penunjang seperti <span class="font-bold text-zinc-900">"advantageous"</span> atau <span class="font-bold text-zinc-900">"efficient"</span>.</p>
                    </div>
                    <div class="flex items-start gap-3 p-3.5 border border-zinc-100 bg-zinc-50/50 rounded-xl">
                        <span class="text-teal-600 font-bold shrink-0">i</span>
                        <p class="text-zinc-700 leading-relaxed">Integrasikan frasa teknis industri pertanian seperti <span class="font-bold text-zinc-900">"soil conservation"</span> atau <span class="font-bold text-zinc-900">"environmental sustainability"</span> guna meningkatkan bobot argumentasi ilmiah.</p>
                    </div>
                    <div class="flex items-start gap-3 p-3.5 border border-zinc-100 bg-zinc-50/50 rounded-xl">
                        <span class="text-rose-500 font-bold shrink-0">✕</span>
                        <p class="text-zinc-700 leading-relaxed">Reduksi pengulangan gagasan serupa pada kalimat berurutan untuk menciptakan efisiensi membaca yang optimal.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="lg:col-span-4 space-y-6">
            
            <div class="bg-white border border-zinc-200/60 rounded-xl p-6 space-y-4 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400">Statistik Sesi</h3>
                
                <div class="space-y-3 text-xs font-medium text-zinc-500">
                    <div class="flex justify-between py-1.5 border-b border-zinc-100">
                        <span>Jumlah Kata</span>
                        <b class="text-zinc-900">42 Kata</b>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-zinc-100">
                        <span>Durasi Pengisian</span>
                        <b class="text-zinc-900">2 Menit</b>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-zinc-100">
                        <span>Ekuivalensi Level</span>
                        <b class="text-emerald-600 font-bold">B1 Intermediate</b>
                    </div>
                    <div class="flex justify-between py-1.5">
                        <span>AI Confidence Level</span>
                        <b class="text-zinc-900 font-mono">97%</b>
                    </div>
                </div>
            </div>

           <!--  <div class="bg-white border border-zinc-200/60 rounded-xl p-6 space-y-4 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400">Rekomendasi Studi Lanjutan</h3>
                <ul class="space-y-3 text-xs text-zinc-600 font-medium pl-1">
                    <li class="flex items-start gap-2.5"><span class="text-zinc-400 font-bold">•</span> Prioritaskan adopsi kosa kata formal akademik.</li>
                    <li class="flex items-start gap-2.5"><span class="text-zinc-400 font-bold">•</span> Gunakan klausa pendukung yang lebih elaboratif.</li>
                    <li class="flex items-start gap-2.5"><span class="text-zinc-400 font-bold">•</span> Hindari redundansi istilah kata yang sama secara berulang.</li>
                    <li class="flex items-start gap-2.5"><span class="text-zinc-400 font-bold">•</span> Buka modul kamus istilah: "Lesson Vocabulary".</li>
                </ul>
            </div> -->

            <div class="bg-[#090d16] text-white border border-white/5 rounded-xl p-6 space-y-5 relative overflow-hidden shadow-sm">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(16,185,129,0.08),transparent_40%)]"></div>
                
                <div class="relative z-10 space-y-2">
                    <h4 class="text-base font-bold tracking-tight">Tantangan Berikutnya</h4>
                    <p class="text-xs text-zinc-400 font-light leading-relaxed">
                        Terapkan masukan optimalisasi parameter AI di atas langsung pada Pertanyaan ke-3 untuk mengejar skor akumulasi yang lebih tinggi.
                    </p>
                </div>

                <div class="space-y-2.5 relative z-10">
                    <button class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 py-3 rounded-xl text-xs font-bold tracking-wider uppercase transition-all duration-300">
                        Lanjutkan Sesi →
                    </button>
                    <button class="w-full bg-white/5 hover:bg-white/10 text-zinc-200 border border-white/10 py-3 rounded-xl text-xs font-semibold tracking-wide transition-all">
                        Ulangi Pertanyaan Ini
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>