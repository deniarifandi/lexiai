<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<?php

$ai = [];

if (!empty($answer['ai_result'])) {
    $ai = json_decode($answer['ai_result'], true);
}

$score = $ai['score'] ?? ($answer['ai_score'] ?? 0);

$level = $ai['level'] ?? 'Good';

$summary = $ai['summary'] ?? ($answer['ai_feedback'] ?? 'No feedback available.');

$percent = max(0, min(100, $score));
$degree = ($percent / 100) * 360;

$wordCount = str_word_count(strip_tags($answer['answer']));

?>

<style>
.score-ring{
    width:140px;
    height:140px;
    border-radius:9999px;
    background:conic-gradient(#10b981 <?= $degree ?>deg,#e4e4e7 0deg);
    display:flex;
    align-items:center;
    justify-content:center;
}
.score-ring-inner{
    width:116px;
    height:116px;
    border-radius:9999px;
    background:white;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}
</style>

<div class="space-y-6">

    <!-- HEADER -->

    <div class="max-w-7xl mx-auto flex justify-between items-center px-2">

        <a href="<?= site_url('student/reading') ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2.5"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>

            </svg>

            Back to Reading

        </a>

        <div class="text-[10px] bg-zinc-950 text-white px-3 py-1 rounded-md font-mono tracking-widest uppercase">
            AI Evaluation
        </div>

    </div>

    <div class="grid lg:grid-cols-12 gap-8">

        <!-- LEFT -->

        <div class="lg:col-span-8 space-y-6">

            <!-- SCORE -->

            <div class="bg-white border border-zinc-200 rounded-xl p-8 shadow-sm">

                <div class="flex flex-col sm:flex-row gap-8 items-center">

                    <div class="score-ring shrink-0">

                        <div class="score-ring-inner">

                            <span class="text-4xl font-black text-zinc-900">

                                <?= $score ?>

                            </span>

                            <span class="text-[10px] uppercase font-bold tracking-widest text-emerald-600">

                                <?= esc($level) ?>

                            </span>

                        </div>

                    </div>

                    <div class="space-y-3 flex-1">

                        <div>

                            <span class="inline-flex px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-bold uppercase tracking-widest">

                                AI Evaluation Result

                            </span>

                        </div>

                        <h2 class="text-3xl font-black tracking-tight text-zinc-900">

                            <?= esc($material['title'] ?? $answer['material_title']) ?>

                        </h2>

                        <p class="text-sm leading-7 text-zinc-500">

                            <?= esc($summary) ?>

                        </p>

                    </div>

                </div>

            </div>

            <!-- QUESTION -->

            <div class="bg-white border border-zinc-200 rounded-xl shadow-sm">

                <div class="px-6 py-4 border-b border-zinc-100">

                    <h3 class="text-xs uppercase tracking-widest font-bold text-zinc-500">

                        Essay Question

                    </h3>

                </div>

                <div class="p-6 leading-8 text-zinc-700">

                    <?= esc($answer['question']) ?>

                </div>

            </div>
                        <!-- ANSWERS -->

            <div class="grid sm:grid-cols-2 gap-4">

                <!-- Your Answer -->

                <div class="bg-white border border-zinc-200/60 rounded-xl p-5 space-y-3 shadow-sm">

                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-400">
                        Your Answer
                    </h4>

                    <div class="bg-zinc-50 border border-zinc-100 rounded-xl p-4">

                        <p class="text-sm text-zinc-700 leading-7 whitespace-pre-line">
                            <?= nl2br(esc($answer['answer'])) ?>
                        </p>

                    </div>

                </div>

                <!-- Suggested Answer -->

                <div class="bg-white border-2 border-emerald-500/20 rounded-xl p-5 space-y-3 relative shadow-sm">

                    <span class="absolute top-3 right-4 text-[9px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded uppercase tracking-wider">
                        AI Recommendation
                    </span>

                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-900">
                        Suggested Answer
                    </h4>

                    <div class="bg-emerald-500/[0.03] border border-emerald-500/10 rounded-xl p-4">

                        <p class="text-sm text-zinc-700 leading-7 whitespace-pre-line">

                            <?= nl2br(esc(
                                $ai['suggested_answer']
                                ?? $answer['reference_answer']
                                ?? '-'
                            )) ?>

                        </p>

                    </div>

                </div>

            </div>

            <!-- AI DIAGNOSTICS -->

            <div class="bg-white border border-zinc-200 rounded-xl shadow-sm p-6 sm:p-8 space-y-5">

                <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400">

                    AI Diagnostic Report

                </h3>

                <div class="space-y-3">

                    <?php if(!empty($ai['strengths'])): ?>

                        <?php foreach($ai['strengths'] as $item): ?>

                            <div class="flex gap-3 p-4 rounded-xl border border-zinc-100 bg-zinc-50">

                                <div class="text-emerald-600 font-bold text-lg shrink-0">
                                    ✓
                                </div>

                                <div class="text-sm text-zinc-700 leading-7">

                                    <?= esc($item) ?>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>


                    <?php if(!empty($ai['improvements'])): ?>

                        <?php foreach($ai['improvements'] as $item): ?>

                            <div class="flex gap-3 p-4 rounded-xl border border-zinc-100 bg-zinc-50">

                                <div class="text-amber-500 font-bold text-lg shrink-0">
                                    !
                                </div>

                                <div class="text-sm text-zinc-700 leading-7">

                                    <?= esc($item) ?>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>


                    <?php if(!empty($ai['grammar'])): ?>

                        <?php foreach($ai['grammar'] as $item): ?>

                            <div class="flex gap-3 p-4 rounded-xl border border-zinc-100 bg-zinc-50">

                                <div class="text-sky-600 font-bold text-lg shrink-0">
                                    G
                                </div>

                                <div class="text-sm text-zinc-700 leading-7">

                                    <?= esc($item) ?>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>


                    <?php if(!empty($ai['vocabulary'])): ?>

                        <?php foreach($ai['vocabulary'] as $item): ?>

                            <div class="flex gap-3 p-4 rounded-xl border border-zinc-100 bg-zinc-50">

                                <div class="text-purple-600 font-bold text-lg shrink-0">
                                    V
                                </div>

                                <div class="text-sm text-zinc-700 leading-7">

                                    <?= esc($item) ?>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>


                    <?php if(empty($ai)): ?>

                        <div class="rounded-xl border border-zinc-100 bg-zinc-50 p-5 text-sm text-zinc-500">

                            <?= nl2br(esc($answer['ai_feedback'])) ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>


            <!-- ASK AI ABOUT THIS FEEDBACK -->
<div class="bg-white border border-zinc-200 rounded-xl shadow-sm">

    <div class="px-6 py-4 border-b border-zinc-100">
        <h3 class="text-xs uppercase tracking-widest font-bold text-zinc-500">
            Ask AI About This Feedback
        </h3>
    </div>

    <div id="chat-log" class="p-6 space-y-3 max-h-80 overflow-y-auto text-sm"></div>

    <div class="border-t p-4 flex gap-2">
        <input id="chat-input" type="text"
               class="flex-1 rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-zinc-900"
               placeholder="Ask a question, e.g. 'why is my grammar wrong?'">
        <button id="chat-send"
                class="bg-zinc-900 hover:bg-zinc-800 text-white px-4 py-2 rounded-lg text-sm font-semibold">
            Send
        </button>
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

    let history = []; // in-memory only, resets on reload

    function addBubble(role, text) {
        const div = document.createElement('div');
        div.className = role === 'user'
            ? 'text-right'
            : 'text-left';

        div.innerHTML = `
            <span class="inline-block px-3 py-2 rounded-xl text-sm ${
                role === 'user'
                    ? 'bg-zinc-900 text-white'
                    : 'bg-zinc-50 text-zinc-700 border border-zinc-100'
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
            const reply = data.reply || 'Sorry, something went wrong 1.';

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

                    </div>

        <!-- RIGHT SIDEBAR -->

        <div class="lg:col-span-4 space-y-6">

            <!-- SESSION STATS -->

            <div class="bg-white border border-zinc-200 rounded-xl p-6 shadow-sm">

                <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-400 mb-5">

                    Session Statistics

                </h3>

                <div class="space-y-3 text-sm">

                    <div class="flex justify-between py-2 border-b border-zinc-100">
                        <span class="text-zinc-500">Score</span>
                        <span class="font-bold text-zinc-900">
                            <?= $score ?>/100
                        </span>
                    </div>

                    <div class="flex justify-between py-2 border-b border-zinc-100">
                        <span class="text-zinc-500">Words</span>
                        <span class="font-bold text-zinc-900">
                            <?= $wordCount ?>
                        </span>
                    </div>

                    <div class="flex justify-between py-2 border-b border-zinc-100">
                        <span class="text-zinc-500">Question</span>
                        <span class="font-bold text-zinc-900">
                            <?= $answeredQuestions ?> / <?= $totalQuestions ?>
                        </span>
                    </div>

                    <div class="flex justify-between py-2 border-b border-zinc-100">
                        <span class="text-zinc-500">Level</span>
                        <span class="font-bold text-emerald-600">
                            <?= esc($level) ?>
                        </span>
                    </div>

                    <div class="flex justify-between py-2">
                        <span class="text-zinc-500">Material</span>
                        <span class="font-semibold text-right">
                            <?= esc($answer['material_title']) ?>
                        </span>
                    </div>

                </div>

            </div>

            <!-- NEXT ACTION -->

            <div class="bg-[#090d16] rounded-xl p-6 text-white relative overflow-hidden border border-white/5">

                <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(16,185,129,.08),transparent_45%)]"></div>

                <div class="relative z-10 space-y-5">

                    <div>

                        <h3 class="text-lg font-bold">

                            <?= $isFinished ? 'Reading Completed' : 'Next Question' ?>

                        </h3>

                        <p class="text-sm text-zinc-400 mt-2 leading-6">

                            <?= $isFinished
                                ? 'You have completed all questions in this reading material. View your final result.'
                                : 'Continue to the next question and apply the AI feedback to improve your answer.' ?>

                        </p>

                    </div>

                    <?php if($isFinished): ?>

                        <a href="<?= site_url('student/reading/result/'.$answer['attempt_id']) ?>"
                           class="block w-full bg-emerald-500 hover:bg-emerald-400 text-center text-zinc-950 font-bold py-3 rounded-xl transition">

                            View Final Result

                        </a>

                    <?php else: ?>

                        <a href="<?= site_url('student/reading/test/'.$answer['attempt_id']) ?>"
   class="block w-full bg-emerald-500 hover:bg-emerald-400 text-center text-zinc-950 font-bold py-3 rounded-xl transition">
    Continue →
</a>

                    <?php endif; ?>

                    <a href="<?= site_url('student/reading') ?>"
                       class="block w-full bg-white/5 hover:bg-white/10 border border-white/10 text-center py-3 rounded-xl text-sm transition">

                        Back to Reading List

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>