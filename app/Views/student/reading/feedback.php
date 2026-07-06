<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<?php
$ai = [];
if (!empty($answer['ai_feedback'])) {
    $ai = json_decode($answer['ai_feedback'], true);
    if (!is_array($ai)) {
        $ai = [];
    }
}

$score = (int) ($ai['score'] ?? ($answer['ai_score'] ?? 0));
$level = $ai['level'] ?? 'Good';
$summary = $ai['overall'] ?? 'No feedback available.';

$percent = max(0, min(100, $score));
$degree = ($percent / 100) * 360;

$wordCount = str_word_count(strip_tags($answer['answer']));
?>

<style>
.score-ring {
    width: 80px;
    height: 80px;
    border-radius: 9999px;
    background: conic-gradient(#10b981 <?= $degree ?>deg, #e4e4e7 0deg);
    display: flex;
    align-items: center;
    justify-content: center;
}
.score-ring-inner {
    width: 66px;
    height: 66px;
    border-radius: 9999px;
    background: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
#chat-log::-webkit-scrollbar {
    width: 4px;
}
#chat-log::-webkit-scrollbar-thumb {
    background-color: #e4e4e7;
    border-radius: 2px;
}
</style>

<div class="mx-auto px-3 sm:px-4 py-3 space-y-4 text-zinc-900">

    <div class="flex justify-between items-center pb-2 border-b border-zinc-100">
        <a href="<?= site_url('student/reading') ?>"
           class="text-xs font-semibold text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-1.5 transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
        <span class="text-[9px] bg-zinc-900 text-zinc-100 px-2 py-0.5 rounded font-mono uppercase tracking-wider">
            AI Eval
        </span>
    </div>

    <div class="grid lg:grid-cols-12 gap-4 items-start">
        
        <div class="lg:col-span-8 space-y-4 order-1">
            
            <div class="bg-white border border-zinc-200 rounded-xl p-4 shadow-sm flex items-center gap-4">
                <div class="score-ring shrink-0 shadow-inner">
                    <div class="score-ring-inner">
                        <span class="text-2xl font-black text-zinc-900"><?= $score ?></span>
                        <span class="text-[8px] uppercase font-bold tracking-tight text-emerald-600"><?= esc($level) ?></span>
                    </div>
                </div>
                <div class="space-y-0.5 min-w-0">
                    <div class="text-[10px] font-bold text-emerald-700 uppercase tracking-wide">Result Summary</div>
                    <h2 class="text-base font-bold text-zinc-900 truncate">
                        <?= esc($material['title'] ?? $answer['material_title']) ?>
                    </h2>
                    <p class="text-xs text-zinc-500 leading-normal line-clamp-2 sm:line-clamp-none">
                        <?= esc($summary) ?>
                    </p>
                </div>
            </div>

            <div class="bg-white border border-zinc-200 rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 bg-zinc-50/60 border-b border-zinc-100">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block mb-1">Question</span>
                    <p class="text-xs sm:text-sm text-zinc-800 leading-relaxed font-medium"><?= esc($answer['question']) ?></p>
                </div>
                
                <div class="grid sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-zinc-100">
                    <div class="p-4 space-y-1.5">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Your Answer</span>
                        <div class="text-xs text-zinc-700 leading-relaxed whitespace-pre-line bg-zinc-50/50 p-3 rounded-lg border border-zinc-100 min-h-[60px]">
                            <?= esc(trim($answer['answer'])) ?>
                        </div>
                    </div>
                    <div class="p-4 space-y-1.5 bg-emerald-50/[0.01]">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block">Suggested Answer</span>
                            <span class="text-[8px] font-bold bg-emerald-100 text-emerald-800 px-1 rounded">AI REC</span>
                        </div>
                        <div class="text-xs text-zinc-700 leading-relaxed whitespace-pre-line bg-emerald-50/30 p-3 rounded-lg border border-emerald-100/60 min-h-[60px]">
                            <?= esc(trim($ai['recommended_answer'] ?? $answer['reference_answer'] ?? '-')) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-zinc-200 rounded-xl shadow-sm p-4 space-y-3">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Diagnostic Analysis</span>
                
                <div class="grid gap-2 sm:grid-cols-2">
                    <?php if(!empty($ai['strengths'])): ?>
                        <?php foreach($ai['strengths'] as $item): ?>
                            <div class="flex gap-2 p-2.5 rounded-lg border border-emerald-100 bg-emerald-50/20 text-xs">
                                <span class="text-emerald-600 font-bold shrink-0">✓</span>
                                <p class="text-zinc-700"><strong class="text-emerald-800">Strength:</strong> <?= esc($item) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if(!empty($ai['improvements'])): ?>
                        <?php foreach($ai['improvements'] as $item): ?>
                            <div class="flex gap-2 p-2.5 rounded-lg border border-amber-100 bg-amber-50/20 text-xs">
                                <span class="text-amber-500 font-bold shrink-0">!</span>
                                <p class="text-zinc-700"><strong class="text-amber-800">Improve:</strong> <?= esc($item) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if(!empty($ai['grammar'])): ?>
                        <?php foreach($ai['grammar'] as $item): ?>
                            <div class="flex gap-2 p-2.5 rounded-lg border border-sky-100 bg-sky-50/20 text-xs">
                                <span class="text-sky-600 font-bold shrink-0">G</span>
                                <p class="text-zinc-700"><strong class="text-sky-800">Grammar:</strong> <?= esc($item) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if(!empty($ai['vocabulary'])): ?>
                        <?php foreach($ai['vocabulary'] as $item): ?>
                            <div class="flex gap-2 p-2.5 rounded-lg border border-purple-100 bg-purple-50/20 text-xs">
                                <span class="text-purple-600 font-bold shrink-0">V</span>
                                <p class="text-zinc-700"><strong class="text-purple-800">Vocab:</strong> <?= esc($item) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <?php if(empty($ai)): ?>
                    <div class="rounded-lg border border-zinc-100 bg-zinc-50 p-3 text-xs text-zinc-500">
                        <?= nl2br(esc($answer['ai_feedback'])) ?>
                    </div>
                <?php endif; ?>
            </div>

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
                            Hi! Ada bagian dari evaluasi atau saran di atas yang ingin kamu tanyakan lebih detail?
                        </span>
                    </div>
                </div>
                <div class="border-t p-2 bg-white flex gap-2 items-center">
                    <input id="chat-input" type="text"
                           class="flex-1 rounded-lg border border-zinc-200 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-zinc-950 transition"
                           placeholder="Tanyakan sesuatu (cth: Kenapa grammar saya salah?)...">
                    <button id="chat-send"
                            class="bg-zinc-950 hover:bg-zinc-800 text-white px-3.5 py-2 rounded-lg text-xs font-semibold transition shrink-0">
                        Send
                    </button>
                </div>
            </div>

        </div>

        <div class="lg:col-span-4 space-y-4 order-2 lg:sticky lg:top-4">
            
            <div class="bg-white border border-zinc-200 rounded-xl p-4 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block mb-2">Metrics</span>
                <div class="grid grid-cols-2 gap-x-4 gap-y-2 lg:grid-cols-1 text-xs">
                    <div class="flex justify-between py-1 border-b border-zinc-100">
                        <span class="text-zinc-500">Score</span>
                        <span class="font-bold text-zinc-900"><?= $score ?>/100</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-zinc-100">
                        <span class="text-zinc-500">Words Count</span>
                        <span class="font-bold text-zinc-900"><?= $wordCount ?></span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-zinc-100">
                        <span class="text-zinc-500">Progress</span>
                        <span class="font-bold text-zinc-900"><?= $answeredQuestions ?>/<?= $totalQuestions ?></span>
                    </div>
                    <div class="flex justify-between py-1 lg:border-none">
                        <span class="text-zinc-500">Level Badge</span>
                        <span class="font-bold text-emerald-600"><?= esc($level) ?></span>
                    </div>
                </div>
            </div>

            <div class="bg-[#090d16] rounded-xl p-4 text-white relative overflow-hidden shadow-sm">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(16,185,129,.05),transparent_40%)]"></div>
                <div class="relative z-10 space-y-3">
                    <div>
                        <h3 class="text-sm font-bold text-zinc-100">
                            <?= $isFinished ? 'Reading Completed 🎉' : 'Next Action' ?>
                        </h3>
                        <p class="text-[11px] text-zinc-400 mt-0.5 leading-relaxed">
                            <?= $isFinished
                                ? 'Kamu telah menyelesaikan seluruh pertanyaan.'
                                : 'Lanjut pertanyaan berikutnya untuk meningkatkan kemampuanmu.' ?>
                        </p>
                    </div>

                    <div class="space-y-1.5">
                        <?php if($isFinished): ?>
                            <a href="<?= site_url('student/reading/result/'.$answer['attempt_id']) ?>"
                               class="block w-full bg-emerald-500 hover:bg-emerald-400 text-center text-zinc-950 text-xs font-bold py-2 rounded-lg transition">
                                View Final Result
                            </a>
                        <?php else: ?>
                            <a href="<?= site_url('student/reading/test/'.$answer['attempt_id']) ?>"
                               class="block w-full bg-emerald-500 hover:bg-emerald-400 text-center text-zinc-950 text-xs font-bold py-2 rounded-lg transition">
                                Continue →
                            </a>
                        <?php endif; ?>

                        <a href="<?= site_url('student/reading') ?>"
                           class="block w-full bg-white/5 hover:bg-white/10 text-center py-1.5 rounded-lg text-[11px] text-zinc-400 transition">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>

        </div>
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

    async function sendMessage() {
        const message = input.value.trim();
        if (!message) return;

        addBubble('user', message);
        input.value = '';
        sendBtn.disabled = true;

        try {
            const formData = new FormData();
            formData.append('answer_id', answerId);
            formData.append('message', message);
            formData.append(csrfName, csrfHash);
            history.forEach((h, i) => {
                formData.append(`history[${i}][role]`, h.role);
                formData.append(`history[${i}][content]`, h.content);
            });

            const res = await fetch('<?= site_url('student/reading/chat') ?>', {
                method: 'POST',
                body: formData,
            });

            const data = await res.json();
            const reply = data.reply || 'Sorry, something went wrong.';

            addBubble('assistant', reply);
            history.push({ role: 'user', content: message });
            history.push({ role: 'assistant', content: reply });

        } catch (e) {
            addBubble('assistant', 'Sorry, something went wrong.');
        } finally {
            sendBtn.disabled = false;
        }
    }

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') sendMessage();
    });
})();
</script>

<?= $this->endSection() ?>