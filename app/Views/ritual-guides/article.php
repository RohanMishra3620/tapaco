<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php $samagri = json_decode($guide['samagri_json'] ?? '[]', true) ?: []; ?>

<!-- Back + actions bar -->
<div class="bg-cream/95 border-b border-goldleaf/20 px-4 py-2 flex items-center justify-between">
    <a href="<?= base_url('ritual-guides') ?>" class="flex items-center gap-1.5 text-sm text-ashgray hover:text-saffron transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back
    </a>
    <div class="flex items-center gap-2">
        <!-- Language toggle -->
        <div class="flex rounded-lg border border-goldleaf/30 overflow-hidden text-xs font-semibold">
            <a href="?lang=en" class="px-3 py-1.5 transition-colors <?= $lang==='en' ? 'bg-saffron text-white' : 'text-ashgray hover:bg-cream-dark' ?>">EN</a>
            <a href="?lang=hi" class="px-3 py-1.5 transition-colors <?= $lang==='hi' ? 'bg-saffron text-white' : 'text-ashgray hover:bg-cream-dark' ?>">हि</a>
        </div>
        <!-- Save button -->
        <button id="saveBtn" onclick="toggleSave(<?= $guide['id'] ?>)"
            class="p-1.5 rounded-lg border border-goldleaf/30 transition-all hover:bg-saffron/10 <?= $saved ? 'text-saffron' : 'text-ashgray' ?>">
            <svg class="w-4 h-4" fill="<?= $saved ? 'currentColor' : 'none' ?>" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
            </svg>
        </button>
    </div>
</div>

