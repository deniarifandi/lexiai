<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<?php

$totalScore = 0;

foreach ($answers as $row) {
    $totalScore += (float) ($row['ai_score'] ?? 0);
}

$finalScore = count($answers)
    ? round($totalScore / count($answers), 1)
    : 0;

if ($finalScore >= 90) {
    $grade = 'Excellent';
} elseif ($finalScore >= 80) {
    $grade = 'Very Good';
} elseif ($finalScore >= 70) {
    $grade = 'Good';
} elseif ($finalScore >= 60) {
    $grade = 'Fair';
} else {
    $grade = 'Needs Improvement';
}

?>

<div class="max-w-5xl mx-auto space-y-6">

    <!-- Summary -->
    <div class="bg-white border border-zinc-200 rounded-xl p-8">

        <div class="flex flex-col md:flex-row justify-between items-center gap-8">

            <div>

                <p class="text-xs uppercase tracking-widest text-zinc-400">
                    Reading Completed
                </p>

                <h1 class="text-3xl font-extrabold text-zinc-900 mt-2">
                    Submission Successful
                </h1>

                <p class="text-sm text-zinc-500 mt-3">
                    Your answers have been evaluated successfully.
                </p>

            </div>

            <div class="text-center">

                <div class="text-6xl font-black text-emerald-600">
                    <?= $finalScore ?>
                </div>

                <div class="mt-2 text-sm font-semibold text-zinc-700">
                    <?= $grade ?>
                </div>

                <div class="text-xs uppercase tracking-widest text-zinc-400 mt-1">
                    Final Score
                </div>

            </div>

        </div>

    </div>

    <!-- Question Results -->

    <?php foreach ($answers as $index => $row): ?>

        <?php

        $score = (float) ($row['ai_score'] ?? 0);

        if ($score >= 90) {
            $badge = 'bg-emerald-100 text-emerald-700';
        } elseif ($score >= 80) {
            $badge = 'bg-blue-100 text-blue-700';
        } elseif ($score >= 70) {
            $badge = 'bg-amber-100 text-amber-700';
        } else {
            $badge = 'bg-red-100 text-red-700';
        }

        ?>

        <div class="bg-white border border-zinc-200 rounded-xl">

            <div class="border-b border-zinc-100 p-5 flex justify-between items-start">

                <div>

                    <h2 class="font-bold text-zinc-900">
                        Question <?= $index + 1 ?>
                    </h2>

                    <p class="mt-2 text-zinc-700">
                        <?= esc($row['question']) ?>
                    </p>

                </div>

                <div class="text-right">

                    <div class="text-xs uppercase tracking-widest text-zinc-400">
                        Score
                    </div>

                    <div class="mt-2 px-4 py-2 rounded-lg font-bold <?= $badge ?>">
                        <?= round($score,1) ?>/100
                    </div>

                </div>

            </div>

            <div class="p-5">

                <div class="mb-4">

                    <div class="text-xs uppercase tracking-widest text-zinc-400 mb-2">
                        Your Answer
                    </div>

                    <div class="bg-zinc-50 border border-zinc-200 rounded-lg p-4 whitespace-pre-line text-zinc-700">
                        <?= nl2br(esc($row['answer'])) ?>
                    </div>

                </div>

                <?php if (!empty($row['feedback'])): ?>

                    <div>

                        <div class="text-xs uppercase tracking-widest text-zinc-400 mb-2">
                            AI Feedback
                        </div>

                        <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4 text-zinc-700 whitespace-pre-line">
                            <?= nl2br(esc($row['feedback'])) ?>
                        </div>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    <?php endforeach; ?>

    <div class="flex justify-end">

        <a href="<?= site_url('student/reading') ?>"
           class="bg-zinc-900 hover:bg-zinc-800 text-white px-6 py-3 rounded-xl font-semibold">

            Back to Reading List

        </a>

    </div>

</div>

<?= $this->endSection() ?>