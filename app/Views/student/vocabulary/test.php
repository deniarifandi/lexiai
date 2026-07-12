<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <a href="<?= site_url('student/vocabulary') ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Back to Vocabulary

        </a>

        <span class="text-[10px] bg-zinc-900 text-white px-3 py-1 rounded-md uppercase tracking-widest">
            Vocabulary Practice
        </span>

    </div>

    <div class="grid lg:grid-cols-12 gap-6">

        <!-- LEFT -->

        <div class="lg:col-span-7">

            <div class="bg-white border border-zinc-200 rounded-xl p-8 space-y-8">

                <div>

                    <div class="text-xs uppercase tracking-widest text-zinc-400 font-bold">
                        Target Vocabulary
                    </div>

                    <h1 class="text-4xl font-bold mt-2">
                        <?= esc($vocabulary['word']) ?>
                    </h1>

                    <?php if(!empty($vocabulary['pronunciation'])): ?>

                        <p class="mt-2 text-zinc-500">

                            <?= esc($vocabulary['pronunciation']) ?>

                        </p>

                    <?php endif; ?>

                    <?php if(!empty($vocabulary['audio_url'])): ?>

                        <audio controls class="mt-4 w-full">

                            <source src="<?= base_url($vocabulary['audio_url']) ?>">

                        </audio>

                    <?php endif; ?>

                </div>

                <div>

                    <h2 class="font-semibold mb-2">
                        Meaning
                    </h2>

                    <p class="text-zinc-700">

                        <?= esc($vocabulary['meaning']) ?>

                    </p>

                </div>

                <div>

                    <h2 class="font-semibold mb-2">
                        Definition
                    </h2>

                    <p class="text-zinc-700 leading-7">

                        <?= esc($vocabulary['definition']) ?>

                    </p>

                </div>

                <?php if($example): ?>

                <div>

                    <h2 class="font-semibold mb-3">
                        Example
                    </h2>

                    <div class="bg-zinc-50 border rounded-xl p-5">

                        <p class="leading-7">

                            <?= esc($example['sentence']) ?>

                        </p>

                        <?php if($example['translation']): ?>

                            <p class="mt-4 text-sm text-zinc-500">

                                <?= esc($example['translation']) ?>

                            </p>

                        <?php endif; ?>

                    </div>

                </div>

                <?php endif; ?>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="lg:col-span-5">

            <form method="post"
                  action="<?= site_url('student/vocabulary/save-answer') ?>">

                <?= csrf_field() ?>

                <input type="hidden"
                       name="attempt_id"
                       value="<?= $attempt['id'] ?>">

                <div class="bg-white border border-zinc-200 rounded-xl">

                    <div class="p-6 border-b">

                        <h3 class="font-bold">

                            Sentence Construction

                        </h3>

                    </div>

                    <div class="p-6 space-y-6">

                        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5">

                            <div class="text-xs uppercase font-bold text-emerald-700">

                                Instruction

                            </div>

                            <p class="mt-3 text-zinc-700 leading-7">

                                

                            </p>

                        </div>

                        <div>

                            <label class="block text-xs uppercase font-bold text-zinc-500 mb-2">

                                Your Sentence

                            </label>

                            <textarea
                                name="answer"
                                rows="8"
                                required
                                class="w-full rounded-xl border border-zinc-200 p-4 focus:ring-1 focus:ring-zinc-900 focus:outline-none"
                                placeholder="Write one meaningful English sentence using the target vocabulary..."></textarea>

                        </div>

                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">

                            <div class="text-xs font-bold uppercase text-blue-700 mb-2">

                                AI Tips

                            </div>

                            <ul class="text-xs text-zinc-600 list-disc pl-5 space-y-1">

                                <li>Use the target vocabulary naturally.</li>

                                <li>Write a complete sentence.</li>

                                <li>Use correct grammar.</li>

                                <li>Use an agricultural context if possible.</li>

                                <li>Avoid writing only a phrase.</li>

                            </ul>

                        </div>

                    </div>

                    <div class="border-t p-6 flex justify-end">

                        <button
                            class="bg-zinc-900 hover:bg-zinc-800 text-white px-6 py-3 rounded-xl text-sm font-semibold">

                            Submit Sentence

                        </button>

                    </div>

                </div>

            </form>

            <div id="submit-overlay"
     class="hidden fixed inset-0 z-50 bg-white/80 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-white border border-zinc-200 rounded-2xl shadow-lg p-8 w-[90%] max-w-sm text-center space-y-4">

        <div class="mx-auto w-14 h-14 rounded-full border-4 border-zinc-100 border-t-emerald-500 animate-spin"></div>

        <div>
            <h3 class="font-bold text-zinc-900 text-sm">
                Evaluating your sentence
            </h3>

            <p id="overlay-msg"
               class="text-xs text-zinc-500 mt-1 transition-opacity duration-300">
                Sending your sentence to AI Tutor...
            </p>
        </div>

        <div class="w-full bg-zinc-100 rounded-full h-1.5 overflow-hidden">
            <div id="overlay-bar"
                 class="bg-emerald-500 h-1.5 rounded-full transition-all duration-700"
                 style="width:8%">
            </div>
        </div>

    </div>
</div>

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
            overlayBar.style.width =
                widths[Math.min(step + 1, widths.length - 1)] + '%';
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