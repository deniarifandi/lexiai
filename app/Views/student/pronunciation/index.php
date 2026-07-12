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
            <p class="text-xs text-zinc-500">Listen carefully to each word, then try saying it out loud yourself.</p>
        </div>
        <span class="text-[10px] bg-zinc-950 text-white px-2.5 py-1 rounded font-medium uppercase tracking-wider">
            Module 3
        </span>
    </div>

    <?php if (!empty($vocabularies)): ?>

        <!-- Toolbar: accent + practice mode + progress -->
        <div class="flex flex-wrap items-center justify-between gap-3 bg-white border border-zinc-200 rounded-xl px-4 py-3 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <label class="text-[11px] font-semibold text-zinc-400 uppercase tracking-wider">Accent</label>
                    <select id="accentSelect" class="text-xs border border-zinc-200 rounded-lg px-2 py-1.5 bg-zinc-50 text-zinc-700 focus:outline-none focus:ring-1 focus:ring-zinc-400">
                        <option value="en-US">American English</option>
                        <option value="en-GB">British English</option>
                    </select>
                </div>

                <button type="button" id="playAllBtn" onclick="togglePlayAll()"
                        class="inline-flex items-center gap-1.5 text-xs font-semibold bg-zinc-900 text-white px-3 py-1.5 rounded-lg hover:bg-zinc-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    <span id="playAllLabel">Practice All</span>
                </button>
            </div>

            <div class="text-[11px] text-zinc-500 font-medium">
                <span id="progressLabel">0</span> / <?= count($vocabularies) ?> words listened
            </div>
        </div>

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
                        <?php foreach ($vocabularies as $i => $row): ?>
                            <tr class="hover:bg-zinc-50/60 transition-colors" id="row-<?= $i ?>" data-word="<?= esc($row['word'], 'js') ?>">
                                <!-- Word & Phonetic -->
                                <td class="py-3 px-4 font-semibold text-zinc-900 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button type="button"
                                                onclick="speakWord(<?= $i ?>, '<?= esc($row['word'], 'js') ?>', 0.85)"
                                                class="speak-btn inline-flex items-center justify-center w-6 h-6 rounded-full bg-zinc-100 hover:bg-zinc-200 text-zinc-600 transition shrink-0"
                                                title="Listen (normal speed)"
                                                id="btn-normal-<?= $i ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5">
                                                <path d="M11 5 6 9H2v6h4l5 4V5z"/>
                                                <path d="M15.54 8.46a5 5 0 0 1 0 7.07M18.36 5.64a9 9 0 0 1 0 12.72" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                                            </svg>
                                        </button>

                                        <button type="button"
                                                onclick="speakWord(<?= $i ?>, '<?= esc($row['word'], 'js') ?>', 0.5)"
                                                class="speak-btn inline-flex items-center justify-center w-6 h-6 rounded-full bg-zinc-100 hover:bg-zinc-200 text-zinc-600 transition shrink-0"
                                                title="Listen (slow)"
                                                id="btn-slow-<?= $i ?>">
                                            <span class="text-[10px] font-bold">0.5x</span>
                                        </button>

                                        <span><?= esc($row['word']) ?></span>
                                        <?php if (!empty($row['pronunciation'])): ?>
                                            <span class="text-[11px] text-zinc-400 font-mono font-normal">[<?= esc($row['pronunciation']) ?>]</span>
                                        <?php endif; ?>

                                        <span class="play-count text-[10px] text-zinc-300 font-normal" id="count-<?= $i ?>"></span>
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
    const playCounts = {};
    let isPlayingAll = false;
    let playAllIndex = 0;
    const totalWords = <?= isset($vocabularies) ? count($vocabularies) : 0 ?>;

    function getAccent() {
        return document.getElementById('accentSelect').value;
    }

    function highlightRow(index, active) {
        const row = document.getElementById('row-' + index);
        if (!row) return;
        row.classList.toggle('bg-amber-50', active);
        row.classList.toggle('ring-1', active);
        row.classList.toggle('ring-amber-200', active);
    }

    function bumpCount(index) {
        playCounts[index] = (playCounts[index] || 0) + 1;
        const el = document.getElementById('count-' + index);
        if (el) el.textContent = playCounts[index] + 'x';

        const listened = Object.keys(playCounts).length;
        document.getElementById('progressLabel').textContent = listened;
    }

    function speakWord(index, word, rate, onEndCallback) {
        if (!('speechSynthesis' in window)) {
            alert('Sorry, your browser does not support text-to-speech.');
            return;
        }

        window.speechSynthesis.cancel();

        const utterance = new SpeechSynthesisUtterance(word);
        utterance.lang = getAccent();
        utterance.rate = rate;

        highlightRow(index, true);
        bumpCount(index);

        utterance.onend = () => {
            highlightRow(index, false);
            if (onEndCallback) onEndCallback();
        };
        utterance.onerror = () => {
            highlightRow(index, false);
            if (onEndCallback) onEndCallback();
        };

        window.speechSynthesis.speak(utterance);
    }

    function togglePlayAll() {
        if (isPlayingAll) {
            stopPlayAll();
            return;
        }

        isPlayingAll = true;
        playAllIndex = 0;
        document.getElementById('playAllLabel').textContent = 'Stop';
        playNextInSequence();
    }

    function playNextInSequence() {
        if (!isPlayingAll || playAllIndex >= totalWords) {
            stopPlayAll();
            return;
        }

        const row = document.getElementById('row-' + playAllIndex);
        const word = row.dataset.word;

        speakWord(playAllIndex, word, 0.85, () => {
            playAllIndex++;
            setTimeout(playNextInSequence, 500);
        });
    }

    function stopPlayAll() {
        isPlayingAll = false;
        window.speechSynthesis.cancel();
        document.getElementById('playAllLabel').textContent = 'Practice All';
    }
</script>
<?= $this->endSection() ?>