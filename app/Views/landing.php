<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LexiAI</title>

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
</head>

<body class="bg-[#090d16] text-zinc-400 font-sans antialiased overflow-x-hidden">

    <nav class="fixed w-full z-50 border-b border-white/5 bg-[#090d16]/70 backdrop-blur-md transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="text-xl font-bold tracking-tight text-white flex items-center gap-2">
                <span class="bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Lexi</span>
                <span class="text-xs bg-emerald-500/10 text-emerald-400 px-2 py-0.5 rounded-full border border-emerald-500/20">AI</span>
            </div>
            <div class="hidden md:flex gap-8 text-sm font-medium tracking-wide">
                <a href="#about" class="text-zinc-400 hover:text-white transition-colors">Tentang</a>
                <a href="#modules" class="text-zinc-400 hover:text-white transition-colors">Modul</a>
                <a href="#benefit" class="text-zinc-400 hover:text-white transition-colors">Manfaat</a>
                <a href="<?= base_url('login') ?>" class="bg-emerald-500 hover:bg-emerald-600 text-slate-950 px-4 py-2 rounded-lg text-xs font-semibold tracking-wider transition-all">Login</a>
            </div>
        </div>
    </nav>

    <section class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,0.08),transparent_45%)]"></div>
        <div class="absolute top-1/4 left-10 w-96 h-96 bg-emerald-500/5 rounded-full blur-[120px]"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full grid md:grid-cols-12 gap-12 items-center py-12">
            <div class="md:col-span-7 space-y-6 text-center md:text-left">
                <div class="inline-flex items-center gap-2 bg-white/[0.03] border border-white/10 px-4 py-1.5 rounded-full text-xs font-medium tracking-wider text-emerald-400 uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> AI-Powered Learning Platform
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.1]">
                    Akselerasi Bahasa Inggris <br>
                    <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Sektor Pertanian</span>
                </h1>
                <p class="text-zinc-400 max-w-xl text-base sm:text-lg leading-relaxed font-light mx-auto md:mx-0">
                    Sistem cerdas mandiri untuk penguasaan Reading, Vocabulary, dan Pronunciation akademik pertanian dengan umpan balik instan berbasis teknologi kecerdasan buatan.
                </p>
                <div class="pt-4 flex flex-wrap gap-4 justify-center md:justify-start">
                    <a href="<?= base_url('login') ?>" class="bg-emerald-500 hover:bg-emerald-400 text-slate-950 px-8 py-4 rounded-xl font-semibold text-sm tracking-wide transition-all shadow-[0_0_30px_rgba(16,185,129,0.2)] hover:shadow-[0_0_40px_rgba(16,185,129,0.4)]">
                        Mulai Belajar
                    </a>
                    <a href="#about" class="border border-white/10 hover:border-white/30 text-white bg-white/[0.02] px-8 py-4 rounded-xl font-semibold text-sm tracking-wide transition-all">
                        Pelajari Sistem
                    </a>
                </div>
            </div>
            <div class="md:col-span-5 hidden md:block relative">
                <div class="relative border border-white/10 rounded-2xl overflow-hidden bg-slate-900/50 p-2 backdrop-blur-sm">
                    <img src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=800&q=80" alt="Agriculture Tech" class="rounded-xl grayscale opacity-60 hover:grayscale-0 transition-all duration-700">
                </div>
                <div class="absolute -bottom-6 -left-6 bg-[#0c1220] border border-white/5 p-4 rounded-xl shadow-2xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400">⚡</div>
                    <div>
                        <p class="text-xs text-zinc-500 uppercase font-bold tracking-widest">Latency Feedback</p>
                        <p class="text-sm font-semibold text-white">&lt; 1.2 Detik</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="bg-white text-zinc-800 rounded-t-[2.5rem] relative z-20 shadow-[0_-20px_50px_rgba(0,0,0,0.3)]">
        
        <section id="about" class="py-24 border-b border-zinc-100">
            <div class="max-w-4xl mx-auto px-6 text-center space-y-6">
                <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-600">Transformasi Digital</h2>
                <h3 class="text-3xl md:text-4xl font-bold tracking-tight text-zinc-900">Membawa Edukasi Agrikultur ke Era Masa Depan</h3>
                <p class="text-zinc-600 text-lg leading-relaxed font-light">
                    Platform ini dirancang khusus untuk menjembatani kompetensi bahasa dengan ilmu pertanian modern. Mengintegrasikan pemrosesan bahasa alami (NLP) guna menganalisis pemahaman serta artikulasi mahasiswa secara presisi dan personal.
                </p>
            </div>
        </section>

        <section id="modules" class="py-24 bg-zinc-50/50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16 space-y-3">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-600">Modul Inti</h2>
                    <h3 class="text-3xl font-bold tracking-tight text-zinc-900">Arsitektur Pembelajaran</h3>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white border border-zinc-100 rounded-2xl p-8 hover:border-emerald-500/30 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-6 font-bold">01</div>
                            <h4 class="text-xl font-bold text-zinc-900 mb-3">Reading Comprehension</h4>
                            <p class="text-zinc-500 text-sm leading-relaxed mb-6">Analisis teks kontekstual pertanian disusul evaluasi esai pendek berbasis penalaran kritis.</p>
                        </div>
                        <ul class="space-y-2.5 text-xs text-zinc-600 font-medium border-t border-zinc-100 pt-6">
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✓</span> Teks Jurnal Ilmiah Pertanian</li>
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✓</span> Evaluasi Sintaksis Esai</li>
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✓</span> Rekomendasi Struktur Kalimat</li>
                        </ul>
                    </div>

                    <div class="bg-white border border-zinc-100 rounded-2xl p-8 hover:border-emerald-500/30 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-6 font-bold">02</div>
                            <h4 class="text-xl font-bold text-zinc-900 mb-3">Vocabulary in Context</h4>
                            <p class="text-zinc-500 text-sm leading-relaxed mb-6">Leksikon istilah agronomis lengkap disertai model pengaplikasian riil di lapangan.</p>
                        </div>
                        <ul class="space-y-2.5 text-xs text-zinc-600 font-medium border-t border-zinc-100 pt-6">
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✓</span> Agro-terminology Database</li>
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✓</span> Audio Komparatif Penutur Asli</li>
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✓</span> Latihan Tematik Adaptif</li>
                        </ul>
                    </div>

                    <div class="bg-white border border-zinc-100 rounded-2xl p-8 hover:border-emerald-500/30 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-6 font-bold">03</div>
                            <h4 class="text-xl font-bold text-zinc-900 mb-3">AI Pronunciation Engine</h4>
                            <p class="text-zinc-500 text-sm leading-relaxed mb-6">Pengujian pelafalan verbal melalui modul pengenalan suara (speech recognition) berakurasi tinggi.</p>
                        </div>
                        <ul class="space-y-2.5 text-xs text-zinc-600 font-medium border-t border-zinc-100 pt-6">
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✓</span> Real-time Phoneme Scoring</li>
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✓</span> Pemetaan Titik Kesalahan Fonetik</li>
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✓</span> Mode Iterasi Latihan Mandiri</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24">
            <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <div class="border border-zinc-200 p-2 rounded-3xl bg-zinc-50/50">
                        <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=900&q=80" alt="AI Neural Network" class="rounded-2xl grayscale contrast-125 mix-blend-multiply">
                    </div>
                </div>
                <div class="space-y-6">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-600">Engine Kapabilitas</h2>
                    <h3 class="text-3xl font-bold tracking-tight text-zinc-900">Kecerdasan Buatan sebagai Mentor Personal</h3>
                    <p class="text-zinc-600 leading-relaxed font-light">
                        Umpan balik konvensional membutuhkan waktu berhari-hari. AI Lexi memproses data input bahasa dalam hitungan detik, memberikan skoring metrik fungsional, serta merancang peta belajar unik bagi tiap individu.
                    </p>
                    <div class="grid grid-cols-2 gap-4 pt-4">
                        <div class="border border-zinc-100 p-4 rounded-xl bg-zinc-50/50">
                            <p class="font-bold text-sm text-zinc-900">⚡ Instantaneous Feedback</p>
                        </div>
                        <div class="border border-zinc-100 p-4 rounded-xl bg-zinc-50/50">
                            <p class="font-bold text-sm text-zinc-900">📈 Automated Metrics</p>
                        </div>
                        <div class="border border-zinc-100 p-4 rounded-xl bg-zinc-50/50">
                            <p class="font-bold text-sm text-zinc-900">🎯 Hyper-Personalized</p>
                        </div>
                        <div class="border border-zinc-100 p-4 rounded-xl bg-zinc-50/50">
                            <p class="font-bold text-sm text-zinc-900">🤖 Autonomous Assistant</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-zinc-950 text-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center mb-16 space-y-2">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-400">User Flow</h2>
                    <h3 class="text-3xl font-bold tracking-tight">Proses Pembelajaran Linear</h3>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-5 gap-8 text-center relative">
                    <div class="space-y-3">
                        <div class="text-xs font-mono text-emerald-400 font-bold bg-white/5 w-8 h-8 rounded-full flex items-center justify-center mx-auto border border-white/10">01</div>
                        <p class="font-medium text-sm text-white">Inisiasi Modul</p>
                    </div>
                    <div class="space-y-3">
                        <div class="text-xs font-mono text-emerald-400 font-bold bg-white/5 w-8 h-8 rounded-full flex items-center justify-center mx-auto border border-white/10">02</div>
                        <p class="font-medium text-sm text-white">Telaah Materi</p>
                    </div>
                    <div class="space-y-3">
                        <div class="text-xs font-mono text-emerald-400 font-bold bg-white/5 w-8 h-8 rounded-full flex items-center justify-center mx-auto border border-white/10">03</div>
                        <p class="font-medium text-sm text-white">Latihan Praktik</p>
                    </div>
                    <div class="space-y-3">
                        <div class="text-xs font-mono text-emerald-400 font-bold bg-white/5 w-8 h-8 rounded-full flex items-center justify-center mx-auto border border-white/10">04</div>
                        <p class="font-medium text-sm text-white">Komputasi AI</p>
                    </div>
                    <div class="space-y-3 col-span-2 md:col-span-1">
                        <div class="text-xs font-mono text-emerald-400 font-bold bg-white/5 w-8 h-8 rounded-full flex items-center justify-center mx-auto border border-white/10">05</div>
                        <p class="font-medium text-sm text-white">Analisis Feedback</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="benefit" class="py-24">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16 space-y-2">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-600">Hasil Output</h2>
                    <h3 class="text-3xl font-bold tracking-tight text-zinc-900">Manfaat Jangka Panjang</h3>
                </div>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="border border-zinc-100 rounded-2xl p-8 bg-zinc-50/30 space-y-4">
                        <h4 class="font-bold text-zinc-900 text-lg">Kompetensi Linguistik Agrikultur</h4>
                        <ul class="space-y-3 text-sm text-zinc-600">
                            <li class="flex items-start gap-3"><span class="text-emerald-500 font-bold">▪</span> Peningkatan pemahaman jurnal internasional secara signifikan.</li>
                            <li class="flex items-start gap-3"><span class="text-emerald-500 font-bold">▪</span> Penguasaan menyeluruh terminologi agraria spesifik.</li>
                            <li class="flex items-start gap-3"><span class="text-emerald-500 font-bold">▪</span> Kepercayaan diri tinggi pada pelafalan istilah teknis ilmiah.</li>
                        </ul>
                    </div>
                    <div class="border border-zinc-100 rounded-2xl p-8 bg-zinc-50/30 space-y-4">
                        <h4 class="font-bold text-zinc-900 text-lg">Efisiensi Metodologi Belajar</h4>
                        <ul class="space-y-3 text-sm text-zinc-600">
                            <li class="flex items-start gap-3"><span class="text-emerald-500 font-bold">▪</span> Reduksi waktu tunggu hasil koreksi tugas secara instan.</li>
                            <li class="flex items-start gap-3"><span class="text-emerald-500 font-bold">▪</span> Kebebasan aksesibilitas belajar asinkronus (kapan saja).</li>
                            <li class="flex items-start gap-3"><span class="text-emerald-500 font-bold">▪</span> Kesiapan matang menghadapi standar Bahasa Inggris akademik global.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="py-24 bg-gradient-to-b from-white to-zinc-50 text-center">
            <div class="max-w-3xl mx-auto px-6 space-y-8">
                <h2 class="text-4xl md:text-5xl font-extrabold text-zinc-900 tracking-tight">Siap Memulai Transformasi Akademik Anda?</h2>
                <p class="text-zinc-600 max-w-xl mx-auto font-light">Dapatkan akses instan ke seluruh modul simulasi cerdas LexiAI sekarang.</p>
                <div>
                    <button class="bg-zinc-950 hover:bg-zinc-900 text-white px-10 py-4 rounded-xl font-semibold text-sm tracking-wide transition-all shadow-xl">
                        Mulai Sekarang
                    </button>
                </div>
            </div>
        </section>

        <footer class="border-t border-zinc-100 bg-white text-zinc-500 text-xs py-12">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <p>© 2026 LexiAI. All rights reserved.</p>
                <p class="font-medium text-zinc-400 uppercase tracking-widest text-[10px]">Artificial Intelligence for Agriculture English Learning</p>
            </div>
        </footer>

    </main>

</body>
</html>