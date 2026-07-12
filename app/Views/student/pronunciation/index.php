<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <!-- Header Ringkas -->
     <a href="<?= site_url('dashboard') ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Back to Reading

        </a>
    <div class="flex justify-between items-center pb-2 border-b border-zinc-200">

        <div>
            <h1 class="text-xl font-bold text-zinc-950">Pronunciation Practice</h1>
            <p class="text-xs text-zinc-500">Listen to the pronunciation, then record yourself saying the word.</p>
        </div>
        <span class="text-[10px] bg-zinc-950 text-white px-2.5 py-1 rounded font-medium uppercase tracking-wider">
            Module 3
        </span>
    </div>

    <?php if (!empty($vocabularies)): ?>
        <div class="overflow-hidden border border-zinc-200 rounded-xl bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-zinc-100 bg-zinc-50/70 text-[11px] font-semibold text-zinc-400 uppercase tracking-wider">
                            <th class="py-2.5 px-4 w-1/2">Word</th>
                            <th class="py-2.5 px-4 w-1/2">Meaning</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 text-xs">
                        <?php foreach ($vocabularies as $row): ?>
                            <tr class="hover:bg-zinc-50/60 transition-colors">
                                <!-- Word & Phonetic -->
                                <td class="py-3 px-4 font-semibold text-zinc-900 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button type="button"
                                                onclick="speakWord(this, '<?= esc($row['word'], 'js') ?>')"
                                                class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-zinc-100 hover:bg-zinc-200 text-zinc-600 transition shrink-0"
                                                title="Listen">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5">
                                                <path d="M11 5 6 9H2v6h4l5 4V5z"/>
                                                <path d="M15.54 8.46a5 5 0 0 1 0 7.07M18.36 5.64a9 9 0 0 1 0 12.72" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                                            </svg>
                                        </button>
                                        <span><?= esc($row['word']) ?></span>
                                        <?php if (!empty($row['pronunciation'])): ?>
                                            <span class="text-[11px] text-zinc-400 font-mono font-normal">[<?= esc($row['pronunciation']) ?>]</span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <!-- Meaning -->
                                <td class="py-3 px-4 text-zinc-600 max-w-xs truncate">
                                    <?= esc($row['meaning']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <!-- Empty State Container -->
        <div class="bg-white border border-zinc-200 rounded-xl p-8 text-center text-zinc-500 text-xs">
            No vocabulary available.
        </div>
    <?php endif; ?>
</div>

<script>
    function speakWord(btn, word) {
        if (!('speechSynthesis' in window)) {
            alert('Sorry, your browser does not support text-to-speech.');
            return;
        }

        // Stop any speech currently playing
        window.speechSynthesis.cancel();

        const utterance = new SpeechSynthesisUtterance(word);
        utterance.lang = 'en-US';
        utterance.rate = 0.85;

        // Small visual feedback while speaking
        btn.classList.add('bg-zinc-900', 'text-white');
        utterance.onend = () => btn.classList.remove('bg-zinc-900', 'text-white');
        utterance.onerror = () => btn.classList.remove('bg-zinc-900', 'text-white');

        window.speechSynthesis.speak(utterance);
    }
</script>
<?= $this->endSection() ?>