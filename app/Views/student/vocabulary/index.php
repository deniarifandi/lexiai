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
        // Group by first letter of the word
        $groupedVocab = [];
        foreach($vocabularies as $row) {
            $letter = strtoupper(substr(trim($row['word']), 0, 1));
            if (!ctype_alpha($letter)) $letter = '#'; // fallback bucket for non-letter starts
            $groupedVocab[$letter][] = $row;
        }
        ksort($groupedVocab);

        $alphabet = range('A', 'Z');

        $diffStyle = [
            'easy'   => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
            'medium' => 'bg-amber-50 text-amber-700 border-amber-200/60',
            'hard'   => 'bg-rose-50 text-rose-700 border-rose-200/60',
        ];
    ?>

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
            <?php foreach($alphabet as $letter): ?>
                <?php $hasWords = !empty($groupedVocab[$letter]); ?>
                <?php if($hasWords): ?>
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

        <div class="space-y-5">
            <?php foreach($groupedVocab as $letter => $rows): ?>
                <div id="letter-<?= $letter ?>" class="scroll-mt-16 overflow-hidden border border-zinc-200 rounded-xl bg-white shadow-sm vocab-section">

                    <!-- Header Huruf -->
                    <div class="px-4 py-2 bg-zinc-50 border-b border-zinc-200 flex items-center gap-2">
                        <span class="text-xs font-bold text-zinc-800 tracking-wide"><?= $letter ?></span>
                        <span class="text-[10px] px-1.5 py-0.1 bg-zinc-200/60 text-zinc-600 rounded-full font-medium font-mono">
                            <?= count($rows) ?>
                        </span>
                    </div>

                    <!-- Tabel Kompak (Responsive Scroll) -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-zinc-100 bg-zinc-50/50 text-[11px] font-semibold text-zinc-400 uppercase tracking-wider">
                                    <th class="py-2 px-4 w-1/5">Word</th>
                                    <th class="py-2 px-4 w-1/5">Meaning</th>
                                    <th class="py-2 px-4 w-2/5">Definition</th>
                                    <th class="py-2 px-4 w-16">Level</th>
                                    <th class="py-2 px-4 text-right w-12">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 text-xs">
                                <?php foreach($rows as $row):
                                    $diff = strtolower(trim($row['difficulty']));
                                    $badge = $diffStyle[$diff] ?? 'bg-zinc-50 text-zinc-600 border-zinc-200/60';
                                ?>
                                    <tr class="hover:bg-zinc-50/60 transition-colors group vocab-row"
                                        data-word="<?= esc(strtolower($row['word'])) ?>"
                                        data-meaning="<?= esc(strtolower($row['meaning'])) ?>">
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
                                        <!-- Level Badge -->
                                        <td class="py-2.5 px-4 whitespace-nowrap">
                                            <span class="text-[10px] px-1.5 py-0.5 border rounded font-medium capitalize <?= $badge ?>">
                                                <?= esc($diff ?: '-') ?>
                                            </span>
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
            <?php endforeach; ?>
        </div>

        <script>
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
                    const searchMatches = !q || row.dataset.word.includes(q) || row.dataset.meaning.includes(q);
                    row.style.display = searchMatches ? '' : 'none';
                    if (searchMatches) visibleCount++;
                });
                section.style.display = visibleCount > 0 ? '' : 'none';
            });
        }

        document.getElementById('vocabSearch').addEventListener('input', applyFilters);
        </script>

    <?php else: ?>
        <!-- Empty State -->
        <div class="bg-white border border-zinc-200 rounded-xl p-6 text-center">
            <h2 class="text-xs font-semibold text-zinc-700">No Vocabulary Available</h2>
            <p class="text-[11px] text-zinc-500 mt-0.5">Vocabulary will appear here once added by your instructor.</p>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>