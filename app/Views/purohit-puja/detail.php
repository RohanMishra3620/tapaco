<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Back + language toggle -->
<div class="sticky top-[61px] z-20 bg-cream/95 backdrop-blur-sm border-b border-goldleaf/20 px-4 py-2 flex items-center justify-between">
    <a href="<?= base_url('purohit-puja') ?>" class="flex items-center gap-1.5 text-sm text-ashgray hover:text-saffron">← Back</a>
    <div class="flex rounded-lg border border-goldleaf/30 overflow-hidden text-xs font-semibold">
        <a href="?lang=en" class="px-3 py-1.5 <?= $lang==='en' ? 'bg-saffron text-white' : 'text-ashgray hover:bg-cream-dark' ?>">EN</a>
        <a href="?lang=hi" class="px-3 py-1.5 <?= $lang==='hi' ? 'bg-saffron text-white' : 'text-ashgray hover:bg-cream-dark' ?>">हि</a>
    </div>
</div>

<!-- Hero -->
<div class="cat-purohit px-5 py-5">
    <span class="inline-flex w-14 h-14 rounded-2xl bg-vermil/10 text-vermil items-center justify-center"><svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><use href="#ic-flame"/></svg></span>
    <h1 class="font-serif text-2xl font-bold text-deepmar mt-3"><?= esc($puja['name']) ?></h1>
    <?php if ($puja['vidhi_preview']): ?>
    <p class="text-ashgray text-xs mt-1"><?= esc($puja['vidhi_preview']) ?></p>
    <?php endif; ?>
</div>

<div class="px-4 space-y-4 pb-32">

    <!-- Description -->
    <div class="bg-white rounded-2xl px-4 py-4 shadow-sm border border-goldleaf/10 reveal">
        <p class="text-deepmar/80 text-sm leading-relaxed">
            <?= $lang === 'hi' ? esc($puja['description_hi'] ?? $puja['description_en']) : esc($puja['description_en']) ?>
        </p>
        <?php if ($puja['samagri_included']): ?>
        <div class="mt-3 flex items-center gap-2 text-xs text-green-600 font-semibold bg-green-50 px-3 py-2 rounded-xl">
            <span>✓</span> Samagri kit + Pandit + Havan kit included as one bundle
        </div>
        <?php endif; ?>
    </div>

    <!-- Variant selection -->
    <div class="reveal">
        <h2 class="font-serif font-bold text-deepmar mb-3">Select Variant</h2>
        <?php
        // Fallback variants from PDF spec if DB is empty
        if (empty($variants)) {
            $variants = [
                ['id'=>1,'name'=>'Sankshipt','description'=>'Essential puja · core mantras & vidhi','duration_minutes'=>90,'price'=>7100],
                ['id'=>2,'name'=>'Vistrit','description'=>'Complete puja · full vidhi, havan & aarti','duration_minutes'=>180,'price'=>14000],
            ];
        }
        ?>
        <div style="display:flex;flex-direction:column;gap:10px" id="variantGroup">
            <?php foreach ($variants as $i => $v): ?>
            <div onclick="selectVariant(this, <?= $v['id'] ?>, <?= $v['price'] ?>)"
                 style="display:flex;align-items:center;gap:14px;background:#fff;border:2px solid <?= $i===0?'#B85B08':'#EDE5D8' ?>;border-radius:16px;padding:16px 18px;cursor:pointer;transition:border-color .2s,box-shadow .2s;<?= $i===0?'box-shadow:0 4px 16px rgba(184,91,8,.12)':'' ?>">
              <div style="flex:1">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px">
                  <span style="font-weight:700;font-size:.95rem;color:#130700"><?= esc($v['name']) ?></span>
                  <?php if($v['duration_minutes']): ?>
                  <span style="font-size:.68rem;font-weight:600;background:#FEF3C7;color:#92400E;padding:2px 8px;border-radius:10px">⏱ <?= $v['duration_minutes'] ?> min</span>
                  <?php endif; ?>
                </div>
                <?php if($v['description']): ?>
                <div style="font-size:.8rem;color:#6B4A28"><?= esc($v['description']) ?></div>
                <?php endif; ?>
              </div>
              <div style="text-align:right;flex-shrink:0">
                <div style="font-family:'Cormorant Garamond',serif;font-size:1.35rem;font-weight:700;color:#B85B08">₹<?= number_format($v['price']) ?></div>
                <div style="font-size:.62rem;color:#9A7A58">incl. samagri</div>
              </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Pandit selection -->
    <div class="reveal">
        <h2 class="font-serif font-bold text-deepmar mb-3">Choose a Pandit</h2>
        <?php if (empty($pandits)) {
            $pandits = [
                ['id'=>1,'name'=>'Pandit Ramesh Sharma','languages_spoken'=>'Hindi, Sanskrit','experience_years'=>15,'rating'=>4.9],
                ['id'=>2,'name'=>'Pandit Suresh Tiwari','languages_spoken'=>'Hindi, English','experience_years'=>10,'rating'=>4.8],
                ['id'=>3,'name'=>'Pandit Vijay Mishra','languages_spoken'=>'Hindi, Marathi','experience_years'=>12,'rating'=>4.7],
            ];
        } ?>
        <div class="space-y-2" id="panditGroup">
            <?php foreach ($pandits as $i => $p): ?>
            <label class="flex items-center gap-3 bg-white rounded-xl px-4 py-3 border-2 cursor-pointer transition-all
                          <?= $i === 0 ? 'border-saffron shadow-sm' : 'border-goldleaf/20 hover:border-saffron/40' ?>"
                   onclick="selectPandit(this, <?= $p['id'] ?>)">
                <input type="radio" name="pandit" value="<?= $p['id'] ?>" <?= $i === 0 ? 'checked' : '' ?>>
                <div class="w-10 h-10 rounded-full bg-saffron/10 flex items-center justify-center text-lg font-bold text-saffron font-serif flex-shrink-0">
                    <?= strtoupper(substr($p['name'],8,1)) ?>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-deepmar text-sm"><?= esc($p['name']) ?></p>
                    <p class="text-ashgray text-xs"><?= esc($p['languages_spoken']) ?> · <?= $p['experience_years'] ?>yr exp</p>
                </div>
                <div class="flex-shrink-0 text-center">
                    <p class="text-saffron font-bold text-sm inline-flex items-center gap-1"><svg width="13" height="13" fill="var(--saffron)" stroke="none" viewBox="0 0 24 24"><path d="M12 2l2.5 7H20l-5 3.5 2 6.5L12 15l-5 4 2-6.5L4 9h5.5z"/></svg><?= $p['rating'] ?></p>
                </div>
            </label>
            <?php endforeach; ?>
        </div>
        <!-- WhatsApp escape hatch -->
        <a href="https://wa.me/919999999999?text=I+wish+to+book+<?= urlencode($puja['name']) ?>"
           target="_blank"
           class="mt-3 flex items-center justify-center gap-2 border border-green-400/40 text-green-700 text-sm font-semibold py-2.5 rounded-xl hover:bg-green-50 transition-colors">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-chat"/></svg> Wish to chat? WhatsApp us
        </a>
    </div>

    <!-- Date & Time -->
    <div class="bg-white rounded-2xl px-4 py-4 shadow-sm border border-goldleaf/10 reveal">
        <h2 class="font-serif font-bold text-deepmar mb-3">Select Date & Time</h2>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="text-xs text-ashgray uppercase tracking-wide block mb-1.5">Date</label>
                <input type="date" id="bookDate" min="<?= date('Y-m-d') ?>"
                    class="w-full border border-goldleaf/30 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-saffron transition-colors">
            </div>
            <div>
                <label class="text-xs text-ashgray uppercase tracking-wide block mb-1.5">Time</label>
                <input type="time" id="bookTime"
                    class="w-full border border-goldleaf/30 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-saffron transition-colors">
            </div>
        </div>
    </div>

    <!-- Inline confirm CTA -->
    <div class="reveal" style="padding:0 16px 24px">
        <div style="background:#fff;border:1px solid #EAE0D0;border-radius:16px;padding:16px 18px;display:flex;align-items:center;justify-content:space-between;gap:14px;margin-bottom:12px">
            <div>
                <p style="font-size:.72rem;color:#8C6848;text-transform:uppercase;letter-spacing:.08em;margin-bottom:2px">Selected</p>
                <p class="font-bold font-serif text-saffron text-lg" id="selectedPrice" style="font-size:1.3rem;font-weight:700;color:#B85B08">₹<?= number_format($variants[0]['price'] ?? 0) ?></p>
            </div>
            <button onclick="proceedToBook()"
                style="flex:1;background:linear-gradient(135deg,#7A1E12,#B85B08);color:#fff;font-weight:700;font-size:.9rem;padding:14px 20px;border-radius:12px;border:none;cursor:pointer;box-shadow:0 8px 22px rgba(122,30,18,.3);transition:transform .2s,box-shadow .2s;letter-spacing:.02em"
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 12px 30px rgba(122,30,18,.4)'"
                onmouseout="this.style.transform='';this.style.boxShadow='0 8px 22px rgba(122,30,18,.3)'">
                Confirm Booking →
            </button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
