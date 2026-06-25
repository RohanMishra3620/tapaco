<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12 text-center">
    <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-5 animate-float" style="background:linear-gradient(150deg,#7A1E12,#B85B08);box-shadow:0 16px 40px rgba(122,30,18,.25)"><svg width="42" height="42" fill="none" stroke="#FBC04A" stroke-width="1.4" viewBox="0 0 24 24"><use href="#ic-music"/></svg></div>
    <h1 class="font-serif text-2xl font-bold text-deepmar mb-2">Request Submitted!</h1>
    <p class="text-ashgray text-sm mb-6">We'll confirm availability within 24 hours</p>

    <?php if ($booking): ?>
    <div class="w-full max-w-sm gold-border rounded-2xl bg-white shadow-xl p-5 text-left mb-6">
        <p class="text-xs font-semibold text-ashgray uppercase tracking-widest mb-3">Request Summary</p>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-ashgray">Request ID</span>
                <span class="font-bold text-deepmar">#<?= str_pad($booking['id'], 6, '0', STR_PAD_LEFT) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-ashgray">Event Date</span>
                <span class="font-semibold"><?= $booking['slot_date'] ? date('d M Y', strtotime($booking['slot_date'])) : '—' ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-ashgray">Status</span>
                <span class="text-amber-600 font-semibold">Pending Confirmation</span>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="w-full max-w-sm nudge-card rounded-2xl p-4 text-left mb-6">
        <p class="text-white font-semibold text-sm">Stay updated on WhatsApp</p>
        <a href="<?= base_url('subscribe?from=mandali-booking') ?>" class="mt-2 inline-block text-goldleaf text-xs font-bold hover:underline">
            Subscribe ₹99/year →
        </a>
    </div>

    <div class="w-full max-w-sm space-y-2">
        <a href="<?= base_url('/') ?>" class="block text-center bg-saffron text-white font-bold py-3.5 rounded-2xl text-sm active:scale-95 transition-all">
            Back to Home
        </a>
    </div>
</div>

<?= $this->endSection() ?>
