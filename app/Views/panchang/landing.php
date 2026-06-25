<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- HERO -->
<div class="cat-panchang" style="padding:44px 24px 40px;position:relative;overflow:hidden">
  <!-- decorative Om watermark -->
  <div style="position:absolute;right:-20px;top:-10px;font-family:'Noto Serif Devanagari',serif;font-size:160px;color:rgba(255,255,255,.05);pointer-events:none;line-height:1;user-select:none">ॐ</div>
  <p style="font-size:.6rem;font-weight:800;letter-spacing:.22em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:10px">Calendar & Dates</p>
  <h1 style="font-family:'Cormorant Garamond',serif;font-size:2.4rem;font-weight:700;color:#fff;line-height:1.05;margin-bottom:10px">Panchang</h1>
  <p style="font-size:.92rem;color:rgba(255,255,255,.62);line-height:1.65;margin-bottom:24px;max-width:300px">Daily tithi, nakshatra & shubh muhurat — your sacred almanac.</p>
  <!-- TODAY LIVE DATA inline -->
  <?php if ($today): ?>
  <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:8px;max-width:380px">
    <?php foreach([
      ['Tithi',    $today['tithi'],        'ic-moon'],
      ['Nakshatra',$today['nakshatra'],     'ic-star'],
      ['Paksha',   $today['paksha'],        'ic-lotus'],
      ['Sunrise',  $today['sunrise_time'],  'ic-sun'],
    ] as [$k,$v,$ic]): ?>
    <div style="background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:12px;padding:10px 12px;display:flex;align-items:center;gap:9px">
      <svg width="16" height="16" fill="none" stroke="rgba(255,255,255,.7)" stroke-width="1.6" viewBox="0 0 24 24"><use href="#<?= $ic ?>"/></svg>
      <div>
        <div style="font-size:.56rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,.45)"><?= $k ?></div>
        <div style="font-size:.82rem;font-weight:700;color:#fff"><?= esc($v) ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>

<!-- WHATSAPP NUDGE -->
<div style="margin:0 16px;margin-top:-1px;background:linear-gradient(135deg,#FFF7E6,#FFFBEE);border:1px solid rgba(176,125,8,.2);border-radius:16px;padding:14px 16px;display:flex;align-items:center;gap:13px;transform:translateY(-16px)">
  <div style="width:40px;height:40px;border-radius:10px;background:#7A1E12;display:flex;align-items:center;justify-content:center;flex-shrink:0">
    <svg width="19" height="19" fill="none" stroke="#FBC04A" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-bell"/></svg>
  </div>
  <div style="flex:1">
    <div style="font-weight:700;font-size:.87rem;color:#7A1E12;margin-bottom:2px">Get daily Panchang on WhatsApp</div>
    <div style="font-size:.74rem;color:#8C5A28">Tithi · Vrat · Muhurat — every morning</div>
  </div>
  <a href="<?= base_url('subscribe?from=panchang') ?>" style="background:#7A1E12;color:#fff;font-size:.72rem;font-weight:700;padding:8px 12px;border-radius:9px;text-decoration:none;white-space:nowrap;flex-shrink:0">₹99/yr</a>
</div>

<!-- SUBCATEGORY CARDS -->
<div style="padding:0 16px 4px;margin-top:-4px">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
    <?php
    $scStyle = [
      ['#B85B08','ic-sun'],
      ['#A83410','ic-moon'],
      ['#B07D08','ic-star'],
      ['#1E7A3C','ic-lotus'],
    ];
    foreach ($subcats as $i => $sc):
      [$col,$ic] = $scStyle[$i % count($scStyle)];
    ?>
    <a href="<?= base_url($sc['href']) ?>"
       class="lotus-card reveal" style="background:#fff;border:1px solid #EDE5D8;border-radius:14px;padding:16px 14px;text-align:center;text-decoration:none">
      <span style="width:44px;height:44px;border-radius:50%;background:<?= $col ?>14;border:1px solid <?= $col ?>33;display:flex;align-items:center;justify-content:center;margin:0 auto 10px">
        <svg width="20" height="20" fill="none" stroke="<?= $col ?>" stroke-width="1.7" viewBox="0 0 24 24"><use href="#<?= $ic ?>"/></svg>
      </span>
      <p style="font-weight:700;font-size:.85rem;color:#130700"><?= esc($sc['label']) ?></p>
    </a>
    <?php endforeach; ?>
  </div>
</div>