let selectedVariantId = <?= $variants[0]['id'] ?? 0 ?>;
let selectedPanditId  = <?= $pandits[0]['id'] ?? 0 ?>;

function selectVariant(el, id, price) {
    selectedVariantId = id;
    document.querySelectorAll('#variantGroup label').forEach(l => l.className = l.className.replace('border-saffron shadow-md','border-goldleaf/20'));
    el.className = el.className.replace('border-goldleaf/20','border-saffron shadow-md');
    document.getElementById('selectedPrice').textContent = '₹' + price.toLocaleString('en-IN');
}
function selectPandit(el, id) {
    selectedPanditId = id;
    document.querySelectorAll('#panditGroup label').forEach(l => l.className = l.className.replace('border-saffron shadow-sm','border-goldleaf/20'));
    el.className = el.className.replace('border-goldleaf/20','border-saffron shadow-sm');
}
function proceedToBook() {
    const date = document.getElementById('bookDate').value;
    const time = document.getElementById('bookTime').value;
    if (!date || !time) { alert('Please select a date and time'); return; }

    fetch('<?= base_url('purohit-puja/'.$puja['slug'].'/book') ?>', {
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded','X-Requested-With':'XMLHttpRequest'},
        body: `variant_id=${selectedVariantId}&pandit_id=${selectedPanditId}&date=${date}&time=${time}&<?= csrf_token() ?>=<?= csrf_hash() ?>`
    })
    .then(r=>r.json())
    .then(d=>{ if (d.redirect) window.location.href = d.redirect; else if(d.success) window.location.href = d.redirect; });
}
</script>
<?= $this->endSection() ?>
