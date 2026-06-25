<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="min-h-screen flex flex-col px-5 pt-6 pb-10">
    <!-- Header -->
    <a href="javascript:history.back()" class="flex items-center gap-1.5 text-sm text-ashgray hover:text-saffron mb-6">← Back</a>

    <!-- Hero banner -->
    <div class="rounded-2xl p-7 text-center relative overflow-hidden mb-6" style="background:linear-gradient(120deg,#6E1A10 0%,#9A3312 45%,#C2740C 100%);box-shadow:0 18px 44px rgba(122,30,18,.18)">
        <div class="absolute -right-5 -top-6 select-none" style="font-family:'Noto Serif Devanagari',serif;font-size:150px;line-height:1;color:rgba(255,255,255,.1)"></div>
        <span class="inline-flex w-16 h-16 rounded-2xl items-center justify-center mb-4 animate-float" style="background:rgba(251,192,74,.18)">
            <svg width="30" height="30" fill="none" stroke="#FBC04A" stroke-width="1.5" viewBox="0 0 24 24"><use href="#ic-bell"/></svg>
        </span>
        <h1 class="font-serif text-2xl font-bold text-white relative">Sacred WhatsApp Subscription</h1>
        <p class="text-sm mt-2 relative" style="color:rgba(255,232,194,.85)">Daily panchang, vrat reminders & puja guides — on WhatsApp</p>
    </div>

    <!-- Value prop card -->
    <div class="rounded-2xl bg-white shadow-sm border p-6 mb-5" style="border-color:var(--line)">
        <div class="text-center mb-5">
            <span class="text-4xl font-bold font-serif" style="color:var(--gold2,#8A6206)">₹99</span>
            <span class="text-ashgray text-sm">/year</span>
            <p class="text-[11px] text-ashgray mt-0.5">That's just ₹8/month</p>
        </div>
        <div class="space-y-3">
            <?php
            $perks = [
                ['ic-sun',  'Daily tithi, nakshatra & muhurat'],
                ['ic-moon', 'Vrat reminders — 3 days before'],
                ['ic-book', 'Guided ritual content for every puja'],
                ['ic-star', 'Exclusive member offers on bookings'],
                ['ic-bell', 'Festival & auspicious day alerts'],
            ];
            foreach ($perks as [$ic, $text]): ?>
            <div class="flex items-center gap-3 text-sm reveal" style="color:var(--ink2,#3A1C04)">
                <span class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#B85B0814;border:1px solid #B85B0833">
                    <svg width="17" height="17" fill="none" stroke="var(--saffron)" stroke-width="1.7" viewBox="0 0 24 24"><use href="#<?= $ic ?>"/></svg>
                </span>
                <span class="font-medium"><?= $text ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Form -->
    <form id="subForm" class="space-y-3">
        <div>
            <label class="text-xs font-semibold text-ashgray uppercase tracking-wide block mb-1.5">WhatsApp Number</label>
            <div class="flex gap-2">
                <span class="flex items-center px-3 bg-cream rounded-xl border border-goldleaf/30 text-sm text-deepmar">+91</span>
                <input type="tel" name="whatsapp_number" maxlength="10" placeholder="9876543210" inputmode="numeric"
                    class="flex-1 border border-goldleaf/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-saffron transition-colors">
            </div>
        </div>
        <p class="text-[11px] text-ashgray leading-relaxed">
            By subscribing you consent to receive WhatsApp messages from The Tapa Co. Reply STOP anytime to unsubscribe.
        </p>
        <button type="submit"
            class="w-full bg-gradient-to-r from-saffron to-saffron-dark text-white font-bold py-4 rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm animate-glow">
            Confirm & Pay ₹99 →
        </button>
    </form>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
document.getElementById('subForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const num = this.whatsapp_number.value;
    if (!/^[6-9]\d{9}$/.test(num)) { alert('Enter valid WhatsApp number'); return; }
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '<?= base_url('subscribe/pay') ?>';
    form.innerHTML = `
        <input name="whatsapp_number" value="${num}">
        <input name="method" value="upi">
        <input name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
    `;
    document.body.append(form);
    form.submit();
});
</script>
<?= $this->endSection() ?>
