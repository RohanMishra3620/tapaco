<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- HERO -->
<div class="cat-bhajan" style="padding:44px 24px 36px">
  <p style="font-size:.6rem;font-weight:800;letter-spacing:.22em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:10px">Sacred Music</p>
  <h1 style="font-family:'Cormorant Garamond',serif;font-size:2.4rem;font-weight:700;color:#fff;line-height:1.05;margin-bottom:10px">Bhajan Mandali</h1>
  <p style="font-size:.92rem;color:rgba(255,255,255,.62);line-height:1.65;margin-bottom:24px;max-width:300px">Professional devotional music groups for your puja, festival or spiritual event.</p>
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <a href="#mandalis" style="display:inline-flex;align-items:center;gap:7px;background:#fff;color:#3A1480;font-size:.82rem;font-weight:800;padding:13px 22px;border-radius:10px;text-decoration:none">Book a Mandali →</a>
    <a href="https://wa.me/919999999999?text=I+want+to+book+a+bhajan+mandali" target="_blank" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.12);color:#fff;font-size:.82rem;font-weight:600;padding:13px 18px;border-radius:10px;text-decoration:none;border:1px solid rgba(255,255,255,.22)">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><use href="#ic-chat"/></svg> WhatsApp
    </a>
  </div>
</div>

<!-- PERFECT FOR CHIPS -->
<div style="padding:20px 16px 18px;background:#fff;border-bottom:1px solid #EDE5D8">
  <p style="font-size:.58rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#3A1480;margin-bottom:14px">Perfect For</p>
  <div style="display:flex;gap:8px;flex-wrap:wrap">
    <?php foreach(['Jagran 🌙','Navratri 🪔','Birthday Kirtan 🎂','Satsang 🙏','Marriage Ceremony 💐','Ganesh Chaturthi 🐘','Monthly Puja 📿','Office Inauguration 🏢'] as $ev): ?>
    <span style="display:inline-block;font-size:.75rem;font-weight:600;padding:7px 14px;border-radius:20px;background:#F5F0FF;color:#3A1480;border:1px solid #D4C8F0"><?= $ev ?></span>
    <?php endforeach; ?>
  </div>
</div>

<!-- WHAT'S INCLUDED -->
<div style="padding:24px 20px;background:#FDFCF9;border-bottom:1px solid #EDE5D8">
  <p style="font-size:.58rem;font-weight:800;letter-spacing:.22em;text-transform:uppercase;color:#3A1480;margin-bottom:18px">What's Included</p>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
    <?php foreach([
      ['🎵','Live Musicians','Harmonium, tabla, dholak &amp; manjira'],
      ['🎤','Lead Singer','Trained vocalist with bhajan repertoire'],
      ['🔊','Sound System','PA system for large halls &amp; mandaps'],
      ['📜','Bhajan Booklets','Printouts for audience participation'],
    ] as [$em,$title,$sub]): ?>
    <div style="display:flex;gap:10px;align-items:flex-start">
      <div style="font-size:1.3rem;flex-shrink:0;margin-top:2px"><?= $em ?></div>
      <div>
        <div style="font-weight:700;font-size:.85rem;color:#130700;margin-bottom:2px"><?= $title ?></div>
        <div style="font-size:.74rem;color:#6B4A28;line-height:1.45"><?= $sub ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- MANDALI LIST -->
