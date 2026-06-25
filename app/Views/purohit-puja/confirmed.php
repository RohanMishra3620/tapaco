<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12 text-center">
    <!-- Success animation -->
    <div class="relative mb-6">
        <div class="w-24 h-24 rounded-full flex items-center justify-center animate-float" style="background:linear-gradient(150deg,#7A1E12,#B85B08);box-shadow:0 16px 40px rgba(122,30,18,.25)"><svg width="44" height="44" fill="none" stroke="#FBC04A" stroke-width="1.4" viewBox="0 0 24 24"><use href="#ic-flame"/></svg></div>
        <div class="absolute -top-1 -right-1 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center animate-bounce">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
    </div>

    <h1 class="font-serif text-2xl font-bold text-deepmar mb-2">Booking Confirmed!</h1>
    <p class="text-ashgray text-sm mb-6">Your puja has been scheduled</p>

    <!-- Booking summary card -->
    <?php if ($booking): ?>
    <div class="w-full max-w-sm gold-border rounded-2xl bg-white shadow-xl p-5 text-left mb-6 reveal">
        <p class="text-xs font-semibold text-ashgray uppercase tracking-widest mb-3">Booking Summary</p>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-ashgray">Booking ID</span>
                <span class="font-bold text-deepmar">#<?= str_pad($booking['id'], 6, '0', STR_PAD_LEFT) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-ashgray">Date</span>
                <span class="font-semibold"><?= date('d M Y', strtotime($booking['slot_date'])) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-ashgray">Time</span>
                <span class="font-semibold"><?= date('h:i A', strtotime($booking['slot_time'])) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-ashgray">Amount</span>
                <span class="font-bold text-saffron font-serif text-base">₹<?= number_format($booking['amount']) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-ashgray">Status</span>
                <span class="text-green-600 font-semibold capitalize"><?= $booking['status'] ?></span>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- WhatsApp nudge (high-intent moment) -->
    <div class="w-full max-w-sm nudge-card rounded-2xl p-4 text-left mb-6 reveal">
        <p class="text-white/60 text-[10px] uppercase tracking-widest mb-1">Stay connected</p>
        <p class="text-white font-semibold text-sm">Subscribe for puja reminders & daily Panchang on WhatsApp</p>
        <a href="<?= base_url('subscribe?from=post-booking') ?>"
           class="mt-3 inline-flex items-center gap-1.5 bg-goldleaf text-deepmar text-xs font-bold px-4 py-2 rounded-full hover:bg-goldleaf-light active:scale-95 transition-all">
            Subscribe ₹99/year →
        </a>
    </div>

    <!-- Actions -->
    <div class="w-full max-w-sm space-y-2 reveal">
        <a href="<?= base_url('account') ?>"
           class="block text-center bg-saffron text-white font-bold py-3.5 rounded-2xl hover:bg-saffron-dark active:scale-95 transition-all text-sm">
            View in My Account
        </a>
        <a href="<?= base_url('/') ?>"
           class="block text-center text-ashgray text-sm py-3 border border-goldleaf/20 rounded-2xl hover:border-saffron/40 hover:text-saffron transition-colors">
            Back to Home
        </a>
    </div>
</div>

<?= $this->endSection() ?>
