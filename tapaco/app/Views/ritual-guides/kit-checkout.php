<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php $contents = json_decode($kit['contents_json'] ?? '[]', true) ?: []; ?>

<!-- Header -->
<div class="bg-gradient-to-br from-turmeric-dark to-turmeric px-5 pt-6 pb-5 relative overflow-hidden">
    <div class="absolute -right-5 -bottom-8 select-none" style="font-family:'Noto Serif Devanagari',serif;font-size:120px;line-height:1;color:rgba(255,255,255,.1)"></div>
    <a href="<?= base_url('ritual-guides/'.$guide['slug']) ?>" class="flex items-center gap-1.5 text-sm text-white/70 hover:text-white mb-3">
        ← Back to Guide
    </a>
    <p class="text-white/60 text-xs uppercase tracking-widest">Ritual Kit</p>
    <h1 class="font-serif text-xl font-bold text-white mt-1"><?= esc($kit['name'] ?? 'Ritual Kit') ?></h1>
    <p class="text-white/70 text-sm mt-1">For: <?= esc($guide['title'] ?? '') ?></p>
</div>

<!-- Progress steps -->
<div class="px-4 py-3 flex items-center gap-2 text-xs font-semibold border-b border-goldleaf/20">
    <span class="step-active rounded-full px-3 py-1">1 Kit</span>
    <div class="h-px flex-1 bg-goldleaf/30"></div>
    <span class="step-todo rounded-full px-3 py-1">2 Address</span>
    <div class="h-px flex-1 bg-goldleaf/30"></div>
    <span class="step-todo rounded-full px-3 py-1">3 Pay</span>
</div>

<div class="px-4 py-5 space-y-4">

    <!-- Kit contents -->
    <?php if (!empty($contents)): ?>
    <div class="gold-border rounded-2xl overflow-hidden reveal">
        <div class="px-4 py-3 bg-cream-dark flex items-center justify-between">
            <h2 class="font-serif font-bold text-deepmar text-sm inline-flex items-center gap-1.5"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-cart"/></svg> Kit Contents</h2>
            <span class="text-xs text-ashgray"><?= count($contents) ?> items</span>
        </div>
        <div class="px-4 py-3 grid grid-cols-2 gap-2">
            <?php foreach ($contents as $item): ?>
            <div class="flex items-center gap-2 text-sm text-deepmar">
                <span class="text-saffron">✓</span> <?= esc($item) ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Quantity -->
    <div class="bg-white rounded-2xl px-4 py-4 shadow-sm border border-goldleaf/10 reveal">
        <label class="text-xs font-semibold text-ashgray uppercase tracking-wide block mb-3">Quantity</label>
        <div class="flex items-center gap-4">
            <button onclick="changeQty(-1)" class="w-9 h-9 rounded-xl bg-cream-dark border border-goldleaf/20 font-bold text-lg text-deepmar hover:bg-saffron/10 transition-colors">−</button>
            <span id="qty" class="text-xl font-bold font-serif text-deepmar w-8 text-center">1</span>
            <button onclick="changeQty(1)" class="w-9 h-9 rounded-xl bg-cream-dark border border-goldleaf/20 font-bold text-lg text-deepmar hover:bg-saffron/10 transition-colors">+</button>
        </div>
    </div>

    <!-- Address -->
    <div class="bg-white rounded-2xl px-4 py-4 shadow-sm border border-goldleaf/10 reveal">
        <label class="text-xs font-semibold text-ashgray uppercase tracking-wide block mb-3">Delivery Address</label>
        <textarea name="address" rows="3" placeholder="Flat/House No., Street, City, PIN Code"
            class="w-full border border-goldleaf/30 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-saffron transition-colors resize-none"></textarea>
    </div>

    <!-- Price summary -->
    <div class="bg-white rounded-2xl px-4 py-4 shadow-sm border border-goldleaf/10 reveal">
        <div class="flex justify-between text-sm mb-2">
            <span class="text-ashgray">Kit price</span>
            <span class="text-deepmar font-semibold">₹<?= number_format($kit['price'] ?? 0) ?></span>
        </div>
        <div class="flex justify-between text-sm mb-2">
            <span class="text-ashgray">Delivery</span>
            <span class="text-green-600 font-semibold">Free</span>
        </div>
        <div class="border-t border-goldleaf/20 pt-2 mt-2 flex justify-between font-bold text-deepmar">
            <span>Total</span>
            <span id="totalPrice" class="text-saffron font-serif text-lg">₹<?= number_format($kit['price'] ?? 0) ?></span>
        </div>
    </div>

    <button onclick="placeOrder()"
        class="w-full bg-gradient-to-r from-saffron to-saffron-dark text-white font-bold py-4 rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm animate-glow">
        Place Order — ₹<?= number_format($kit['price'] ?? 0) ?>
    </button>
    <p class="text-center text-xs text-ashgray">Delivery in 3–5 business days</p>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
const basePrice = <?= $kit['price'] ?? 0 ?>;
let qty = 1;
function changeQty(d) {
    qty = Math.max(1, qty + d);
    document.getElementById('qty').textContent = qty;
    document.getElementById('totalPrice').textContent = '₹' + (basePrice * qty).toLocaleString('en-IN');
}
function placeOrder() {
    // POST to kit place endpoint
    alert('Order functionality coming soon!');
}
</script>
<?= $this->endSection() ?>
