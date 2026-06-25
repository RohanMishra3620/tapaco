<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="bg-gradient-to-br from-green-800 to-green-600 px-5 pt-6 pb-8 relative overflow-hidden">
    <div class="absolute -right-5 -bottom-8 select-none" style="font-family:'Noto Serif Devanagari',serif;font-size:120px;line-height:1;color:rgba(255,255,255,.1)"></div>
    <a href="<?= base_url('panchang/vrat') ?>" class="flex items-center gap-1.5 text-sm text-white/70 hover:text-white mb-4">← Back</a>
    <p class="text-white/60 text-xs uppercase tracking-widest mb-1"><?= date('d F Y', strtotime($vrat['date'])) ?></p>
    <h1 class="font-serif text-2xl font-bold text-white"><?= esc($vrat['vrat_name']) ?></h1>
    <?php
    $days = (strtotime($vrat['date']) - strtotime(date('Y-m-d'))) / 86400;
    $chip = $days === 0 ? 'Today' : ($days === 1 ? 'Tomorrow' : "In {$days} days");
    ?>
    <span class="mt-2 inline-block text-xs font-bold bg-white/20 text-white px-3 py-1 rounded-full"><?= $chip ?></span>
</div>

<div class="px-4 pt-5 pb-6 space-y-4">
    <?php if ($vrat['description']): ?>
    <div class="bg-white rounded-2xl px-5 py-4 shadow-sm border border-goldleaf/10 reveal">
        <h2 class="font-serif font-bold text-deepmar mb-2">About this Vrat</h2>
        <p class="text-deepmar/80 text-sm leading-relaxed"><?= esc($vrat['description']) ?></p>
    </div>
    <?php endif; ?>

    <div class="nudge-card rounded-2xl p-4 reveal">
        <p class="text-white/60 text-[10px] uppercase tracking-widest mb-1">Don't miss this Vrat</p>
        <p class="text-white font-semibold text-sm">Get a WhatsApp reminder for <?= esc($vrat['vrat_name']) ?></p>
        <a href="<?= base_url('subscribe') ?>" class="mt-2 inline-block text-goldleaf text-xs font-bold hover:underline">
            Subscribe ₹99/year →
        </a>
    </div>

    <a href="<?= base_url('panchang/vrat') ?>"
       class="block text-center text-ashgray text-sm border border-goldleaf/20 rounded-xl py-3 hover:border-saffron/40 hover:text-saffron transition-colors">
        View All Vrats
    </a>
</div>

<?= $this->endSection() ?>
