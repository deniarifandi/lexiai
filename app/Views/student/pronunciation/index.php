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

                                        <button type="button"
                                                onclick="toggleRecord(<?= $i ?>, '<?= esc($row['word'], 'js') ?>')"
                                                class="record-btn inline-flex items-center justify-center w-6 h-6 rounded-full bg-red-50 hover:bg-red-100 text-red-500 transition shrink-0"
                                                title="Record your voice"
                                                id="btn-record-<?= $i ?>">
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
</script>
<?= $this->endSection() ?>