<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <!-- Top Nav Ringkas -->
    <div class="flex justify-between items-center pb-1 border-b border-zinc-200">
        <a href="<?= site_url('student/vocabulary') ?>" class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-950 inline-flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back
        </a>
        <span class="text-[10px] bg-zinc-950 text-white px-2 py-0.5 rounded font-medium uppercase tracking-wider">Practice</span>
    </div>

    <div class="grid lg:grid-cols-12 gap-4 items-start">
        
        <!-- LEFT: Vocabulary Details -->
        <div class="lg:col-span-6 bg-white border border-zinc-200 rounded-xl p-5 space-y-4 shadow-sm">
            <div>
                <span class="text-[10px] uppercase tracking-wider text-zinc-400 font-bold">Target Vocabulary</span>
                <div class="flex items-baseline gap-2 mt-0.5 flex-wrap">
                    <h1 class="text-2xl font-bold text-zinc-900"><?= esc($vocabulary['word']) ?></h1>
                    <?php if(!empty($vocabulary['pronunciation'])): ?>
                        <span class="text-xs text-zinc-400 font-mono">[<?= esc($vocabulary['pronunciation']) ?>]</span>
                    <?php endif; ?>
                </div>

                <?php if(!empty($vocabulary['audio_url'])): ?>
                    <audio controls class="mt-3 h-7 w-full max-w-[280px] scale-95 origin-left text-xs">
                        <source src="<?= base_url($vocabulary['audio_url']) ?>">
                    </audio>
                <?php endif; ?>
            </div>

            <div class="text-xs border-t border-zinc-100 pt-3 space-y-2">
                <p class="text-zinc-600"><strong class="text-zinc-800">Meaning:</strong> <?= esc($vocabulary['meaning']) ?></p>
                <p class="text-zinc-500 leading-relaxed"><strong class="text-zinc-700">Definition:</strong> <?= esc($vocabulary['definition']) ?></p>
            </div>

            <?php if($example): ?>
                <div class="border-t border-zinc-100 pt-3">
                    <span class="text-[10px] uppercase tracking-wider text-zinc-400 font-bold block mb-1.5">Context Example</span>
                    <div class="bg-zinc-50 border border-zinc-100 rounded-lg p-3 text-xs leading-relaxed">
                        <p class="font-medium text-zinc-800 italic">"<?= esc($example['sentence']) ?>"</p>
                        <?php if($example['translation']): ?>
                            <p class="mt-1.5 text-zinc-500"><?= esc($example['translation']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- RIGHT: Form Input -->
        <div class="lg:col-span-6">
            <form method="post" action="<?= site_url('student/vocabulary/save-answer') ?>" class="bg-white border border-zinc-200 rounded-xl shadow-sm overflow-hidden">
                <?= csrf_field() ?>
                <input type="hidden" name="attempt_id" value="<?= $attempt['id'] ?>">

                <!-- Header Form Mini -->
                <div class="px-5 py-3 border-b border-zinc-100 bg-zinc-50/60">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-zinc-700">Sentence Construction</h3>
                </div>

                <div class="p-4 space-y-4">
                    <!-- Gabungan Tips & Instruction yang Ringkas -->
                    <div class="bg-emerald-50/60 border border-emerald-100 rounded-lg p-3 text-xs text-emerald-950">
                        <span class="font-bold block mb-1">💡 Instruction & AI Tips:</span>
                        <p class="leading-normal">Write <strong>one complete English sentence</strong> using the word naturally with correct grammar. Try relating it to an <strong>agricultural context</strong> (avoid writing just a short phrase).</p>
                    </div>

                    <!-- Input Area -->
                    <div>
                        <label class="block text-[10px] uppercase font-bold text-zinc-400 mb-1.5 tracking-wider">Your Sentence</label>
                        <textarea
                            name="answer"
                            rows="4"
                            required
                            class="w-full text-xs rounded-xl border border-zinc-200 p-3 focus:ring-1 focus:ring-zinc-950 focus:border-zinc-950 focus:outline-none placeholder-zinc-400 font-medium leading-relaxed shadow-inner"
                            placeholder="Type your sentence here..."></textarea>
                    </div>
                </div>

                <!-- Footer Form & Action -->
                <div class="bg-zinc-50/60 border-t border-zinc-100 px-4 py-2.5 flex justify-end">
                    <button class="bg-zinc-950 hover:bg-zinc-900 text-white px-4 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition">
                        Submit Sentence
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Loading Overlay -->
<div id="submit-overlay" class="hidden fixed inset-0 z-50 bg-white/80 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-white border border-zinc-200 rounded-2xl shadow-xl p-6 w-[90%] max-w-xs text-center space-y-3.5">
        <div class="mx-auto w-10 h-10 rounded-full border-4 border-zinc-100 border-t-emerald-500 animate-spin"></div>
        <div>
            <h3 class="font-bold text-zinc-900 text-xs">Evaluating your sentence</h3>
            <p id="overlay-msg" class="text-[11px] text-zinc-500 mt-0.5 transition-opacity duration-300">Sending your sentence to AI Tutor...</p>
        </div>
        <div class="w-full bg-zinc-100 rounded-full h-1 overflow-hidden">
            <div id="overlay-bar" class="bg-emerald-500 h-1 rounded-full transition-all duration-700" style="width:8%"></div>
        </div>
    </div>
</div>

<script>
(function () {
    const form = document.querySelector('form[action*="save-answer"]');
    const overlay = document.getElementById('submit-overlay');
    const overlayMsg = document.getElementById('overlay-msg');
    const overlayBar = document.getElementById('overlay-bar');
    const submitBtn = form.querySelector('button');

    const messages = [
        'Sending your sentence to AI Tutor...',
        'Checking grammar and vocabulary...',
        'Evaluating sentence quality...',
        'Almost done, preparing feedback...'
    ];
    const widths = [8, 35, 65, 85, 95];
    let step = 0;
    let msgInterval;

    form.addEventListener('submit', function () {
        const answer = form.querySelector('textarea[name="answer"]').value.trim();
        if (!answer) return;

        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');

        msgInterval = setInterval(function () {
            step = Math.min(step + 1, messages.length - 1);
            overlayMsg.textContent = messages[step];
            overlayBar.style.width = widths[Math.min(step + 1, widths.length - 1)] + '%';
        }, 1800);
    });

    window.addEventListener('pageshow', function (e) {
        if (e.persisted) {
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            clearInterval(msgInterval);
        }
    });
})();
</script>
<?= $this->endSection() ?>