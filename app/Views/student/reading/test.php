<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <a href="<?= site_url('student/reading') ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Back to Reading

        </a>

        <span class="text-[10px] bg-zinc-900 text-white px-3 py-1 rounded-md uppercase tracking-widest">
            Reading Test
        </span>

    </div>

    <div class="bg-white border border-zinc-200 rounded-xl p-6">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-xl font-bold text-zinc-900">
                    <?= esc($material['title']) ?>
                </h1>

                <p class="text-sm text-zinc-500 mt-1">
                    <?= ucfirst($material['level']) ?>
                </p>

            </div>

            <div class="text-right">

                <div class="text-xs uppercase text-zinc-400">
                    Progress
                </div>

                <div class="text-lg font-bold">
                    Question <?= $current ?> / <?= $total ?>
                </div>

            </div>

        </div>

        <div class="mt-5">

            <div class="w-full bg-zinc-100 rounded-full h-2">

                <div
                    class="bg-emerald-500 h-2 rounded-full"
                    style="width: <?= ($current/$total)*100 ?>%">
                </div>

            </div>

        </div>

    </div>

    <div class="grid lg:grid-cols-12 gap-6">

        <div class="lg:col-span-7">

            <div class="bg-white border border-zinc-200 rounded-xl p-8 max-h-[75vh] overflow-y-auto">

                <h2 class="text-sm font-bold uppercase tracking-widest text-zinc-400 mb-6">
                    Reading Passage
                </h2>

                <div class="text-zinc-700 leading-8 whitespace-pre-line">

                    <?= esc($material['content']) ?>

                </div>

            </div>

        </div>

        <div class="lg:col-span-5">

            <form method="post"
                  action="<?= site_url('student/reading/save-answer') ?>">

                <?= csrf_field() ?>

                <input type="hidden" name="attempt_id" value="<?= $attempt['id'] ?>">
                <input type="hidden" name="question_id" value="<?= $question['id'] ?>">

                <div class="bg-white border border-zinc-200 rounded-xl">

                    <div class="p-6 border-b">

                        <h3 class="font-bold text-zinc-900">
                            Essay Question
                        </h3>

                    </div>

                    <div class="p-6 space-y-5">

                        <div class="bg-zinc-50 rounded-xl border p-5">

                            <?= esc($question['question']) ?>

                        </div>

                        <div>

                            <label class="block text-xs font-bold uppercase text-zinc-400 mb-2">
                                Your Answer
                            </label>

                            <textarea
                                name="answer"
                                rows="9"
                                required
                                class="w-full rounded-xl border border-zinc-200 p-4 focus:ring-1 focus:ring-zinc-900 focus:outline-none"
                                placeholder="Write your answer in English..."></textarea>

                        </div>

                        <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4">

                            <div class="text-xs font-bold text-emerald-700 uppercase mb-2">
                                AI Tips
                            </div>

                            <ul class="text-xs text-zinc-600 list-disc pl-5 space-y-1">
                                <li>Use your own words.</li>
                                <li>Answer in complete sentences.</li>
                                <li>Avoid copying the passage.</li>
                                <li>Focus on the main idea.</li>
                            </ul>

                        </div>

                    </div>

                    <div class="border-t p-6 flex justify-end">

                        <button
                            class="bg-zinc-900 hover:bg-zinc-800 text-white px-6 py-3 rounded-xl text-sm font-semibold">

                            Submit Answer

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>