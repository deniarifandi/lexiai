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

    <?php if (!empty($vocabularies)):

        // Re-index sequentially (0..n-1) in original order first, so JS index
        // references stay stable no matter how we group/display them.
        $indexed = [];
        foreach ($vocabularies as $row) {
            $indexed[] = $row;
        }

        // Group by first letter of the word, keeping the global $i per row.
        $groupedVocab = [];
        foreach ($indexed as $i => $row) {
            $letter = strtoupper(substr(trim($row['word']), 0, 1));
            if (!ctype_alpha($letter)) $letter = '#';
            $groupedVocab[$letter][] = ['i' => $i, 'row' => $row];
        }
        ksort($groupedVocab);

        $alphabet = range('A', 'Z');
    ?>

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
                <span id="progressLabel">0</span> / <?= count($indexed) ?> words listened
            </div>
        </div>

        <!-- Search -->
        <div class="relative">
            <input type="text" id="vocabSearch" placeholder="Search word or meaning..."
                   class="w-full text-xs border border-zinc-200 rounded-lg py-2 pl-8 pr-3 focus:outline-none focus:ring-2 focus:ring-zinc-900/10 focus:border-zinc-400 placeholder:text-zinc-400">
            <svg class="w-4 h-4 text-zinc-400 absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
            </svg>
        </div>

        <!-- Alphabet Filter Nav -->
        <div class="sticky top-0 z-10 bg-white/90 backdrop-blur border border-zinc-200 rounded-xl px-2 py-1.5 flex flex-wrap gap-1 shadow-sm">
            <button type="button" onclick="filterByLetter('all', this)"
                    data-letter-btn="all"
                    class="letter-filter-btn active px-2 h-6 flex items-center justify-center text-[11px] font-bold rounded-md bg-zinc-900 text-white transition">
                All
            </button>
            <?php foreach ($alphabet as $letter): ?>
                <?php $hasWords = !empty($groupedVocab[$letter]); ?>
                <?php if ($hasWords): ?>
                    <button type="button" onclick="filterByLetter('<?= $letter ?>', this)"
                            data-letter-btn="<?= $letter ?>"
                            class="letter-filter-btn w-6 h-6 flex items-center justify-center text-[11px] font-bold rounded-md bg-zinc-100 text-zinc-700 hover:bg-zinc-900 hover:text-white transition">
                        <?= $letter ?>
                    </button>
                <?php else: ?>
                    <span class="w-6 h-6 flex items-center justify-center text-[11px] font-medium rounded-md text-zinc-300 cursor-default">
                        <?= $letter ?>
                    </span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="space-y-4">
            <?php foreach ($groupedVocab as $letter => $entries): ?>
                <div id="letter-<?= $letter ?>" class="scroll-mt-16 overflow-hidden border border-zinc-200 rounded-xl bg-white shadow-sm vocab-section">

                    <!-- Header Huruf -->
                    <div class="px-4 py-2 bg-zinc-50 border-b border-zinc-200 flex items-center gap-2">
                        <span class="text-xs font-bold text-zinc-800 tracking-wide"><?= $letter ?></span>
                        <span class="text-[10px] px-1.5 py-0.1 bg-zinc-200/60 text-zinc-600 rounded-full font-medium font-mono">
                            <?= count($entries) ?>
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-zinc-100 bg-zinc-50/70 text-[11px] font-semibold text-zinc-400 uppercase tracking-wider">
                                    <th class="py-2.5 px-4 w-1/2">Word</th>
                                    <th class="py-2.5 px-4 w-1/2">Meaning</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 text-xs">
                                <?php foreach ($entries as $entry):
                                    $i = $entry['i'];
                                    $row = $entry['row'];
                                ?>
                                    <tr class="hover:bg-zinc-50/60 transition-colors vocab-row"
                                        id="row-<?= $i ?>"
                                        data-word="<?= esc($row['word'], 'js') ?>"
                                        data-search-word="<?= esc(strtolower($row['word'])) ?>"
                                        data-search-meaning="<?= esc(strtolower($row['meaning'])) ?>">
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

                                                <button type="button"
                                                        onclick="toggleRecord(<?= $i ?>, '<?= esc($row['word'], 'js') ?>')"
                                                        class="record-btn inline-flex items-center justify-center w-6 h-6 rounded-full bg-red-50 hover:bg-red-100 text-red-500 transition shrink-0"
                                                        title="Record your voice"
                                                        id="btn-record-<?= $i ?>" style="display: none;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3">
                                                        <circle cx="12" cy="12" r="8"/>
                                                    </svg>
                                                </button>

                                                <span><?= esc($row['word']) ?></span>
                                                <?php if (!empty($row['pronunciation'])): ?>
                                                    <span class="text-[11px] text-zinc-400 font-mono font-normal">[<?= esc($row['pronunciation']) ?>]</span>
                                                <?php endif; ?>

                                                <span class="play-count text-[10px] text-zinc-300 font-normal" id="count-<?= $i ?>"></span>
                                            </div>

                                            <!-- AI Feedback Panel (hidden by default) -->
                                            <div id="feedback-<?= $i ?>" class="hidden mt-2 text-[11px] font-normal rounded-lg px-3 py-2 border"></div>
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
            <?php endforeach; ?>
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
    const totalWords = <?= isset($indexed) ? count($indexed) : 0 ?>;
    // Sequence of row indices in the order they appear on the page (alphabetical),
    // so "Practice All" walks through them in the same order the student sees.
    const playOrder = <?= isset($groupedVocab) ? json_encode(array_merge(...array_map(fn($entries) => array_map(fn($e) => $e['i'], $entries), array_values($groupedVocab)))) : '[]' ?>;

    function getAccent() {
        return document.getElementById('accentSelect').value;
    }

    // --- Voice loading ---
    // Fix: di Android/Chrome, kalau bahasa sistem HP = Indonesia, engine TTS
    // kadang mengabaikan utterance.lang dan tetap pakai voice Indonesia default.
    // Solusinya: assign objek voice secara eksplisit, jangan cuma andalkan .lang
    let availableVoices = [];

    function loadVoices() {
        availableVoices = window.speechSynthesis.getVoices();
    }

    loadVoices();
    if ('onvoiceschanged' in window.speechSynthesis) {
        window.speechSynthesis.onvoiceschanged = loadVoices;
    }

    function pickVoiceForLang(langCode) {
        if (!availableVoices.length) loadVoices();

        // 1. Exact match, misal "en-US"
        let voice = availableVoices.find(v => v.lang === langCode);
        if (voice) return voice;

        // 2. Prefix match, "en-US" -> voice apapun yang berawalan "en-"
        const prefix = langCode.split('-')[0];
        voice = availableVoices.find(v => v.lang.toLowerCase().startsWith(prefix));
        if (voice) return voice;

        // 3. Tidak ada voice bahasa Inggris terpasang di device
        return null;
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

    const langCode = getAccent();
    const utterance = new SpeechSynthesisUtterance(word);
    utterance.lang = langCode;

    const voice = pickVoiceForLang(langCode);
    if (voice) {
        utterance.voice = voice;
    } else {
        // Device tidak punya voice bahasa Inggris — beri tahu user sekali saja
        console.warn('No English voice found on this device for', langCode);
    }

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
        if (!isPlayingAll || playAllIndex >= playOrder.length) {
            stopPlayAll();
            return;
        }

        const realIndex = playOrder[playAllIndex];
        const row = document.getElementById('row-' + realIndex);
        const word = row.dataset.word;

        speakWord(realIndex, word, 0.85, () => {
            playAllIndex++;
            setTimeout(playNextInSequence, 500);
        });
    }

    function stopPlayAll() {
        isPlayingAll = false;
        window.speechSynthesis.cancel();
        document.getElementById('playAllLabel').textContent = 'Practice All';
    }

    /*
    |--------------------------------------------------------------------------
    | Recording + AI Review (no save, ephemeral)
    |--------------------------------------------------------------------------
    */

    const SpeechRecognitionAPI = window.SpeechRecognition || window.webkitSpeechRecognition;
