<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<?php
helper('scoring'); // getScoreLevel(), getScoreLevelColor() from earlier

function getScoreLevel(int $score): string
{
    return match (true) {
        $score >= 90 => 'Excellent',
        $score >= 75 => 'Good',
        $score >= 60 => 'Fair',
        $score >= 40 => 'Needs Improvement',
        default       => 'Poor',
    };
}

function getScoreLevelColor(string $level): string
{
    return match ($level) {
        'Excellent'          => 'text-emerald-600',
        'Good'               => 'text-teal-600',
        'Fair'               => 'text-amber-600',
        'Needs Improvement'  => 'text-orange-600',
        default              => 'text-red-600', // Poor
    };
}

$totalScore = 0;
$highest = null;
$lowest = null;

foreach ($answers as $row) {
    $s = (float) ($row['ai_score'] ?? 0);
    $totalScore += $s;
    if ($highest === null || $s > $highest) $highest = $s;
    if ($lowest === null || $s < $lowest) $lowest = $s;
}

$totalQuestions = count($answers);
$finalScore = $totalQuestions ? round($totalScore / $totalQuestions, 1) : 0;
$grade = getScoreLevel((int) round($finalScore));
$gradeColor = getScoreLevelColor($grade);

$percent = max(0, min(100, $finalScore));
$degree = ($percent / 100) * 360;



?>

