<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="px-4 pt-4 pb-6">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-4">
        <a href="<?= base_url('panchang') ?>" class="text-ashgray hover:text-saffron">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="font-serif text-xl font-bold text-deepmar">Vrat Calendar 2026</h1>
    </div>

    <!-- Filter chips -->
    <div class="flex gap-2 mb-5 overflow-x-auto pb-1">
        <?php
        $filters = ['all'=>'All','ekadashi'=>'Ekadashi','pradosh'=>'Pradosh','festival'=>'Festivals','other'=>'Others'];
        foreach ($filters as $key => $label): ?>
        <a href="?type=<?= $key ?>"
           class="flex-shrink-0 text-xs font-semibold px-4 py-2 rounded-full transition-all
               <?= $filter === $key
                   ? 'bg-saffron text-white shadow-md'
                   : 'bg-white text-ashgray border border-goldleaf/30 hover:border-saffron/40' ?>">
            <?= $label ?>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- Vrat list -->
    <?php if (empty($vrats)): ?>
    <div class="text-center py-12">
        <svg class="mx-auto mb-2" width="36" height="36" fill="none" stroke="var(--saffron)" stroke-width="1.4" viewBox="0 0 24 24"><use href="#ic-moon"/></svg>
        <p class="text-ashgray text-sm">No upcoming vrats in this category</p>
    </div>
    <?php else: ?>
    <div class="space-y-2">
        <?php foreach ($vrats as $v): ?>
        <?php
        $days = (strtotime($v['date']) - strtotime(date('Y-m-d'))) / 86400;
        $chip = $days === 0 ? 'Today' : ($days === 1 ? 'Tomorrow' : "In {$days} days");
        $typeColors = ['ekadashi'=>'bg-green-50 text-green-700','pradosh'=>'bg-goldleaf/10 text-goldleaf','festival'=>'bg-saffron/10 text-saffron','other'=>'bg-cream-dark text-ashgray'];
        ?>
        <a href="<?= base_url('panchang/vrat/'.$v['slug']) ?>"
           class="flex items-center gap-3 bg-white rounded-xl px-4 py-3.5 shadow-sm border border-goldleaf/10 hover:border-saffron/30 hover:shadow-md transition-all active:scale-[0.98] reveal">
            <div class="w-12 h-12 rounded-xl bg-cream-dark flex flex-col items-center justify-center flex-shrink-0">
                <span class="text-[9px] text-ashgray uppercase font-bold"><?= date('M', strtotime($v['date'])) ?></span>
                <span class="text-lg font-bold text-deepmar font-serif leading-none"><?= date('d', strtotime($v['date'])) ?></span>
                <span class="text-[9px] text-ashgray"><?= date('D', strtotime($v['date'])) ?></span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-deepmar text-sm"><?= esc($v['vrat_name']) ?></p>
                <?php if ($v['description']): ?>
                <p class="text-ashgray text-xs truncate mt-0.5"><?= esc($v['description']) ?></p>
                <?php endif; ?>
            </div>
            <div class="flex flex-col items-end gap-1 flex-shrink-0">
                <span class="text-[9px] font-bold px-2 py-0.5 rounded-full <?= $days <= 1 ? 'bg-saffron/10 text-saffron' : 'bg-cream-dark text-ashgray' ?>">
                    <?= $chip ?>
                </span>
                <span class="text-[9px] font-medium px-2 py-0.5 rounded-full <?= $typeColors[$v['type']] ?? $typeColors['other'] ?>">
                    <?= ucfirst($v['type']) ?>
                </span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- PDF download -->
    <div class="mt-6 reveal">
        <a href="<?= base_url('panchang/download-calendar') ?>"
           class="flex items-center justify-between bg-gradient-to-r from-saffron to-saffron-dark text-white rounded-2xl px-5 py-4 shadow-lg hover:shadow-xl active:scale-95 transition-all">
            <div>
                <p class="font-bold text-sm inline-flex items-center gap-1.5"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><use href="#ic-download"/></svg> Download Full 2026 Calendar</p>
                <p class="text-white/70 text-xs mt-0.5">All vrats & muhurat in PDF</p>
            </div>
            <span class="text-2xl">↓</span>
        </a>
    </div>
</div>

<?= $this->endSection() ?>