<div id="mandalis" style="padding:24px 16px 8px">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:700;color:#130700">Our Bhajan Groups</h2>
    <span style="font-size:.72rem;color:#9A7A58"><?= count($mandalis) ?> available</span>
  </div>
  <div class="card-grid">
    <?php
    // Hardcoded fallback per PDF spec if DB is empty
    if (empty($mandalis)) {
        $mandalis = [
            ['slug'=>'sundarkand','name'=>'Sundarkand Path','description'=>'Collective chanting of Hanuman Chalisa & Sundarkand with harmonium & dholak','starting_price'=>4500],
            ['slug'=>'mata-ki-chowki','name'=>'Mata Ki Chowki','description'=>'Devoted Mata bhajans for Navratri, jagrans & blessings ceremonies','starting_price'=>5500],
            ['slug'=>'shyam-darbaar','name'=>'Shyam Darbaar','description'=>'Khatu Shyam bhajans — melodious kirtans with full band setup','starting_price'=>6000],
            ['slug'=>'ram-darbaar','name'=>'Ram Darbaar Kirtan','description'=>'Ram bhajans & aarti for Ramnavami, vivah & satsang occasions','starting_price'=>4000],
            ['slug'=>'shiva-stotra','name'=>'Shiva Stotra Satsang','description'=>'Shiva stotras & Rudrashtakam with tabla, manjira & harmonium','starting_price'=>3500],
            ['slug'=>'generic-mix','name'=>'Generic Mix Bhajan','description'=>'A blend of popular devotional bhajans from all traditions','starting_price'=>3000],
        ];
    }
    foreach ($mandalis as $m): ?>
    <a href="<?= base_url('bhajan-mandali/'.$m['slug']) ?>" class="lotus-card reveal"
       style="display:flex;align-items:center;gap:14px;background:#fff;border:1px solid #EDE5D8;border-radius:16px;padding:16px;text-decoration:none">
      <div style="width:48px;height:48px;border-radius:13px;background:rgba(58,20,128,.07);display:flex;align-items:center;justify-content:center;flex-shrink:0">
        <svg width="22" height="22" fill="none" stroke="#3A1480" stroke-width="1.7" viewBox="0 0 24 24"><use href="#ic-music"/></svg>
      </div>
      <div style="flex:1;min-width:0">
        <div style="font-weight:700;font-size:.9rem;color:#130700;margin-bottom:3px"><?= esc($m['name']) ?></div>
        <div style="font-size:.77rem;color:#6B4A28;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:6px"><?= esc($m['description'] ?? 'Devotional music for every sacred occasion') ?></div>
        <?php if($m['starting_price']): ?>
        <span style="font-size:.72rem;font-weight:700;color:#3A1480">From ₹<?= number_format($m['starting_price']) ?></span>
        <?php endif; ?>
      </div>
      <svg width="15" height="15" fill="none" stroke="#C8A47A" stroke-width="2.2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6" stroke-linecap="round"/></svg>
    </a>
    <?php endforeach; ?>

    <!-- Custom request card -->
    <a href="https://wa.me/919999999999?text=I+want+to+book+a+Bhajan+Mandali" target="_blank"
       class="reveal" style="grid-column:1/-1;display:flex;align-items:center;justify-content:center;gap:10px;padding:18px;border:2px dashed #D4C8F0;border-radius:16px;color:#3A1480;font-size:.85rem;font-weight:600;text-decoration:none;background:#F9F7FF">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><use href="#ic-chat"/></svg>
      Have a custom requirement? Chat with us
    </a>
  </div>
</div>

<!-- HOW BOOKING WORKS -->
<div style="margin:16px 16px 0;padding:22px;background:#fff;border:1px solid #EDE5D8;border-radius:20px">
  <p style="font-size:.58rem;font-weight:800;letter-spacing:.22em;text-transform:uppercase;color:#3A1480;margin-bottom:18px">Booking Process</p>
  <div style="display:flex;flex-direction:column;gap:16px">
    <?php foreach([
      ['Submit Request','Fill in your event date, venue &amp; guest count'],
      ['We Confirm','Our team checks availability &amp; confirms in 24hrs'],
      ['Mandali Arrives','Musicians arrive on time, fully equipped'],
    ] as $i=>[$t,$d]): ?>
    <div style="display:flex;gap:13px;align-items:flex-start">
      <div style="width:26px;height:26px;border-radius:50%;background:#3A1480;color:#fff;font-size:.68rem;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px"><?= $i+1 ?></div>
      <div>
        <div style="font-weight:700;font-size:.88rem;color:#130700;margin-bottom:2px"><?= $t ?></div>
        <div style="font-size:.78rem;color:#6B4A28;line-height:1.5"><?= $d ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- PRICE CTA -->
<div style="margin:14px 16px 0;background:linear-gradient(135deg,#1A0844,#3A1480);border-radius:20px;padding:22px 20px;display:flex;align-items:center;justify-content:space-between;gap:14px">
  <div>
    <p style="font-size:.58rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-bottom:5px">Starting from</p>
    <p style="font-family:'Cormorant Garamond',serif;font-size:2rem;font-weight:700;color:#fff;line-height:1;margin-bottom:3px">₹3,500</p>
    <p style="font-size:.76rem;color:rgba(255,255,255,.55)">3–5 musicians · 2–4 hours</p>
  </div>
  <a href="#mandalis" style="display:inline-flex;align-items:center;gap:6px;background:#fff;color:#3A1480;font-size:.8rem;font-weight:800;padding:14px 18px;border-radius:12px;text-decoration:none;white-space:nowrap">
    Book Now <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><use href="#ic-arrow"/></svg>
  </a>
</div>

<!-- WHATSAPP -->
<div style="margin:14px 16px 28px;padding:16px 18px;background:#F0FDF4;border:1px solid #BBF7D0;border-radius:16px;display:flex;align-items:center;gap:14px">
  <div style="width:42px;height:42px;border-radius:11px;background:#1A7A3C;display:flex;align-items:center;justify-content:center;flex-shrink:0">
    <svg width="21" height="21" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24"><use href="#ic-chat"/></svg>
  </div>
  <div style="flex:1">
    <div style="font-weight:700;font-size:.88rem;color:#065F46;margin-bottom:2px">Need a custom bhajan set?</div>
    <div style="font-size:.76rem;color:#047857">Tell us the occasion — we'll arrange the perfect mandali</div>
  </div>
  <a href="https://wa.me/919999999999?text=I+need+a+bhajan+mandali+for+my+event" target="_blank" style="background:#1A7A3C;color:#fff;font-size:.74rem;font-weight:700;padding:9px 13px;border-radius:9px;text-decoration:none;white-space:nowrap">Chat →</a>
</div>

<?= $this->endSection() ?>
