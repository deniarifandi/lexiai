<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto space-y-4">

    <!-- Top Nav -->
    <div class="flex justify-between items-center">
        <a href="<?= site_url('student/vocabulary') ?>" class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-950 inline-flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back
        </a>
        <span class="text-[10px] bg-zinc-950 text-white px-2 py-0.5 rounded font-medium uppercase tracking-wider">AI Feedback</span>
    </div>

    <!-- Header Card (Word & Score) -->
    <div class="bg-white border border-zinc-200 rounded-xl p-4 flex items-center justify-between shadow-sm">
        <div>
            <span class="text-[10px] uppercase tracking-wider text-zinc-400 font-bold">Target Vocabulary</span>
            <h1 class="text-2xl font-bold text-zinc-900 mt-0.5"><?= esc($answer['word']) ?></h1>
        </div>
        <div class="flex items-baseline gap-1 bg-zinc-50 border border-zinc-200 px-3 py-1.5 rounded-lg">
            <span class="text-2xl font-black text-emerald-600"><?= $answer['score'] ?? '-' ?></span>
            <span class="text-xs text-zinc-400">/100</span>
        </div>
    </div>

    <!-- Content Split Layout / Grid Kompak -->
    <div class="grid md:grid-cols-2 gap-4">

        <!-- Left: User Answer & Suggestion -->
        <div class="space-y-4">
            <!-- Your Sentence -->
            <div class="bg-white border border-zinc-200 rounded-xl p-4 shadow-sm">
                <h2 class="text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">Your Sentence</h2>
                <div class="bg-zinc-50 border border-zinc-100 rounded-lg p-3 text-sm text-zinc-800 font-medium leading-relaxed">
                    <?= nl2br(esc($answer['answer'])) ?>
                </div>
            </div>

            <!-- Suggested Sentence -->
            <div class="bg-white border border-zinc-200 rounded-xl p-4 shadow-sm">
                <h2 class="text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">Suggested Sentence</h2>
                <div class="bg-emerald-50/60 border border-emerald-100 text-emerald-950 rounded-lg p-3 text-sm italic leading-relaxed">
                    <?= nl2br(esc($answer['ai_suggestion'] ?? '-')) ?>
                </div>
            </div>
        </div>

        <!-- Right: AI Breakdown Feedback -->
        <div class="bg-white border border-zinc-200 rounded-xl p-4 shadow-sm flex flex-col justify-between">
            <div>
                <h2 class="text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">AI Analysis</h2>

                <?php
                // Decode JSON feedback
                $feedbackData = json_decode($answer['ai_feedback'] ?? '', true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($feedbackData)): ?>
                    <!-- Tampilan Terstruktur jika JSON -->
                    <div class="space-y-3 text-xs">
                        <?php if(!empty($feedbackData['overall'])): ?>
                            <p class="text-zinc-600 leading-relaxed bg-blue-50/50 border border-blue-100/70 p-2.5 rounded-lg"><?= esc($feedbackData['overall']) ?></p>
                        <?php endif; ?>

                        <?php if(!empty($feedbackData['strengths'])): ?>
                            <div>
                                <span class="font-bold text-emerald-700 block mb-1">✓ Strengths</span>
                                <ul class="list-disc pl-4 space-y-0.5 text-zinc-600">
                                    <?php foreach($feedbackData['strengths'] as $strength): ?>
                                        <li><?= esc($strength) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($feedbackData['improvements'])): ?>
                            <div>
                                <span class="font-bold text-amber-700 block mb-1">⚡ Improvements</span>
                                <ul class="list-disc pl-4 space-y-0.5 text-zinc-600">
                                    <?php foreach($feedbackData['improvements'] as $improve): ?>
                                        <li><?= esc($improve) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <!-- Fallback Teks Biasa -->
                    <div class="bg-blue-50/60 border border-blue-100 text-zinc-700 rounded-lg p-3 text-xs leading-relaxed">
                        <?= nl2br(esc($answer['ai_feedback'] ?? 'No feedback available.')) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- AI Tutor Chat Panel -->
    <div class="bg-white border border-zinc-200 rounded-xl shadow-sm overflow-hidden flex flex-col">
        <div class="px-4 py-2.5 border-b border-zinc-100 bg-zinc-50/40 flex justify-between items-center">
            <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-500">Discuss with AI Tutor</span>
            <span class="inline-flex items-center gap-1 text-[10px] text-zinc-400">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Online
            </span>
        </div>
        <div id="chat-log" class="p-4 space-y-2.5 max-h-64 min-h-[120px] overflow-y-auto text-xs bg-zinc-50/20">
            <div class="text-left">
                <span class="inline-block px-3 py-2 rounded-xl rounded-tl-none bg-white text-zinc-600 border border-zinc-200/80 max-w-[85%]">
                    Hi! Ada bagian dari feedback kosakata ini yang ingin kamu tanyakan lebih detail?
                </span>
            </div>
        </div>
        <div class="border-t p-2 bg-white flex gap-2 items-center">
            <input id="chat-input" type="text"
                   class="flex-1 rounded-lg border border-zinc-200 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-zinc-950 transition"
                   placeholder="Tanyakan sesuatu (cth: Kenapa kalimat saya kurang tepat?)...">
            <button id="chat-send"
                    class="bg-zinc-950 hover:bg-zinc-800 text-white px-3.5 py-2 rounded-lg text-xs font-semibold transition shrink-0">
                Send
            </button>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end gap-2 pt-2">
        <a href="<?= site_url('student/vocabulary') ?>" class="px-4 py-2 border border-zinc-300 rounded-lg hover:bg-zinc-50 text-xs font-semibold text-zinc-700 transition">
            Back to List
        </a>
        <?php if (!empty($nextVocabularyId)): ?>
            <a href="<?= site_url('student/vocabulary/start/' . $nextVocabularyId) ?>"
               class="px-4 py-2 bg-zinc-950 text-white rounded-lg hover:bg-zinc-900 text-xs font-semibold shadow-sm transition">
                Next Vocabulary
            </a>
        <?php elseif(false): ?>
            <span class="px-4 py-2 bg-zinc-100 text-zinc-400 rounded-lg text-xs font-semibold cursor-not-allowed">
                No More Vocabulary
            </span>
        <?php endif; ?>
    </div>