<!-- VRAT CALENDAR -->
<?php if (!empty($upcoming)): ?>
<div style="padding:22px 16px 8px">
  <!-- header + filter chips -->
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.25rem;font-weight:700;color:#130700">Upcoming Vrats</h2>
    <a href="<?= base_url('panchang/vrat') ?>" style="font-size:.72rem;font-weight:700;color:#B07D08;text-decoration:none">View all →</a>
  </div>

  <!-- filter chips -->
  <div style="display:flex;gap:6px;margin-bottom:16px;overflow-x:auto;-webkit-overflow-scrolling:touch;padding-bottom:4px">
    <?php foreach(['All','Ekadashi','Pradosh','Purnima','Amavasya'] as $f): ?>
    <a href="<?= base_url('panchang/vrat?filter='.strtolower($f)) ?>"
       style="display:inline-block;flex-shrink:0;padding:6px 14px;border-radius:20px;font-size:.75rem;font-weight:600;text-decoration:none;
              <?= $f==='All'?'background:#5A4A08;color:#fff':'background:#fff;color:#6B4A28;border:1px solid #EDE5D8' ?>">
      <?= $f ?>
    </a>
    <?php endforeach; ?>
  </div>

  <!-- vrat list -->
  <div style="display:flex;flex-direction:column;gap:8px">
    <?php
    $colors = ['#B85B08','#A83410','#B07D08','#1E7A3C','#0A4A7A'];
    foreach ($upcoming as $i => $v):
      $ts   = strtotime($v['date']);
      $days = max(0,(int)ceil(($ts - time())/86400));
      $chip = $days === 0 ? 'Today' : ($days === 1 ? 'Tomorrow' : "In {$days} days");
      $soon = $days <= 3;
      $col  = $colors[$i % count($colors)];
    ?>
    <a href="<?= base_url('panchang/vrat/'.$v['slug']) ?>"
       class="lotus-card reveal" style="display:flex;align-items:center;gap:13px;background:#fff;border:1px solid #EDE5D8;border-radius:14px;padding:14px 16px;text-decoration:none">
      <!-- date block -->
      <div style="width:48px;height:48px;border-radius:12px;background:<?= $col ?>12;border:1px solid <?= $col ?>30;flex-shrink:0;display:flex;flex-direction:column;align-items:center;justify-content:center">
        <div style="font-size:.54rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:<?= $col ?>"><?= date('M',$ts) ?></div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:700;color:<?= $col ?>;line-height:1"><?= date('d',$ts) ?></div>
      </div>
      <div style="flex:1;min-width:0">
        <div style="font-weight:700;font-size:.9rem;color:#130700;margin-bottom:2px"><?= esc($v['vrat_name']) ?></div>
        <?php if(!empty($v['description'])): ?>
        <div style="font-size:.76rem;color:#6B4A28;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= esc($v['description']) ?></div>
        <?php endif; ?>
      </div>
      <!-- countdown chip -->
      <span style="flex-shrink:0;font-size:.68rem;font-weight:700;padding:4px 10px;border-radius:20px;
                   <?= $soon ? 'background:#FEF3C7;color:#B45309' : 'background:#F5F0EB;color:#9A7A58' ?>">
        <?= $chip ?>
      </span>
    </a>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<!-- DOWNLOAD CALENDAR CTA -->
<div style="margin:16px 16px 0">
  <a href="<?= base_url('panchang/download-calendar') ?>"
     class="lotus-card reveal" style="display:flex;align-items:center;justify-content:space-between;padding:18px 20px;background:linear-gradient(135deg,#FFF3E8,#FFFBEE);border:1px solid rgba(176,125,8,.25);border-radius:16px;text-decoration:none">
    <div style="display:flex;align-items:center;gap:13px">
      <div style="width:44px;height:44px;border-radius:12px;background:#B07D08;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 8px 20px rgba(176,125,8,.3)">
        <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24"><use href="#ic-download"/></svg>
      </div>
      <div>
        <div style="font-weight:700;font-size:.9rem;color:#130700;margin-bottom:2px">Download Full 2026 Calendar</div>
        <div style="font-size:.75rem;color:#8C5A28">All vrats, festivals & muhurat · PDF</div>
      </div>
    </div>
    <svg width="16" height="16" fill="none" stroke="#B07D08" stroke-width="2.2" viewBox="0 0 24 24"><use href="#ic-arrow"/></svg>
  </a>
</div>

<!-- TODAY'S FULL PANCHANG CARD -->
<?php if ($today): ?>
<div style="margin:14px 16px 28px;background:#fff;border:1px solid #EDE5D8;border-radius:20px;overflow:hidden">
  <div style="background:linear-gradient(135deg,#1A1A08,#3A3200);padding:14px 18px;display:flex;align-items:center;justify-content:space-between">
    <p style="font-size:.58rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,220,100,.6)">Today's Full Panchang</p>
    <p style="font-size:.78rem;font-weight:600;color:rgba(255,255,255,.7)"><?= date('l, d F Y') ?></p>
  </div>
  <div style="padding:16px;display:grid;grid-template-columns:1fr 1fr;gap:10px">
    <?php
    $pFields = [
      ['Tithi',     $today['tithi'],       '#B85B08'],
      ['Paksha',    $today['paksha'],      '#7A1E12'],
      ['Nakshatra', $today['nakshatra'],   '#B07D08'],
      ['Sunrise',   $today['sunrise_time'],'#1E7A3C'],
    ];
    if (!empty($today['yoga']))   $pFields[] = ['Yoga',   $today['yoga'],   '#3A1480'];
    if (!empty($today['karana'])) $pFields[] = ['Karana', $today['karana'],'#0A4A7A'];
    foreach ($pFields as [$k,$v,$col]): ?>
    <div style="background:#FDFCF9;border:1px solid #EDE5D8;border-radius:12px;padding:10px 12px">
      <div style="font-size:.56rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#9A7A58;margin-bottom:3px"><?= $k ?></div>
      <div style="font-size:.92rem;font-weight:700;color:#130700"><?= esc($v) ?></div>
      <div style="width:20px;height:2px;background:<?= $col ?>;border-radius:2px;margin-top:5px"></div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>
