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
    width: 100px;
    height: 100px;
    border-radius: 9999px;
    background: conic-gradient(#10b981 <?= $degree ?>deg, #e4e4e7 0deg);
    display: flex;
    align-items: center;
    justify-content: center;
}
.score-ring-inner {
    width: 82px;
    height: 82px;
    border-radius: 9999px;
    background: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>

<div class="space-y-5 max-w-7xl mx-auto px-2">

    <div class="flex justify-between items-center border-b border-zinc-100 pb-3">
        <a href="<?= site_url('student/reading') ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
        <div class="text-[10px] bg-zinc-900 text-white px-2.5 py-1 rounded font-mono tracking-widest uppercase">
            AI Evaluation
        </div>
    </div>

    <div class="grid lg:grid-cols-12 gap-6">

        <div class="lg:col-span-8 space-y-5">

            <div class="bg-white border border-zinc-200 rounded-xl p-5 shadow-sm">
                <div class="flex flex-col sm:flex-row gap-5 items-center">
                    <div class="score-ring shrink-0 shadow-inner">
                        <div class="score-ring-inner">
                            <span class="text-3xl font-black text-zinc-900"><?= $score ?></span>
                            <span class="text-[9px] uppercase font-bold tracking-wider text-emerald-600"><?= esc($level) ?></span>
                        </div>
                    </div>
                    <div class="space-y-1.5 flex-1 text-center sm:text-left">
                        <span class="inline-flex px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 text-[10px] font-bold uppercase tracking-wider">
                            Overall Result
                        </span>
                        <h2 class="text-xl font-bold tracking-tight text-zinc-900">
                            <?= esc($material['title'] ?? $answer['material_title']) ?>
                        </h2>
                        <p class="text-xs text-zinc-500 leading-relaxed">
                            <?= esc($summary) ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-zinc-200 rounded-xl shadow-sm overflow-hidden">
                <div class="p-5 border-b border-zinc-100 bg-zinc-50/50">
                    <h3 class="text-[11px] uppercase tracking-wider font-bold text-zinc-400 mb-1.5">Essay Question</h3>
                    <p class="text-sm text-zinc-800 font-medium leading-relaxed"><?= esc($answer['question']) ?></p>
                </div>
                
                <div class="grid sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-zinc-100">
                    <div class="p-5 space-y-2">
                        <h4 class="text-[11px] font-bold uppercase tracking-wider text-zinc-400">Your Answer</h4>
                        <p class="text-xs text-zinc-700 leading-relaxed whitespace-pre-line bg-zinc-50 p-3 rounded-lg border border-zinc-100 min-h-[80px]">
                            <?= esc(trim($answer['answer'])) ?>
                        </p>
                    </div>

                    <div class="p-5 space-y-2 bg-emerald-50/[0.01]">
                        <div class="flex justify-between items-center">
                            <h4 class="text-[11px] font-bold uppercase tracking-wider text-emerald-700">Suggested Answer</h4>
                            <span class="text-[9px] font-medium text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded uppercase">AI Rec</span>
                        </div>
                        <p class="text-xs text-zinc-700 leading-relaxed whitespace-pre-line bg-emerald-50/40 p-3 rounded-lg border border-emerald-100/70 min-h-[80px]">
                            <?= esc(trim($ai['recommended_answer'] ?? $answer['reference_answer'] ?? '-')) ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-zinc-200 rounded-xl shadow-sm p-5 space-y-4">
                <h3 class="text-[11px] font-bold uppercase tracking-wider text-zinc-400">AI Diagnostic Breakdown</h3>
                
                <div class="grid sm:grid-cols-2 gap-3">
                    <?php if(!empty($ai['strengths'])): ?>
                        <?php foreach($ai['strengths'] as $item): ?>
                            <div class="flex gap-2.5 p-3 rounded-lg border border-emerald-100 bg-emerald-50/20">
                                <span class="text-emerald-600 font-bold text-xs mt-0.5 shrink-0">✓</span>
                                <div class="text-xs text-zinc-700 leading-normal"><b class="text-emerald-800">Strength:</b> <?= esc($item) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if(!empty($ai['improvements'])): ?>
                        <?php foreach($ai['improvements'] as $item): ?>
                            <div class="flex gap-2.5 p-3 rounded-lg border border-amber-100 bg-amber-50/20">
                                <span class="text-amber-500 font-bold text-xs mt-0.5 shrink-0">!</span>
                                <div class="text-xs text-zinc-700 leading-normal"><b class="text-amber-800">Improvement:</b> <?= esc($item) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if(!empty($ai['grammar'])): ?>
                        <?php foreach($ai['grammar'] as $item): ?>
                            <div class="flex gap-2.5 p-3 rounded-lg border border-sky-100 bg-sky-50/20">
                                <span class="text-sky-600 font-bold text-xs mt-0.5 shrink-0">G</span>
                                <div class="text-xs text-zinc-700 leading-normal"><b class="text-sky-800">Grammar:</b> <?= esc($item) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if(!empty($ai['vocabulary'])): ?>
                        <?php foreach($ai['vocabulary'] as $item): ?>
                            <div class="flex gap-2.5 p-3 rounded-lg border border-purple-100 bg-purple-50/20">
                                <span class="text-purple-600 font-bold text-xs mt-0.5 shrink-0">V</span>
                                <div class="text-xs text-zinc-700 leading-normal"><b class="text-purple-800">Vocab:</b> <?= esc($item) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <?php if(empty($ai)): ?>
                    <div class="rounded-lg border border-zinc-100 bg-zinc-50 p-4 text-xs text-zinc-500">
                        <?= nl2br(esc($answer['ai_feedback'])) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="bg-white border border-zinc-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 py-3 border-b border-zinc-100 bg-zinc-50/30">
                    <h3 class="text-[11px] uppercase tracking-wider font-bold text-zinc-500">Ask AI About This Feedback</h3>
                </div>
                <div id="chat-log" class="p-4 space-y-2.5 max-h-60 overflow-y-auto text-xs bg-zinc-50/10"></div>
                <div class="border-t p-3 flex gap-2 bg-white">
                    <input id="chat-input" type="text"
                           class="flex-1 rounded-lg border border-zinc-200 px-3 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-zinc-900"
                           placeholder="Ask a question, e.g. 'why is my grammar wrong?'">
                    <button id="chat-send"
                            class="bg-zinc-900 hover:bg-zinc-800 text-white px-4 py-1.5 rounded-lg text-xs font-semibold transition">
                        Send
                    </button>
                </div>
            </div>

        </div>

        <div class="lg:col-span-4 space-y-5">

            <div class="bg-white border border-zinc-200 rounded-xl p-5 shadow-sm">
                <h3 class="text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-3">Session Stats</h3>
                <div class="space-y-2.5 text-xs">
                    <div class="flex justify-between py-1.5 border-b border-zinc-100">
                        <span class="text-zinc-500">Score</span>
                        <span class="font-bold text-zinc-900"><?= $score ?>/100</span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-zinc-100">
                        <span class="text-zinc-500">Words</span>
                        <span class="font-bold text-zinc-900"><?= $wordCount ?></span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-zinc-100">
                        <span class="text-zinc-500">Progress</span>
                        <span class="font-bold text-zinc-900"><?= $answeredQuestions ?> / <?= $totalQuestions ?></span>
                    </div>
                    <div class="flex justify-between py-1.5">
                        <span class="text-zinc-500">Level</span>
                        <span class="font-bold text-emerald-600"><?= esc($level) ?></span>
                    </div>
                </div>
            </div>

            <div class="bg-[#090d16] rounded-xl p-5 text-white relative overflow-hidden border border-white/5 shadow-md">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(16,185,129,.06),transparent_45%)]"></div>
                <div class="relative z-10 space-y-4">
                    <div>
                        <h3 class="text-md font-bold text-zinc-100">
                            <?= $isFinished ? 'Reading Completed' : 'Next Question' ?>
                        </h3>
                        <p class="text-xs text-zinc-400 mt-1 leading-relaxed">
                            <?= $isFinished
                                ? 'You have completed all questions in this material.'
                                : 'Continue to the next question and apply the feedback.' ?>
                        </p>
                    </div>

                    <div class="space-y-2 pt-1">
                        <?php if($isFinished): ?>
                            <a href="<?= site_url('student/reading/result/'.$answer['attempt_id']) ?>"
                               class="block w-full bg-emerald-500 hover:bg-emerald-400 text-center text-zinc-950 text-xs font-bold py-2.5 rounded-lg transition shadow-sm">
                                View Final Result
                            </a>
                        <?php else: ?>
                            <a href="<?= site_url('student/reading/test/'.$answer['attempt_id']) ?>"
                               class="block w-full bg-emerald-500 hover:bg-emerald-400 text-center text-zinc-950 text-xs font-bold py-2.5 rounded-lg transition shadow-sm">
                                Continue →
                            </a>
                        <?php endif; ?>

                        <a href="<?= site_url('student/reading') ?>"
                           class="block w-full bg-white/5 hover:bg-white/10 border border-white/10 text-center py-2 rounded-lg text-xs transition text-zinc-300">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
(function () {
    const answerId = <?= (int) $answer['id'] ?>;
    const csrfName = '<?= csrf_token() ?>';
    const csrfHash = '<?= csrf_hash() ?>';

    const log = document.getElementById('chat-log');
    const input = document.getElementById('chat-input');
    const sendBtn = document.getElementById('chat-send');

    let history = [];

    function addBubble(role, text) {
        const div = document.createElement('div');
        div.className = role === 'user' ? 'text-right' : 'text-left';
        div.innerHTML = `
            <span class="inline-block px-3 py-1.5 rounded-xl text-xs ${
                role === 'user' ? 'bg-zinc-900 text-white' : 'bg-zinc-100 text-zinc-700 border border-zinc-200'
            }">${text}</span>
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