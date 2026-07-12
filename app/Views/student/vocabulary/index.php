<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="space-y-5">
    <!-- Header Ringkas -->

    <a href="<?= site_url('dashboard') ?>"
           class="text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 inline-flex items-center gap-2">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Back to Module List

        </a>

    <div class="flex justify-between items-center pb-2 border-b border-zinc-200">
        <div>
            <h1 class="text-lg font-bold text-zinc-950">Vocabulary Practice</h1>
            <p class="text-xs text-zinc-500">Learn agricultural vocabulary and practice using each word in a sentence.</p>
        </div>
        <span class="text-[10px] bg-zinc-950 text-white px-2 py-0.5 rounded font-mono uppercase tracking-wider">M2</span>
    </div>

    <?php if(!empty($vocabularies)): 
        // Grouping data berdasarkan difficulty
        $groupedVocab = [];
        foreach($vocabularies as $row) {
            $diff = strtolower(trim($row['difficulty']));
            $groupedVocab[$diff][] = $row;
        }
        
        $categories = [
            'easy'   => ['label' => 'Easy Level', 'color' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60'],
            'medium' => ['label' => 'Medium Level', 'color' => 'bg-amber-50 text-amber-700 border-amber-200/60'],
            'hard'   => ['label' => 'Hard Level', 'color' => 'bg-rose-50 text-rose-700 border-rose-200/60']
        ];
    ?>
        <div class="space-y-5">
            <?php foreach($categories as $key => $cat): ?>
                <?php if(!empty($groupedVocab[$key])): ?>
                    <div class="overflow-hidden border border-zinc-200 rounded-xl bg-white shadow-sm">
                        
                        <!-- Header Kategori -->
                        <div class="px-4 py-2 bg-zinc-50 border-b border-zinc-200 flex items-center gap-2">
                            <span class="text-xs font-bold text-zinc-800 tracking-wide"><?= $cat['label'] ?></span>
                            <span class="text-[10px] px-1.5 py-0.1 bg-zinc-200/60 text-zinc-600 rounded-full font-medium font-mono">
                                <?= count($groupedVocab[$key]) ?>
                            </span>
                        </div>

                        <!-- Tabel Kompak (Responsive Scroll) -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-zinc-100 bg-zinc-50/50 text-[11px] font-semibold text-zinc-400 uppercase tracking-wider">
                                        <th class="py-2 px-4 w-1/4">Word</th>
                                        <th class="py-2 px-4 w-1/4">Meaning</th>
                                        <th class="py-2 px-4 w-2/5">Definition</th>
                                        <th class="py-2 px-4 text-right w-12">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-100 text-xs">
                                    <?php foreach($groupedVocab[$key] as $row): ?>
                                        <tr class="hover:bg-zinc-50/60 transition-colors group">
                                            <!-- Word & Pronunciation -->
                                            <td class="py-2.5 px-4 font-medium text-zinc-900 whitespace-nowrap">
                                                <div class="flex items-baseline gap-1.5">
                                                    <span><?= esc($row['word']) ?></span>
                                                    <?php if(!empty($row['pronunciation'])): ?>
                                                        <span class="text-[11px] text-zinc-400 font-mono font-normal"><?= esc($row['pronunciation']) ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <!-- Meaning -->
                                            <td class="py-2.5 px-4 text-zinc-600 max-w-xs truncate"><?= esc($row['meaning']) ?></td>
                                            <!-- Definition -->
                                            <td class="py-2.5 px-4 text-zinc-500 max-w-sm truncate" title="<?= esc($row['definition']) ?>">
                                                <?= esc($row['definition']) ?>
                                            </td>
                                            <!-- Action Button Mini -->
                                            <td class="py-2.5 px-4 text-right whitespace-nowrap">
                                                <a href="<?= site_url('student/vocabulary/start/'.$row['id']) ?>" 
                                                   class="inline-flex items-center justify-center bg-zinc-900 hover:bg-zinc-800 text-white px-2.5 py-1 rounded text-[11px] font-medium transition shadow-sm">
                                                    Start
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Empty State -->
        <div class="bg-white border border-zinc-200 rounded-xl p-6 text-center">
            <h2 class="text-xs font-semibold text-zinc-700">No Vocabulary Available</h2>
            <p class="text-[11px] text-zinc-500 mt-0.5">Vocabulary will appear here once added by your instructor.</p>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>