<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="px-4 pt-4 pb-6">
    <!-- Search bar -->
    <form method="GET" action="<?= base_url('search') ?>" class="flex gap-2 mb-5">
        <div class="flex-1 relative">
            <input type="text" name="q" value="<?= esc($q) ?>" placeholder="Search rituals, pujas, vrats…"
                class="w-full pl-10 pr-4 py-3 rounded-xl border border-goldleaf/30 bg-white text-sm focus:outline-none focus:border-saffron transition-colors shadow-sm"
                autofocus>
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-ashgray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
        </div>
        <button type="submit" class="bg-saffron text-white px-4 py-3 rounded-xl text-sm font-semibold active:scale-95 transition-all">Go</button>
    </form>

    <?php if ($q === ''): ?>
    <!-- Popular searches -->
    <div>
        <p class="text-xs font-semibold text-ashgray uppercase tracking-widest mb-3">Popular Searches</p>
        <div class="flex flex-wrap gap-2">
            <?php foreach ($popular as $p): ?>
            <a href="<?= base_url('search?q='.urlencode($p)) ?>"
               class="bg-cream-dark text-deepmar text-xs font-medium px-3 py-2 rounded-full hover:bg-saffron/10 hover:text-saffron transition-colors">
                <?= esc($p) ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php elseif ($empty): ?>
    <!-- Empty state -->
    <div class="text-center py-12 reveal">
        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-float" style="background:#B85B0814;color:var(--saffron)"><svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><use href="#ic-search"/></svg></div>
        <h2 class="font-serif text-lg font-bold text-deepmar">No results for "<?= esc($q) ?>"</h2>
        <p class="text-ashgray text-sm mt-2 mb-5">Try a different spelling or browse below</p>
        <?php if ($suggest): ?>
        <a href="<?= base_url('search?q='.urlencode($suggest)) ?>"
           class="inline-block bg-saffron/10 text-saffron text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-saffron hover:text-white transition-all mb-6">
            Did you mean: <span class="underline"><?= esc($suggest) ?></span>?
        </a>
        <?php endif; ?>
        <div>
            <p class="text-xs text-ashgray mb-3">Popular Searches</p>
            <div class="flex flex-wrap gap-2 justify-center">
                <?php foreach ($popular as $p): ?>
                <a href="<?= base_url('search?q='.urlencode($p)) ?>"
                   class="bg-cream-dark text-deepmar text-xs px-3 py-1.5 rounded-full hover:bg-saffron/10">
                    <?= esc($p) ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php else: ?>
    <!-- Results -->
    <?php foreach ($results as $type => $items): ?>
    <?php if (!empty($items)): ?>
    <div class="mb-6 reveal">
        <h2 class="text-xs font-semibold text-ashgray uppercase tracking-widest mb-3"><?= esc($type) ?></h2>
        <div class="space-y-2">
            <?php foreach ($items as $item): ?>
            <a href="<?= base_url((isset($item['subcategory']) ? 'ritual-guides/' : 'purohit-puja/').$item['slug']) ?>"
               class="flex items-center gap-3 bg-white rounded-xl px-4 py-3 shadow-sm border border-goldleaf/10 hover:border-saffron/30 transition-all active:scale-[0.98]">
                <div class="w-10 h-10 rounded-lg bg-saffron/10 flex items-center justify-center text-lg flex-shrink-0">
                    <svg width="18" height="18" fill="none" stroke="var(--saffron)" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-book"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-deepmar text-sm truncate"><?= esc($item['title'] ?? $item['name']) ?></p>
                    <p class="text-ashgray text-xs"><?= esc($item['tag'] ?? $item['subcategory'] ?? '') ?></p>
                </div>
                <svg class="w-4 h-4 text-ashgray/40 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