let recognizer = null;
let recordingIndex = null;
let recordTimeoutId = null;

const RECORD_ERROR_MESSAGES = {
    'not-allowed': 'Akses mikrofon ditolak. Cek izin mikrofon di pengaturan browser kamu.',
    'service-not-allowed': 'Akses mikrofon ditolak oleh browser. Cek pengaturan izin mikrofon.',
    'audio-capture': 'Mikrofon tidak terdeteksi. Pastikan mikrofon tidak dipakai aplikasi lain.',
    'network': 'Koneksi internet bermasalah saat memproses suara. Coba lagi.',
    'aborted': 'Rekaman dibatalkan. Coba lagi.',
    'no-speech': 'Tidak ada suara terdeteksi. Coba lagi dan ucapkan lebih jelas.',
    'language-not-supported': 'Bahasa/aksen ini tidak didukung untuk speech recognition di device kamu.',
};

// Feature-detect: only show the mic button in browsers that actually
// support SpeechRecognition. Fixes the bug where the button was
// hard-coded to display:none and nothing ever revealed it.
document.addEventListener('DOMContentLoaded', () => {
    if (SpeechRecognitionAPI) {
        document.querySelectorAll('.record-btn').forEach(btn => {
            //btn.style.display = '';
        });
    }
});

function toggleRecord(index, word) {
    if (!SpeechRecognitionAPI) {
        alert('Browser kamu belum mendukung fitur record ini. Coba pakai Chrome atau Edge.');
        return;
    }

    // Kalau sedang record (baris manapun), abaikan klik — biarkan auto-stop
    if (recordingIndex !== null) {
        console.log('[speech] ignoring click, recording still in progress');
        return;
    }

    recordingIndex = index;
    const btn = document.getElementById('btn-record-' + index);
    btn.classList.add('bg-red-500', 'text-white', 'animate-pulse');
    btn.disabled = true; // cegah double-tap di baris yang sama

    const panel = document.getElementById('feedback-' + index);
    panel.className = 'mt-2 text-[11px] font-normal rounded-lg px-3 py-2 border bg-zinc-50 border-zinc-200 text-zinc-500';
    panel.textContent = 'Mendengarkan... ucapkan kata "' + word + '"';
    panel.classList.remove('hidden');

    recognizer = new SpeechRecognitionAPI();
    recognizer.lang = getAccent();
    recognizer.maxAlternatives = 1;
    recognizer.interimResults = false;

    let resultReceived = false;

    recognizer.onstart = () => {
        console.log('[speech] started listening for word:', word);
        recordTimeoutId = setTimeout(() => {
            if (recordingIndex === index) {
                console.log('[speech] timeout guard triggered, forcing stop');
                try { recognizer.abort(); } catch (e) {}
                showFeedback(index, {
                    ok: true,
                    score: 0,
                    feedback: 'Rekaman terlalu lama tidak merespons. Coba lagi (cek koneksi internet).',
                    tip: '',
                });
                resetRecordButton(index);
            }
        }, 5000);
    };

    recognizer.onresult = (event) => {
        resultReceived = true;
        console.log('[speech] onresult fired', event);
        const transcript = event.results[0][0].transcript;
        sendForReview(index, word, transcript);
    };

    recognizer.onerror = (event) => {
        console.log('[speech] onerror:', event.error);
        resultReceived = true;
        resetRecordButton(index);

        const message = RECORD_ERROR_MESSAGES[event.error]
            || ('Terjadi kesalahan saat merekam (' + event.error + '). Coba lagi.');

        showFeedback(index, {
            ok: true,
            score: 0,
            feedback: message,
            tip: '',
        });
    };

    recognizer.onend = () => {
        console.log('[speech] onend fired');
        clearTimeout(recordTimeoutId);
        if (!resultReceived) {
            showFeedback(index, {
                ok: true,
                score: 0,
                feedback: 'Rekaman berhenti tanpa hasil. Coba lagi, atau cek koneksi internet kamu.',
                tip: '',
            });
        }
        resetRecordButton(index);
    };

    try {
        recognizer.start();
    } catch (err) {
        console.log('[speech] failed to start:', err);
        showFeedback(index, {
            ok: true,
            score: 0,
            feedback: 'Gagal memulai rekaman. Coba klik tombol record sekali lagi.',
            tip: '',
        });
        resetRecordButton(index);
    }
}