<style>
.result-ring {
    width: 110px;
    height: 110px;
    border-radius: 9999px;
    background: conic-gradient(#10b981 <?= $degree ?>deg, #e4e4e7 0deg);
    display: flex;
    align-items: center;
    justify-content: center;
}
.result-ring-inner {
    width: 92px;
    height: 92px;
    border-radius: 9999px;
    background: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
</style>

<div class=" mx-auto h-[calc(100vh-2rem)] flex flex-col gap-4 px-3 sm:px-4 py-3">

    <div class="flex justify-between items-center shrink-0">
        <div>
            <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Reading Result</p>
            <h1 class="text-lg font-bold text-zinc-900"><?= esc($material['title'] ?? 'Reading Test') ?></h1>
        </div>
        <a href="<?= site_url('student/reading') ?>"
           class="bg-zinc-900 hover:bg-zinc-800 text-white px-4 py-2 rounded-lg text-xs font-semibold transition">
            Back to List
        </a>
    </div>

    <!-- Summary dashboard -->
    <div class="bg-white border border-zinc-200 rounded-xl p-5 shrink-0">
        <div class="flex flex-col sm:flex-row items-center gap-6">

            <div class="result-ring shrink-0 shadow-inner">
                <div class="result-ring-inner">
                    <span class="text-2xl font-black text-zinc-900"><?= $finalScore ?></span>
                    <span class="text-[9px] font-bold uppercase tracking-tight <?= $gradeColor ?>"><?= esc($grade) ?></span>
                </div>
            </div>

            <div class="flex-1 grid grid-cols-3 gap-3 w-full">
                <div class="bg-zinc-50 rounded-lg p-3 text-center">
                    <div class="text-[10px] uppercase text-zinc-400 font-bold">Questions</div>
                    <div class="text-xl font-bold text-zinc-900 mt-1"><?= $totalQuestions ?></div>
                </div>
                <div class="bg-zinc-50 rounded-lg p-3 text-center">
                    <div class="text-[10px] uppercase text-zinc-400 font-bold">Highest</div>
                    <div class="text-xl font-bold text-emerald-600 mt-1"><?= round($highest ?? 0, 1) ?></div>
                </div>
                <div class="bg-zinc-50 rounded-lg p-3 text-center">
                    <div class="text-[10px] uppercase text-zinc-400 font-bold">Lowest</div>
                    <div class="text-xl font-bold text-amber-600 mt-1"><?= round($lowest ?? 0, 1) ?></div>
                </div>
            </div>

        </div>
    </div>

    <!-- Question chips -->
    <div class="bg-white border border-zinc-200 rounded-xl p-5 flex-1 overflow-y-auto min-h-0">
        <div class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-3">
            Question Breakdown
        </div>

        <div class="grid sm:grid-cols-2 gap-2.5">
            <?php foreach ($answers as $index => $row): ?>
                <?php
                $score = (float) ($row['ai_score'] ?? 0);
                $qLevel = getScoreLevel((int) round($score));
                $qColor = getScoreLevelColor($qLevel);
                ?>
                <button type="button"
                        class="result-item text-left border border-zinc-200 rounded-lg p-3 hover:border-zinc-300 hover:bg-zinc-50 transition flex justify-between items-center gap-3"
                        data-index="<?= $index ?>"
                        data-question="<?= esc($row['question'], 'attr') ?>"
                        data-answer="<?= esc($row['answer'], 'attr') ?>"
                        data-feedback="<?= esc($row['feedback'] ?? '-', 'attr') ?>"
                        data-score="<?= round($score, 1) ?>"
                        data-level="<?= esc($qLevel, 'attr') ?>">
                    <div class="min-w-0">
                        <div class="text-xs font-bold text-zinc-900">Question <?= $index + 1 ?></div>
                        <div class="text-[11px] text-zinc-500 truncate max-w-[220px]"><?= esc($row['question']) ?></div>
                    </div>
                    <div class="shrink-0 text-right">
                        <div class="font-bold text-sm text-zinc-900"><?= round($score, 1) ?></div>
                        <div class="text-[9px] font-bold uppercase <?= $qColor ?>"><?= esc($qLevel) ?></div>
                    </div>
                </button>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<!-- Detail modal -->
<div id="detail-modal" class="hidden fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-lg w-full max-h-[85vh] overflow-y-auto shadow-lg">
        <div class="p-5 border-b border-zinc-100 flex justify-between items-start sticky top-0 bg-white">
            <div>
                <div id="modal-title" class="font-bold text-zinc-900 text-sm"></div>
                <div id="modal-question" class="text-xs text-zinc-500 mt-1"></div>
            </div>
            <button id="modal-close" class="text-zinc-400 hover:text-zinc-900 text-sm font-bold px-2">✕</button>
        </div>
        <div class="p-5 space-y-4">
            <div>
                <div class="text-[10px] font-bold uppercase text-zinc-400 mb-1">Score</div>
                <div class="flex items-center gap-2">
                    <span id="modal-score" class="text-lg font-black text-zinc-900"></span>
                    <span id="modal-level" class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-zinc-100"></span>
                </div>
            </div>
            <div>
                <div class="text-[10px] font-bold uppercase text-zinc-400 mb-1">Your Answer</div>
                <div id="modal-answer" class="bg-zinc-50 border border-zinc-200 rounded-lg p-3 text-xs text-zinc-700 whitespace-pre-line"></div>
            </div>
            <div>
                <div class="text-[10px] font-bold uppercase text-zinc-400 mb-1">AI Feedback</div>
                <div id="modal-feedback" class="bg-emerald-50 border border-emerald-200 rounded-lg p-3 text-xs text-zinc-700 whitespace-pre-line"></div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    const modal = document.getElementById('detail-modal');
    const closeBtn = document.getElementById('modal-close');

    document.querySelectorAll('.result-item').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('modal-title').textContent = 'Question ' + (parseInt(btn.dataset.index) + 1);
            document.getElementById('modal-question').textContent = btn.dataset.question;
            document.getElementById('modal-score').textContent = btn.dataset.score + '/100';
            document.getElementById('modal-level').textContent = btn.dataset.level;
            document.getElementById('modal-answer').textContent = btn.dataset.answer;
            document.getElementById('modal-feedback').textContent = btn.dataset.feedback;
            modal.classList.remove('hidden');
        });
    });

    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.add('hidden');
    });
})();
</script>

<?= $this->endSection() ?>