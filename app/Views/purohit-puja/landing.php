<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- HERO -->
<div class="cat-purohit" style="padding:44px 24px 36px">
  <p style="font-size:.6rem;font-weight:800;letter-spacing:.22em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:10px">Book a Pandit</p>
  <h1 style="font-family:'Cormorant Garamond',serif;font-size:2.4rem;font-weight:700;color:#fff;line-height:1.05;margin-bottom:10px">Purohit &amp; Puja</h1>
  <p style="font-size:.92rem;color:rgba(255,255,255,.62);line-height:1.65;margin-bottom:24px;max-width:300px">Expert pandits at your doorstep. Samagri kit included. Book in 60 seconds.</p>
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <a href="#pujas" style="display:inline-flex;align-items:center;gap:7px;background:#fff;color:#7A1E12 !important;font-size:.82rem;font-weight:800;padding:13px 22px;border-radius:10px;text-decoration:none">Book a Puja →</a>
    <a href="https://wa.me/919999999999?text=I+want+to+book+a+puja" target="_blank" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.12);color:#fff;font-size:.82rem;font-weight:600;padding:13px 18px;border-radius:10px;text-decoration:none;border:1px solid rgba(255,255,255,.22)">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><use href="#ic-chat"/></svg> WhatsApp
    </a>
  </div>
</div>

<!-- STATS BAR -->
<div style="display:grid;grid-template-columns:repeat(3,1fr);background:#fff;border-bottom:1px solid #EDE5D8">
  <?php foreach([['48+','Pandits'],['500+','Pujas done'],['4.9★','Rating']] as $i=>[$n,$l]): ?>
  <div style="padding:16px 8px;text-align:center;<?= $i<2?'border-right:1px solid #EDE5D8':'' ?>">
    <div style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;font-weight:700;color:#7A1E12"><?= $n ?></div>
    <div style="font-size:.6rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:#9A7A58;margin-top:2px"><?= $l ?></div>
  </div>
  <?php endforeach; ?>
</div>

<!-- HOW IT WORKS -->
<div style="padding:28px 20px 24px;background:#FDFCF9;border-bottom:1px solid #EDE5D8">
  <p style="font-size:.58rem;font-weight:800;letter-spacing:.22em;text-transform:uppercase;color:#B07D08;margin-bottom:20px">How It Works</p>
  <div style="display:flex;flex-direction:column;gap:18px">
    <?php foreach([
      ['1','Choose Your Puja','Rudrabhishek, Satyanarayan, Navratri Ghatsthapna &amp; more'],
      ['2','Pick Your Pandit','Browse pandit profiles — experience, languages &amp; ratings'],
      ['3','Book Date &amp; Time','Confirm instantly. Pandit arrives with full samagri kit.'],
    ] as $i=>[$num,$title,$desc]): ?>
    <div style="display:flex;gap:14px;align-items:flex-start">
      <div style="width:34px;height:34px;border-radius:9px;background:<?= ['#7A1E12','#B85B08','#B07D08'][$i] ?>;color:#fff;font-size:.72rem;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0"><?= $num ?></div>
      <div>
        <div style="font-weight:700;font-size:.92rem;color:#130700;margin-bottom:3px"><?= $title ?></div>
        <div style="font-size:.8rem;color:#6B4A28;line-height:1.55"><?= $desc ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- PUJA LIST -->
<div id="pujas" style="padding:24px 16px 8px">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:700;color:#130700">Choose Your Puja</h2>
    <span style="font-size:.72rem;color:#9A7A58"><?= count($pujas) ?> available</span>
  </div>
  <div class="card-grid">
    <?php if (empty($pujas)): ?>
    <div style="text-align:center;padding:48px 20px;color:#9A7A58;grid-column:1/-1">
      <svg style="margin:0 auto 10px;display:block" width="36" height="36" fill="none" stroke="#B85B08" stroke-width="1.4" viewBox="0 0 24 24"><use href="#ic-flame"/></svg>
      <p style="font-size:.9rem">Pujas coming soon</p>
    </div>
    <?php else: ?>
    <?php foreach ($pujas as $puja): ?>
    <a href="<?= base_url('purohit-puja/'.$puja['slug']) ?>" class="lotus-card reveal"
       style="display:flex;align-items:center;gap:14px;background:#fff;border:1px solid #EDE5D8;border-radius:16px;padding:16px;text-decoration:none">
      <div style="width:48px;height:48px;border-radius:13px;background:rgba(122,30,18,.07);display:flex;align-items:center;justify-content:center;flex-shrink:0">
        <svg width="22" height="22" fill="none" stroke="#7A1E12" stroke-width="1.7" viewBox="0 0 24 24"><use href="#ic-flame"/></svg>
      </div>
      <div style="flex:1;min-width:0">
        <div style="font-weight:700;font-size:.9rem;color:#130700;margin-bottom:3px"><?= esc($puja['name']) ?></div>
        <div style="font-size:.77rem;color:#6B4A28;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:7px"><?= esc($puja['description_en'] ?? 'Traditional puja with complete vidhi') ?></div>
        <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap">
          <?php if($puja['samagri_included']??true): ?><span style="font-size:.68rem;font-weight:700;color:#1A7A3C;background:#ECFDF5;padding:3px 9px;border-radius:20px">✓ Kit included</span><?php endif; ?>
          <?php if(!empty($puja['starting_price'])): ?><span style="font-size:.7rem;font-weight:600;color:#B85B08">From ₹<?= number_format($puja['starting_price']) ?></span><?php endif; ?>
        </div>
      </div>
      <svg width="15" height="15" fill="none" stroke="#C8A47A" stroke-width="2.2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6" stroke-linecap="round"/></svg>
    </a>
    <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<!-- TRUST GRID -->