<article class="px-4 pt-5 pb-6">
    <!-- Title + tag -->
    <div class="mb-4">
        <?php if ($guide['tag']): ?>
        <span class="text-[10px] bg-saffron/10 text-saffron px-2.5 py-1 rounded-full font-semibold uppercase tracking-wider">
            <?= esc($guide['tag']) ?>
        </span>
        <?php endif; ?>
        <h1 class="font-serif text-2xl font-bold text-deepmar mt-2 leading-tight"><?= esc($guide['title']) ?></h1>
        <?php if ($guide['source']): ?>
        <p class="text-ashgray text-xs mt-1">Source: <?= esc($guide['source']) ?> · <?= $guide['confidence_score'] ?>% confidence</p>
        <?php endif; ?>
    </div>

    <!-- Audio player -->
    <?php if ($guide['audio_url']): ?>
    <div class="gold-border rounded-xl p-3 mb-4 flex items-center gap-3 reveal">
        <button class="w-10 h-10 rounded-full bg-saffron text-white flex items-center justify-center flex-shrink-0 hover:bg-saffron-dark transition-colors">
            <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 5v14l11-7z"/>
            </svg>
        </button>
        <div>
            <p class="font-semibold text-deepmar text-sm">Listen to this guide</p>
            <p class="text-ashgray text-[11px]">Audio narration available</p>
        </div>
    </div>
    <?php endif; ?>

    <!-- Sidebar widgets: Kit + Download -->
    <div class="flex gap-2 mb-5 reveal">
        <a href="<?= base_url('ritual-guides/kit/'.$guide['slug']) ?>"
           class="flex-1 bg-gradient-to-br from-saffron-dark to-saffron rounded-xl p-3 text-white text-center shadow-md hover:shadow-lg active:scale-95 transition-all">
            <svg class="mx-auto mb-1" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-cart"/></svg>
            <p class="text-[11px] font-bold leading-tight">Buy Ritual Kit</p>
            <p class="text-white/70 text-[10px]">for this puja</p>
        </a>
        <a href="#samagri"
           class="flex-1 bg-gradient-to-br from-turmeric-dark to-turmeric rounded-xl p-3 text-white text-center shadow-md hover:shadow-lg active:scale-95 transition-all">
            <svg class="mx-auto mb-1" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-doc"/></svg>
            <p class="text-[11px] font-bold leading-tight">Download</p>
            <p class="text-white/70 text-[10px]">Ritual card</p>
        </a>
    </div>

    <!-- Main content -->
    <div class="prose prose-sm max-w-none text-deepmar/90 leading-relaxed reveal article-body">
        <?= $lang === 'hi' ? ($guide['content_hi'] ?? $guide['content_en']) : $guide['content_en'] ?>
    </div>

    <!-- Samagri Checklist -->
    <?php if (!empty($samagri)): ?>
    <div id="samagri" class="mt-6 reveal">
        <div class="gold-border rounded-2xl overflow-hidden">
            <div class="px-4 py-3 bg-turmeric/10 border-b border-goldleaf/20">
                <h2 class="font-serif font-bold text-deepmar flex items-center gap-2">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" style="display:inline;vertical-align:-2px"><use href="#ic-doc"/></svg> Samagri (Checklist)
                </h2>
            </div>
            <div class="px-4 py-3 space-y-2">
                <?php foreach ($samagri as $item): ?>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" class="samagri-check w-4 h-4 rounded border-goldleaf/40 text-saffron focus:ring-saffron">
                    <span class="text-sm text-deepmar group-hover:text-saffron transition-colors"><?= esc($item) ?></span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- WhatsApp nudge -->
    <div class="mt-5 nudge-card rounded-2xl p-4 reveal">
        <p class="text-white/60 text-[10px] uppercase tracking-widest mb-1">Never miss a ritual</p>
        <p class="text-white font-semibold text-sm">Get reminders for <?= esc($guide['title']) ?> on WhatsApp</p>
        <a href="<?= base_url('subscribe?from=ritual-guide') ?>" class="mt-2 inline-block text-goldleaf text-xs font-bold hover:underline">
            Subscribe ₹99/year →
        </a>
    </div>

    <!-- Purohit CTA — inline at bottom of article -->
    <a href="<?= base_url('purohit-puja') ?>"
       style="display:flex;align-items:center;justify-content:space-between;background:linear-gradient(135deg,#7A1E12,#B85B08);color:#fff;padding:18px 22px;border-radius:16px;text-decoration:none;margin-top:24px;box-shadow:0 8px 24px rgba(122,30,18,.25);transition:transform .2s,box-shadow .2s"
       onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 14px 32px rgba(122,30,18,.35)'"
       onmouseout="this.style.transform='';this.style.boxShadow='0 8px 24px rgba(122,30,18,.25)'">
        <div>
            <p style="font-weight:700;font-size:.9rem;margin-bottom:2px">Need a Purohit?</p>
            <p style="font-size:.75rem;color:rgba(255,255,255,.7)">Book a verified pandit for this puja</p>
        </div>
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </a>
</article>

<style>
.article-body h3 { font-family:'Playfair Display',serif; font-size:1rem; font-weight:700; margin:1.25rem 0 .5rem; color:#2C1810; }
.article-body ol { padding-left:1.25rem; }
.article-body li { margin-bottom:.4rem; }
.article-body p  { margin-bottom:.75rem; }
.article-body em { color:#E8760A; font-style:normal; font-weight:600; }
</style>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
function toggleSave(id) {
    fetch('<?= base_url('ritual-guides/save/') ?>' + id, {
        method:'POST',
        headers:{'X-Requested-With':'XMLHttpRequest','Content-Type':'application/x-www-form-urlencoded'},
        body:'<?= csrf_token() ?>=<?= csrf_hash() ?>'
    })
    .then(r=>r.json())
    .then(d=>{
        if (d.redirect) { window.location.href = d.redirect; return; }
        const btn = document.getElementById('saveBtn');
        const svg = btn.querySelector('svg path');
        if (d.saved) {
            btn.classList.add('text-saffron'); svg.setAttribute('fill','currentColor');
        } else {
            btn.classList.remove('text-saffron'); svg.setAttribute('fill','none');
        }
    });
}
</script>
<?= $this->endSection() ?>
