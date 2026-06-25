<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="cat-bhajan px-5 pt-6 pb-5 relative overflow-hidden">
    <a href="<?= base_url('bhajan-mandali') ?>" class="flex items-center gap-1.5 text-sm text-ashgray hover:text-saffron mb-3">← Back</a>
    <span class="inline-flex w-14 h-14 rounded-2xl bg-goldleaf/10 text-goldleaf items-center justify-center"><svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><use href="#ic-music"/></svg></span>
    <h1 class="font-serif text-2xl font-bold text-deepmar mt-3"><?= esc($mandali['name']) ?></h1>
    <?php if ($mandali['starting_price']): ?>
    <p class="text-saffron font-semibold text-sm mt-1">Starting ₹<?= number_format($mandali['starting_price']) ?></p>
    <?php endif; ?>
</div>

<div class="px-4 pt-4 pb-6 space-y-4">

    <!-- Description -->
    <div class="bg-white rounded-2xl px-4 py-4 shadow-sm border border-goldleaf/10 reveal">
        <h2 class="font-serif font-bold text-deepmar mb-2">About</h2>
        <p class="text-deepmar/80 text-sm leading-relaxed"><?= esc($mandali['description'] ?? '') ?></p>
        <div class="mt-3 grid grid-cols-2 gap-2 text-xs">
            <div class="bg-cream-dark rounded-xl px-3 py-2">
                <p class="text-ashgray">What's included</p>
                <p class="font-semibold text-deepmar mt-0.5">Musicians + Sound system</p>
            </div>
            <div class="bg-cream-dark rounded-xl px-3 py-2">
                <p class="text-ashgray">Duration</p>
                <p class="font-semibold text-deepmar mt-0.5">2–4 hours</p>
            </div>
        </div>
    </div>

    <!-- Booking form -->
    <div class="bg-white rounded-2xl px-4 py-4 shadow-sm border border-goldleaf/10 reveal">
        <h2 class="font-serif font-bold text-deepmar mb-3">Booking Details</h2>
        <div class="space-y-3">
            <div>
                <label class="text-xs text-ashgray uppercase tracking-wide block mb-1.5">Event Date</label>
                <input type="date" id="bmDate" min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                    class="w-full border border-goldleaf/30 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-saffron transition-colors">
            </div>
            <div>
                <label class="text-xs text-ashgray uppercase tracking-wide block mb-1.5">Venue / Address</label>
                <textarea id="bmVenue" rows="2" placeholder="Enter venue or full address"
                    class="w-full border border-goldleaf/30 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-saffron transition-colors resize-none"></textarea>
            </div>
            <div>
                <label class="text-xs text-ashgray uppercase tracking-wide block mb-1.5">Expected Guests</label>
                <input type="number" id="bmGuests" placeholder="e.g. 50" min="1"
                    class="w-full border border-goldleaf/30 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-saffron transition-colors">
            </div>
        </div>
    </div>

    <!-- Note on availability -->
    <div style="background:#FFFBEB;border:1px solid #F5D87A;border-radius:14px;padding:14px 16px;font-size:.8rem;color:#7A5C00" class="reveal">
        <p style="font-weight:600;margin-bottom:4px;display:flex;align-items:center;gap:6px"><svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-doc"/></svg> Request-based booking</p>
        <p>We'll confirm availability within 24 hours and send details on WhatsApp.</p>
    </div>

    <!-- CTA — inline, no fixed bar -->
    <div class="reveal" style="padding-bottom:8px">
        <button onclick="submitMandali()"
            style="width:100%;background:linear-gradient(135deg,#B85B08,#8A4106);color:#fff;font-weight:700;font-size:.95rem;padding:16px;border-radius:14px;border:none;cursor:pointer;box-shadow:0 8px 24px rgba(184,91,8,.3);transition:transform .2s,box-shadow .2s;letter-spacing:.02em"
            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 12px 32px rgba(184,91,8,.4)'"
            onmouseout="this.style.transform='';this.style.boxShadow='0 8px 24px rgba(184,91,8,.3)'">
            Check Availability →
        </button>
        <a href="https://wa.me/919999999999?text=I+want+to+book+<?= urlencode($mandali['name']) ?>"
           target="_blank"
           style="display:flex;align-items:center;justify-content:center;gap:7px;color:#1A6B3A;font-size:.85rem;font-weight:600;padding:14px;text-decoration:none;margin-top:4px">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-chat"/></svg> Or chat on WhatsApp
        </a>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
function submitMandali() {
    const date   = document.getElementById('bmDate').value;
    const venue  = document.getElementById('bmVenue').value.trim();
    const guests = document.getElementById('bmGuests').value;
    if (!date || !venue) { alert('Please fill in date and venue'); return; }

    fetch('<?= base_url('bhajan-mandali/'.$mandali['slug'].'/book') ?>', {
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded','X-Requested-With':'XMLHttpRequest'},
        body: `date=${date}&venue=${encodeURIComponent(venue)}&guests=${guests}&<?= csrf_token() ?>=<?= csrf_hash() ?>`
    })
    .then(r=>r.json())
    .then(d=>{ if (d.redirect) window.location.href = d.redirect; });
}
</script>
<?= $this->endSection() ?>