<div style="margin:12px 16px 0;padding:22px;background:#fff;border:1px solid #EDE5D8;border-radius:20px">
  <p style="font-size:.58rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#B07D08;margin-bottom:16px">Why Families Choose Us</p>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
    <?php foreach([
      ['#7A1E12','ic-star','Verified &amp; Certified','Every pandit is tested &amp; certified'],
      ['#B85B08','ic-cart','Samagri Delivered','Complete kit at your door before puja'],
      ['#1A6B3A','ic-doc','Authentic Vidhi','Rituals per ancient shastra tradition'],
      ['#0A4A7A','ic-chat','WhatsApp Support','Help before, during &amp; after your puja'],
    ] as [$col,$ic,$title,$sub]): ?>
    <div>
      <div style="width:38px;height:38px;border-radius:10px;background:<?= $col ?>14;display:flex;align-items:center;justify-content:center;margin-bottom:9px">
        <svg width="18" height="18" fill="none" stroke="<?= $col ?>" stroke-width="1.7" viewBox="0 0 24 24"><use href="#<?= $ic ?>"/></svg>
      </div>
      <div style="font-weight:700;font-size:.85rem;color:#130700;margin-bottom:3px"><?= $title ?></div>
      <div style="font-size:.74rem;color:#6B4A28;line-height:1.5"><?= $sub ?></div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- PRICE + CTA -->
<div style="margin:14px 16px 0;background:linear-gradient(135deg,#3A0A06,#7A1E12);border-radius:20px;padding:22px 20px;display:flex;align-items:center;justify-content:space-between;gap:14px">
  <div>
    <p style="font-size:.58rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-bottom:5px">Starting from</p>
    <p style="font-family:'Cormorant Garamond',serif;font-size:2rem;font-weight:700;color:#fff;line-height:1;margin-bottom:3px">₹7,100</p>
    <p style="font-size:.76rem;color:rgba(255,255,255,.55)">Pandit + full samagri kit</p>
  </div>
  <a href="#pujas" style="display:inline-flex;align-items:center;gap:6px;background:#fff;color:#7A1E12;font-size:.8rem;font-weight:800;padding:14px 18px;border-radius:12px;text-decoration:none;white-space:nowrap">
    Book Now <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><use href="#ic-arrow"/></svg>
  </a>
</div>

<!-- WHATSAPP ESCAPE -->
<div style="margin:14px 16px 28px;padding:16px 18px;background:#F0FDF4;border:1px solid #BBF7D0;border-radius:16px;display:flex;align-items:center;gap:14px">
  <div style="width:42px;height:42px;border-radius:11px;background:#1A7A3C;display:flex;align-items:center;justify-content:center;flex-shrink:0">
    <svg width="21" height="21" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24"><use href="#ic-chat"/></svg>
  </div>
  <div style="flex:1">
    <div style="font-weight:700;font-size:.88rem;color:#065F46;margin-bottom:2px">Not sure which puja?</div>
    <div style="font-size:.76rem;color:#047857;line-height:1.45">Talk to our Vedic team — free guidance</div>
  </div>
  <a href="https://wa.me/919999999999?text=Help+me+choose+the+right+puja" target="_blank" style="background:#1A7A3C;color:#fff;font-size:.74rem;font-weight:700;padding:9px 13px;border-radius:9px;text-decoration:none;white-space:nowrap">Chat →</a>
</div>

<?= $this->endSection() ?>
