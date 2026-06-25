<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="px-5 pt-6 pb-10">
    <a href="<?= base_url('subscribe') ?>" class="flex items-center gap-1.5 text-sm text-ashgray hover:text-saffron mb-5">← Back</a>

    <h1 class="font-serif text-xl font-bold text-deepmar mb-1">Complete Payment</h1>
    <p class="text-ashgray text-sm mb-5">WhatsApp subscription — ₹<?= $amount ?>/year</p>

    <!-- Amount banner -->
    <div class="bg-gradient-to-r from-saffron/10 to-turmeric/10 border border-goldleaf/30 rounded-2xl px-5 py-4 mb-5 text-center">
        <p class="text-ashgray text-xs uppercase tracking-widest mb-1">Total Payable</p>
        <p class="font-bold font-serif text-saffron text-3xl">₹<?= $amount ?></p>
    </div>

    <!-- Payment methods -->
    <div class="space-y-2 mb-5">
        <p class="text-xs font-semibold text-ashgray uppercase tracking-widest mb-2">Select Payment Method</p>
        <?php
        $methods = [
            ['upi',    'ic-phone', 'UPI',    'Google Pay, PhonePe, Paytm'],
            ['card',   'ic-card', 'Card',   'Credit / Debit card'],
            ['wallet', 'ic-cart', 'Wallet', 'Paytm, Amazon Pay, etc.'],
        ];
        foreach ($methods as [$k, $icon, $label, $sub]): ?>
        <label class="flex items-center gap-3 bg-white rounded-xl px-4 py-3.5 border-2 cursor-pointer transition-all
               <?= $method === $k ? 'border-saffron shadow-md' : 'border-goldleaf/20 hover:border-saffron/40' ?>">
            <input type="radio" name="paymethod" value="<?= $k ?>" <?= $method === $k ? 'checked' : '' ?> class="text-saffron">
            <span class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#B85B0814;color:var(--saffron)"><svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><use href="#<?= $icon ?>"/></svg></span>
            <div>
                <p class="font-semibold text-deepmar text-sm"><?= $label ?></p>
                <p class="text-ashgray text-xs"><?= $sub ?></p>
            </div>
        </label>
        <?php endforeach; ?>
    </div>

    <a href="<?= base_url('subscribe/success') ?>"
       class="block text-center bg-gradient-to-r from-saffron to-saffron-dark text-white font-bold py-4 rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm animate-glow">
        Pay ₹<?= $amount ?> →
    </a>
    <p class="text-center text-[11px] text-ashgray mt-3 inline-flex items-center justify-center gap-1.5 w-full"><svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-lock"/></svg> Secured by Razorpay</p>
</div>

<?= $this->endSection() ?>