function resetRecordButton(index) {
    const btn = document.getElementById('btn-record-' + index);
    if (btn) {
        btn.classList.remove('bg-red-500', 'text-white', 'animate-pulse');
        btn.disabled = false;
    }
    clearTimeout(recordTimeoutId);
    recordingIndex = null;
    recognizer = null;
}

    async function sendForReview(index, word, transcript) {
        const panel = document.getElementById('feedback-' + index);
        panel.className = 'mt-2 text-[11px] font-normal rounded-lg px-3 py-2 border bg-zinc-50 border-zinc-200 text-zinc-500';
        panel.textContent = 'Menilai ucapanmu...';

        try {
            const response = await fetch('<?= site_url('student/pronunciation/review') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new URLSearchParams({
                    word: word,
                    transcript: transcript,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                }),
            });

            const data = await response.json();
            showFeedback(index, data);
        } catch (err) {
            panel.className = 'mt-2 text-[11px] font-normal rounded-lg px-3 py-2 border bg-red-50 border-red-200 text-red-600';
            panel.textContent = 'Gagal menghubungi server. Coba lagi.';
        }
    }

    function showFeedback(index, data) {
        const panel = document.getElementById('feedback-' + index);

        if (!data.ok) {
            panel.className = 'mt-2 text-[11px] font-normal rounded-lg px-3 py-2 border bg-red-50 border-red-200 text-red-600';
            panel.textContent = data.message || 'Terjadi kesalahan.';
            return;
        }

        const score = data.score;
        let colorClass = 'bg-emerald-50 border-emerald-200 text-emerald-700';
        if (score < 40) colorClass = 'bg-red-50 border-red-200 text-red-600';
        else if (score < 75) colorClass = 'bg-amber-50 border-amber-200 text-amber-700';

        panel.className = 'mt-2 text-[11px] font-normal rounded-lg px-3 py-2 border ' + colorClass;
        panel.innerHTML = `
            <div class="font-semibold mb-0.5">Score: ${score}/100 ${data.heard_as ? '&middot; terdengar: "' + data.heard_as + '"' : ''}</div>
            <div>${data.feedback}</div>
            ${data.tip ? '<div class="mt-1 italic">Tip: ' + data.tip + '</div>' : ''}
        `;
    }

    // Combined letter filter + search filter
    let activeLetter = 'all';

    function filterByLetter(letter, btnEl) {
        activeLetter = letter;

        document.querySelectorAll('.letter-filter-btn').forEach(btn => {
            const isActive = btn.dataset.letterBtn === letter;
            btn.classList.toggle('active', isActive);
            btn.classList.toggle('bg-zinc-900', isActive);
            btn.classList.toggle('text-white', isActive);
            btn.classList.toggle('bg-zinc-100', !isActive);
            btn.classList.toggle('text-zinc-700', !isActive);
        });

        applyFilters();
    }

    function applyFilters() {
        const q = (document.getElementById('vocabSearch')?.value || '').trim().toLowerCase();
        const sections = document.querySelectorAll('.vocab-section');

        sections.forEach(section => {
            const sectionLetter = section.id.replace('letter-', '');
            const letterMatches = activeLetter === 'all' || sectionLetter === activeLetter;

            if (!letterMatches) {
                section.style.display = 'none';
                return;
            }

            let visibleCount = 0;
            section.querySelectorAll('.vocab-row').forEach(row => {
                const searchMatches = !q || row.dataset.searchWord.includes(q) || row.dataset.searchMeaning.includes(q);
                row.style.display = searchMatches ? '' : 'none';
                if (searchMatches) visibleCount++;
            });
            section.style.display = visibleCount > 0 ? '' : 'none';
        });
    }

    document.getElementById('vocabSearch')?.addEventListener('input', applyFilters);
</script>
<?= $this->endSection() ?>