</div>

<script type="text/javascript">
(function () {
    const answerId = <?= (int) $answer['id'] ?>;
    const csrfName = '<?= csrf_token() ?>';
    const csrfHash = '<?= csrf_hash() ?>';

    const log = document.getElementById('chat-log');
    const input = document.getElementById('chat-input');
    const sendBtn = document.getElementById('chat-send');

    let history = [];
    let typingEl = null;

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function parseMarkdown(text) {
        const safe = escapeHtml(text);
        return safe
            .replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-zinc-900">$1</strong>')
            .replace(/\*(.*?)\*/g, '<em class="italic text-zinc-700">$1</em>')
            .replace(/\n/g, '<br>');
    }

    function addBubble(role, text) {
        const div = document.createElement('div');
        div.className = role === 'user' ? 'text-right' : 'text-left';

        const bubbleStyle = role === 'user'
            ? 'bg-zinc-950 text-white rounded-br-none'
            : 'bg-white text-zinc-700 border border-zinc-200 rounded-tl-none';

        div.innerHTML = `
            <span class="inline-block px-3 py-2 rounded-xl text-xs max-w-[85%] shadow-sm ${bubbleStyle}">
                ${parseMarkdown(text)}
            </span>
        `;
        log.appendChild(div);
        log.scrollTop = log.scrollHeight;
    }

    function showTyping() {
        typingEl = document.createElement('div');
        typingEl.className = 'text-left';
        typingEl.innerHTML = `
            <span class="inline-flex gap-1 items-center px-3 py-2.5 rounded-xl rounded-tl-none bg-white border border-zinc-200 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-zinc-400 animate-bounce" style="animation-delay:0ms"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-zinc-400 animate-bounce" style="animation-delay:150ms"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-zinc-400 animate-bounce" style="animation-delay:300ms"></span>
            </span>
        `;
        log.appendChild(typingEl);
        log.scrollTop = log.scrollHeight;
    }

    function hideTyping() {
        if (typingEl) {
            typingEl.remove();
            typingEl = null;
        }
    }

    async function sendMessage() {
        const message = input.value.trim();
        if (!message) return;

        addBubble('user', message);
        input.value = '';
        sendBtn.disabled = true;
        input.disabled = true;

        showTyping();

        try {
            const formData = new FormData();
            formData.append('answer_id', answerId);
            formData.append('message', message);
            formData.append(csrfName, csrfHash);
            history.forEach((h, i) => {
                formData.append(`history[${i}][role]`, h.role);
                formData.append(`history[${i}][content]`, h.content);
            });

            const res = await fetch('<?= site_url('student/vocabulary/chat') ?>', {
                method: 'POST',
                body: formData,
            });

            const data = await res.json();
            const reply = data.reply || 'Sorry, something went wrong.';

            hideTyping();
            addBubble('assistant', reply);
            history.push({ role: 'user', content: message });
            history.push({ role: 'assistant', content: reply });

        } catch (e) {
            hideTyping();
            addBubble('assistant', 'Sorry, something went wrong.');
        } finally {
            sendBtn.disabled = false;
            input.disabled = false;
            input.focus();
        }
    }

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') sendMessage();
    });
})();
</script>

<?= $this->endSection() ?>