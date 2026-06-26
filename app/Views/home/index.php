<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
/* ── Hero entrance ── */
.h-badge {animation:fadeUp .6s cubic-bezier(.22,1,.36,1) .1s both}
.h-h1    {animation:fadeUp .8s cubic-bezier(.22,1,.36,1) .22s both}
.h-sub   {animation:fadeUp .7s cubic-bezier(.22,1,.36,1) .38s both}
.h-btns  {animation:fadeUp .7s cubic-bezier(.22,1,.36,1) .52s both}
.h-stats {animation:fadeUp .7s cubic-bezier(.22,1,.36,1) .66s both}

/* ── Mandala spin ── */
.mandala-hero{animation:spinSlow 140s linear infinite;transform-origin:center center}

/* ── Floating petals ── */
.petal{position:absolute;border-radius:50%;animation:petal var(--dur) ease-in var(--del) infinite;pointer-events:none}

/* ── Off-card hover ── */
.off-card{transition:transform .35s cubic-bezier(.22,1,.36,1),box-shadow .35s cubic-bezier(.22,1,.36,1),border-color .25s}
.off-card:hover{transform:translateY(-6px);box-shadow:0 22px 60px rgba(196,146,10,.16)}

/* ── Guide row ── */
.guide-row{transition:background .2s,transform .22s,box-shadow .22s}
.guide-row:hover{background:var(--cream)!important;transform:translateX(5px);box-shadow:3px 0 0 0 var(--gold)}

/* ── Vrat card ── */
.vrat-card{transition:transform .32s cubic-bezier(.22,1,.36,1),box-shadow .3s,border-color .22s}
.vrat-card:hover{transform:translateY(-5px);box-shadow:0 18px 48px rgba(196,146,10,.14);border-color:var(--gold)}

/* ── Pair card ── */
.pair-card{transition:transform .38s cubic-bezier(.22,1,.36,1),box-shadow .38s,border-color .28s}
.pair-card:hover{transform:translateY(-6px);box-shadow:0 22px 60px rgba(196,146,10,.16);border-color:var(--gold)}

/* ── Gold gradient text ── */
.grad-text{background:linear-gradient(120deg,var(--saffron),var(--gold) 45%,var(--maroon));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-weight:700}

.btn-gold{
    background: #fbc04a;
    border-color: #fbc04a;
    color: #000;
    transition: all .3s ease;
}

.btn-gold:hover{
    background: #870000;
    border-color: #870000;
    color: #fff;
}

.btn-gold:focus,
.btn-gold:active{
    background: #870000;
    border-color: #870000;
    color: #fff;
}

</style>

<!-- ══════════════════════════════════════
     HERO — ivory, aged gold, centered
══════════════════════════════════════ -->
<section class="hero-sec" style="position:relative;overflow:hidden;padding:64px 24px;background:radial-gradient(120% 80% at 50% 0%,#FFF6E2 0%,#FBEBCB 45%,#F6DFB0 100%);text-align:center;display:flex;align-items:center">

  <!-- warm saffron floor glow -->
  <div style="position:absolute;left:50%;bottom:-120px;transform:translateX(-50%);width:760px;height:300px;background:radial-gradient(ellipse,rgba(184,91,8,.18) 0%,transparent 70%);pointer-events:none"></div>


  <!-- Soft decorative orbs -->
  <div style="position:absolute;top:-70px;left:-90px;width:420px;height:420px;background:radial-gradient(circle,rgba(196,146,10,.1) 0%,transparent 70%);pointer-events:none;animation:pulse 7s ease-in-out infinite"></div>
  <div style="position:absolute;bottom:-50px;right:-70px;width:380px;height:380px;background:radial-gradient(circle,rgba(212,114,10,.08) 0%,transparent 70%);pointer-events:none;animation:pulse 9s ease-in-out 2s infinite"></div>

  <!-- Om watermark -->
  <!-- Om centrepiece — behind the copy, fully contained (not clipped) -->
  <div class="om-mark" style="position:absolute;left:42%;top:50%;transform:translate(-50%,-50%);font-family:'Noto Serif Devanagari',serif;font-size:clamp(180px,20vw,260px);color:rgba(122,30,18,.10);pointer-events:none;line-height:1;animation:haloBreathe 5s ease-in-out infinite;z-index:1;user-select:none">ॐ</div>

  <!-- Rising aarti embers -->
  <?php for($i=0;$i<9;$i++):
    $left = 30 + ($i*5);
    $size = 3 + ($i%3);
  ?>
  <div style="position:absolute;left:<?= $left ?>%;bottom:18%;width:<?= $size ?>px;height:<?= $size ?>px;border-radius:50%;background:radial-gradient(circle,#FFE08A,#E08A1E);box-shadow:0 0 6px rgba(224,138,30,.6);pointer-events:none;--drift:<?= ($i%2?'':'-').(8+($i%4)*6) ?>px;animation:ember <?= 6 + ($i%4)*1.5 ?>s ease-out <?= $i*.7 ?>s infinite;z-index:1"></div>
  <?php endfor; ?>

  <!-- Floating petals -->
  <?php foreach([
    ['9px', '9px', 'rgba(196,146,10,.30)','15s','0s','15%'],
    ['7px', '7px', 'rgba(212,114,10,.28)','11s','3s','28%'],
    ['11px','11px','rgba(196,146,10,.24)','17s','6s','52%'],
    ['8px', '8px', 'rgba(200,160,16,.28)','12s','1.5s','66%'],
    ['9px', '9px', 'rgba(212,114,10,.24)','14s','4.5s','80%'],
    ['6px', '6px', 'rgba(196,146,10,.30)','10s','2s','42%'],
  ] as [$w,$h,$bg,$dur,$del,$left]): ?>
  <div class="petal" style="width:<?=$w?>;height:<?=$h?>;background:<?=$bg?>;left:<?=$left?>;bottom:14%;--dur:<?=$dur?>;--del:<?=$del?>"></div>
  <?php endforeach; ?>


  <div style="position:relative;z-index:2;width:100%;max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1fr;gap:48px;align-items:center" class="hero-grid">

    <!-- LEFT: copy, left-aligned -->
    <div style="text-align:center" class="hero-copy">
      <div class="h-badge" style="display:inline-flex;align-items:center;gap:9px;background:#870000;border-radius:50px;padding:8px 22px 8px 14px;margin-bottom:22px;box-shadow:0 6px 20px rgba(122,30,18,.25)">
        <span style="width:7px;height:7px;border-radius:50%;background:#FBC04A;animation:pulse 2.4s ease-in-out infinite;display:inline-block"></span>
        <span style="font-size:.7rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#FFE8C2">India's Sacred Ritual Platform</span>
      </div>

      <h1 class="h-h1 f-display" style="font-size:clamp(2.5rem,5vw,4.25rem);color:var(--ink);margin-bottom:18px;line-height:1.04;font-weight:700">
        Where Ancient <span class="grad-text" style="font-style:italic">Ritual</span> Meets Modern Life
      </h1>

      <p class="h-sub" style="font-size:1.1875rem;line-height:1.7;color:var(--ink2);max-width:480px;margin:0 auto 30px;font-family:'Cormorant Garamond',serif;font-weight:600">
        Expert-guided pujas, authentic ritual guides, and daily panchang — your complete sacred companion.
      </p>

      <div class="h-btns" style="display:flex;flex-wrap:wrap;gap:14px;justify-content:center;margin-bottom:38px">
        <a href="<?= base_url('purohit-puja') ?>" class="btn btn-gold" style="padding:15px 34px">Book a Purohit <svg width="15" height="15"><use href="#ic-arrow"/></svg></a>
        <a href="<?= base_url('ritual-guides') ?>" class="btn btn-outline" style="padding:13px 32px">Explore Guides</a>
      </div>

      <!-- inline stats with dividers -->
      <div class="h-stats" style="display:inline-flex;flex-wrap:wrap;align-items:center;gap:0;padding:18px 28px;background:rgba(255,255,255,.55);border:1px solid var(--line);border-radius:14px;backdrop-filter:blur(6px)">
        <?php foreach([['500+','Ritual guides'],['50+','Verified pandits'],['₹99','Per year']] as $si => [$n,$l]): ?>
        <?php if($si): ?><span class="stat-div" style="width:1px;height:28px;background:var(--line);margin:0 14px"></span><?php endif; ?>
        <div style="text-align:center">
          <div class="f-serif stat-num" style="font-size:1.875rem;font-weight:700;line-height:1;color:var(--gold2)" data-target="<?= $n ?>"><?= $n ?></div>
          <div style="font-size:.66rem;color:var(--muted);margin-top:5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase"><?= $l ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- RIGHT: shrine visual card -->
    <div class="hero-visual" style="position:relative;display:none">
      <a href="<?= base_url('panchang') ?>" class="shrine-card" style="position:relative;border-radius:28px;background:linear-gradient(160deg,#FFFaf0,#F3E4C2);border:1px solid var(--line);box-shadow:0 30px 80px rgba(122,30,18,.14);padding:56px 40px 64px;overflow:hidden;min-height:430px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-decoration:none;transition:transform .3s cubic-bezier(.22,1,.36,1),box-shadow .3s">
        <!-- view-muhurat hint -->
        <span class="shrine-hint" style="position:absolute;top:18px;left:22px;font-size:.62rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:var(--maroon);opacity:.55;display:flex;align-items:center;gap:5px">View Panchang <svg width="11" height="11" stroke-width="2.4"><use href="#ic-arrow"/></svg></span>
        <!-- static fine sun-rays (no rotation) -->
        <svg style="position:absolute;left:50%;top:42%;transform:translate(-50%,-50%);width:340px;height:340px;opacity:.14;pointer-events:none" viewBox="0 0 400 400" fill="none">
          <?php for($i=0;$i<48;$i++): ?><line x1="200" y1="200" x2="200" y2="6" stroke="#B07D08" stroke-width="<?= $i%2?'1.4':'.6' ?>" transform="rotate(<?=$i*7.5?> 200 200)"/><?php endfor; ?>
        </svg>
        <!-- pulsing aura rings (visible, calm) -->
        <?php foreach([0,1.3,2.6] as $d): ?>
        <div style="position:absolute;left:50%;top:42%;width:200px;height:200px;border-radius:50%;border:1.5px solid rgba(184,91,8,.5);animation:ripple 3.9s ease-out <?= $d ?>s infinite;pointer-events:none"></div>
        <?php endforeach; ?>
        <!-- detailed brass diya + halo -->
        <div style="position:relative;width:150px;height:150px;margin-bottom:16px">
          <div style="position:absolute;left:50%;top:40%;transform:translate(-50%,-50%);width:170px;height:170px;border-radius:50%;background:radial-gradient(circle,rgba(255,205,100,.6) 0%,rgba(224,138,30,.2) 42%,transparent 72%);animation:haloBreathe 3s ease-in-out infinite"></div>
          <?= $this->include('home/_diya') ?>
        </div>
        <p class="f-eye" style="margin-bottom:8px;position:relative">Aaj Ka Muhurat</p>
        <p class="f-serif" style="font-size:1.5rem;font-weight:700;color:var(--ink);text-align:center;line-height:1.25;max-width:240px;position:relative">Begin your puja at the<br>auspicious hour</p>
      </a>

      <!-- clean aligned info-card row (below shrine, not floating) -->
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:14px">
        <?php if(!empty($panchang)): ?>
        <a href="<?= base_url('panchang') ?>" class="float-chip" style="background:#fff;border:1px solid var(--line);border-radius:16px;box-shadow:0 10px 26px rgba(122,30,18,.10);padding:14px 16px;display:flex;align-items:center;gap:12px;text-decoration:none;transition:transform .22s,box-shadow .22s">
          <div style="width:40px;height:40px;border-radius:11px;background:var(--maroon);display:flex;align-items:center;justify-content:center;flex-shrink:0"><svg width="18" height="18" fill="none" stroke="#FBC04A" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-cal"/></svg></div>
          <div style="text-align:left;min-width:0">
            <div style="font-size:.58rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--faint)">Today's Tithi</div>
            <div style="font-size:.95rem;font-weight:700;color:var(--ink);line-height:1.2"><?= esc($panchang['tithi']) ?></div>
          </div>
        </a>
        <?php endif; ?>
        <a href="<?= base_url('purohit-puja') ?>" class="float-chip" style="background:#fff;border:1px solid var(--line);border-radius:16px;box-shadow:0 10px 26px rgba(122,30,18,.10);padding:14px 16px;display:flex;align-items:center;gap:12px;text-decoration:none;transition:transform .22s,box-shadow .22s">
          <div style="width:40px;height:40px;border-radius:50%;background:#1E7A3C;display:flex;align-items:center;justify-content:center;flex-shrink:0"><svg width="18" height="18" fill="none" stroke="#fff" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div style="text-align:left;min-width:0">
            <div style="font-size:.95rem;font-weight:700;color:var(--ink);line-height:1.15">50+ Pandits</div>
            <div style="font-size:.6rem;font-weight:600;color:var(--faint)">Verified & trusted</div>
          </div>
        </a>
      </div>
    </div>

  </div>
</section>
<style>
@media(min-width:960px){
  .hero-grid{grid-template-columns:1.05fr .95fr!important;gap:56px!important}
  .hero-copy{text-align:left!important}
  .hero-copy .h-h1,.hero-copy .h-sub{margin-left:0!important}
  .hero-copy .h-sub{margin-right:auto}
  .hero-copy .h-btns{justify-content:flex-start!important}
  .hero-visual{display:block!important}
}
</style>

<!-- ══════════════════════════════════════
     PANCHANG STRIP
══════════════════════════════════════ -->
<?php if(!empty($panchang)): ?>
<div style="background:var(--maroon);padding:13px 0">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:8px 30px">
    <span style="font-size:.66rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;color:#FBC04A;flex-shrink:0">Aaj Ka Panchang</span>
    <?php foreach([['Tithi',$panchang['tithi']],['Paksha',$panchang['paksha']],['Nakshatra',$panchang['nakshatra']],['Sunrise',$panchang['sunrise_time']??'']] as [$k,$v]): ?>
    <div style="display:flex;align-items:baseline;gap:6px">
      <span style="font-size:.62rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,232,194,.55)"><?= $k ?></span>
      <span style="font-size:.875rem;font-weight:600;color:#FFF3E2"><?= esc($v) ?></span>
    </div>
    <?php endforeach; ?>
    <a href="<?= base_url('panchang') ?>" style="font-size:.74rem;font-weight:800;letter-spacing:.04em;text-transform:uppercase;color:#FBC04A">Full Panchang →</a>
  </div>
</div>
<?php endif; ?>

<!-- ══════════════════════════════════════
     OFFERINGS — 4 cards, centered
══════════════════════════════════════ -->
<section style="padding:76px 24px">
  <div style="max-width:1280px;margin:0 auto">

    <!-- left-aligned section header with link on right -->
    <div data-sr style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:34px">
      <div style="text-align:left">
        <p class="f-eye" style="margin-bottom:10px">Sacred Offerings</p>
        <h2 class="f-head" style="font-size:clamp(1.875rem,3.4vw,2.75rem);color:var(--ink)">Everything for your puja,<br>in one sacred place</h2>
      </div>
      <a href="<?= base_url('purohit-puja') ?>" class="btn-ghost" style="padding-bottom:8px">Browse all offerings →</a>
    </div>

    <!-- BENTO grid -->
    <div class="bento" data-sr>

      <!-- Featured large tile -->
      <a href="<?= base_url('purohit-puja') ?>" class="off-card bento-feat" style="position:relative;overflow:hidden;display:flex;flex-direction:column;justify-content:flex-end;gap:14px;padding:36px;background:linear-gradient(150deg,#7A1E12 0%,#A83410 60%,#B85B08 100%);border:1px solid #7A1E12;border-radius:18px;text-decoration:none;min-height:300px">
        <svg style="position:absolute;right:-40px;top:-40px;width:280px;height:280px;opacity:.14" viewBox="0 0 400 400" fill="none"><?php for($i=0;$i<24;$i++): ?><line x1="200" y1="200" x2="200" y2="20" stroke="#FFE8C2" stroke-width="1" transform="rotate(<?=$i*15?> 200 200)"/><?php endfor; ?><?php foreach([60,120,180] as $r): ?><circle cx="200" cy="200" r="<?=$r?>" stroke="#FFE8C2" stroke-width="1"/><?php endforeach; ?></svg>
        <div style="position:relative">
          <span class="tag" style="background:rgba(255,232,194,.18);color:#FFE8C2;border:1px solid rgba(255,232,194,.3);margin-bottom:16px">Most Booked</span>
          <h3 class="f-serif" style="font-size:1.875rem;font-weight:700;color:#fff;margin-bottom:10px">Purohit & Puja at Home</h3>
          <p style="font-size:.95rem;line-height:1.7;color:rgba(255,240,224,.8);max-width:380px">Book a verified pandit for Rudrabhishek, Satyanarayan, Griha Pravesh and more — we bring all the samagri.</p>
          <div style="display:flex;align-items:center;gap:14px;margin-top:20px">
            <span style="display:inline-flex;align-items:center;gap:7px;background:#fbc04a;color:var(--maroon);font-size:.8rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;padding:11px 22px;border-radius:6px">Book now <svg width="13" height="13" stroke-width="2.2"><use href="#ic-arrow"/></svg></span>
            <span style="color:#FFE8C2;font-size:.9rem;font-weight:600">From ₹7,100</span>
          </div>
        </div>
      </a>

      <?php foreach([
        ['ritual-guides', 'Ritual Guides',   'Step-by-step vidhi, mantras & samagri for every puja.', '#FFF3E8','#870000','tag-gold', 'Free',       'ic-book',  'b-a'],
        ['panchang',      'Panchang',        'Daily tithi, nakshatra & shubh muhurat.',               '#FFFBEE','#870000','tag-peach','Live',       'ic-cal',   'b-b'],
        ['bhajan-mandali','Bhajan Mandali',  'Live sacred music for weddings, namkaran & Navratri occasions.','#F0F6EE','#870000','tag-sage','On Request','ic-music','b-c'],
      ] as $i => [$sl,$ti,$de,$bg,$ac,$tg,$pr,$ic,$area]): ?>
      <a href="<?= base_url($sl) ?>" class="off-card <?=$area?>" style="position:relative;display:flex;flex-direction:column;gap:12px;padding:26px;background:<?=$bg?>;border:1px solid var(--line);border-radius:18px;text-decoration:none">
        <div style="display:flex;align-items:center;justify-content:space-between">
          <div style="width:46px;height:46px;border-radius:12px;background:<?=$ac?>;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 20px <?=$ac?>33"><svg width="20" height="20" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24"><use href="#<?=$ic?>"/></svg></div>
          <span class="tag <?=$tg?>"><?= $pr ?></span>
        </div>
        <h3 class="f-serif" style="font-size:1.25rem;font-weight:700;color:var(--ink);margin-top:4px"><?= $ti ?></h3>
        <p class="f-small" style="line-height:1.65;flex:1"><?= $de ?></p>
        <span style="font-size:.7rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:<?=$ac?>">Explore →</span>
      </a>
      <?php endforeach; ?>

    </div>
  </div>
</section>
<style>
.bento{display:grid;grid-template-columns:1fr;gap:18px}
@media(min-width:680px){.bento{grid-template-columns:1fr 1fr}.bento-feat{grid-column:1/3}}
@media(min-width:1000px){
  .bento{grid-template-columns:repeat(3,1fr);grid-auto-rows:1fr}
  .bento-feat{grid-column:1/2;grid-row:1/3}
  .b-a{grid-column:2/3;grid-row:1}
  .b-b{grid-column:3/4;grid-row:1}
  .b-c{grid-column:2/4;grid-row:2}
}
</style>

<!-- ══════════════════════════════════════
     HOW IT WORKS — centered
══════════════════════════════════════ -->
<section style="background:linear-gradient(135deg,#FAF2E2 0%,#FFF3E8 100%);padding:72px 24px;border-top:1px solid var(--line);border-bottom:1px solid var(--line);text-align:center">
  <div style="max-width:1280px;margin:0 auto">

    <div data-sr style="margin-bottom:40px">
      <p class="f-eye" style="margin-bottom:12px">How It Works</p>
      <h2 class="f-head" style="font-size:clamp(1.875rem,3.2vw,2.5rem);color:var(--ink)">Puja made beautifully simple</h2>
      <div class="flourish"><i></i></div>
    </div>

    <div style="display:grid;grid-template-columns:1fr;gap:24px" class="steps-grid">
      <?php foreach([
        ['01','Choose Your Puja',     'Browse from Rudrabhishek, Satyanarayan, Navratri and more. Select your pandit, date and time.','#870000','ic-book'],
        ['02','We Handle Everything', 'Your pandit arrives with all samagri. No running around — just prepare your heart and space.','#870000','ic-flame'],
        ['03','Sacred Experience',    'Every step of the vidhi explained as you go. Your home becomes a temple for the day.','#870000','ic-star'],
      ] as $i => [$num,$h,$b,$c,$ic]): ?>
      <div class="step-card" data-sr data-d="<?=$i+1?>" style="position:relative;padding:40px 30px 36px;background:#fff;border-radius:16px;border:1px solid var(--line);text-align:center;overflow:hidden;transition:box-shadow .3s,border-color .3s,transform .3s" onmouseover="this.style.borderColor='<?=$c?>';this.style.boxShadow='0 18px 48px rgba(176,125,8,.14)';this.style.transform='translateY(-5px)'" onmouseout="this.style.borderColor='var(--line)';this.style.boxShadow='none';this.style.transform='none'">
        <!-- top accent bar -->
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,transparent,<?=$c?>,transparent)"></div>
        <!-- watermark number -->
        <div class="f-serif" style="position:absolute;top:6px;right:16px;font-size:4.5rem;font-weight:700;font-style:italic;color:<?=$c?>;opacity:.08;line-height:1;pointer-events:none"><?= $num ?></div>
        <!-- icon medallion -->
        <div style="width:64px;height:64px;border-radius:50%;background:<?=$c?>14;border:1.5px solid <?=$c?>40;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;position:relative">
          <svg width="26" height="26" fill="none" stroke="<?=$c?>" stroke-width="1.6" viewBox="0 0 24 24"><use href="#<?=$ic?>"/></svg>
          <span style="position:absolute;-bottom:6px;bottom:-8px;left:50%;transform:translateX(-50%);background:<?=$c?>;color:#fff;font-size:.6rem;font-weight:800;letter-spacing:.05em;padding:2px 9px;border-radius:20px"><?= $num ?></span>
        </div>
        <h3 class="f-serif" style="font-size:1.3125rem;font-weight:700;color:var(--ink);margin-bottom:10px"><?= $h ?></h3>
        <div style="width:28px;height:2px;background:<?=$c?>;opacity:.4;margin:0 auto 14px;border-radius:2px"></div>
        <p class="f-small" style="line-height:1.75"><?= $b ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <div data-sr style="margin-top:44px">
      <a href="<?= base_url('purohit-puja') ?>" class="btn btn-gold">View all pujas <svg width="14" height="14"><use href="#ic-arrow"/></svg></a>
    </div>
  </div>
</section>
<style>@media(min-width:768px){.steps-grid{grid-template-columns:repeat(3,1fr)!important}}</style>

<!-- ══════════════════════════════════════
     RITUAL GUIDES — centered list
══════════════════════════════════════ -->
<section style="padding:64px 24px 0;background:linear-gradient(135deg,#FAF2E2,#FFF3E8);border-top:1px solid var(--line)">
  <div style="max-width:1280px;margin:0 auto;display:grid;grid-template-columns:1fr;gap:40px" class="gv-grid">

    <div data-sr>
      <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:12px;margin-bottom:20px">
        <div style="text-align:left"><p class="f-eye" style="margin-bottom:6px">Ritual Guides</p><h2 class="f-head" style="font-size:1.625rem;color:var(--ink)">Popular this season</h2></div>
        <a href="<?= base_url('ritual-guides') ?>" class="btn-ghost" style="white-space:nowrap">All →</a>
      </div>
    <div style="border-radius:14px;overflow:hidden;border:1px solid var(--line);background:#fff;box-shadow:0 8px 30px rgba(122,30,18,.06)">
      <?php foreach([
        ['Rudrabhishek Puja',  'Complete bathing of the Shiva Linga with Panchamrit while chanting Shri Rudram.', 'rudrabhishek-guide','Shaivism','#C4920A'],
        ['Satyanarayan Katha', 'Performed on Purnima for peace, prosperity and fulfilment of wishes.',             'satyanarayan-guide','Vaishnava','#C86878'],
        ['Surya Puja',         'Offer water at sunrise every Sunday for health, vitality and clarity.',            'surya-puja-guide',  'Navagraha','#C8A010'],
        ['Lakshmi Puja Vidhi', 'Invite Goddess Lakshmi on Fridays and Diwali for abundance and grace.',           'lakshmi-puja-guide','Shakti',   '#5E8C4E'],
      ] as $i => [$t,$d,$sl,$cat,$col]): ?>
      <a href="<?= base_url('ritual-guides/'.$sl) ?>"
         class="guide-row" data-sr data-d="<?=$i+1?>"
         style="display:flex;align-items:center;gap:20px;padding:22px 28px;background:#fff;text-decoration:none;border-bottom:<?=$i<3?'1px solid var(--line)':'none'?>;text-align:left">
        <div style="width:42px;height:42px;border-radius:50%;background:<?=$col?>14;border:1px solid <?=$col?>30;display:flex;align-items:center;justify-content:center;flex-shrink:0">
          <span class="f-serif" style="font-size:.95rem;font-weight:700;color:<?=$col?>"><?= str_pad($i+1,2,'0',STR_PAD_LEFT) ?></span>
        </div>
        <div style="flex:1;min-width:0">
          <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:4px">
            <h3 class="f-serif" style="font-weight:700;color:var(--ink);font-size:1.0625rem"><?= $t ?></h3>
            <span class="tag" style="background:<?=$col?>14;color:<?=$col?>;border:1px solid <?=$col?>30"><?= $cat ?></span>
          </div>
          <p class="f-cap" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:480px"><?= $d ?></p>
        </div>
        <svg width="14" height="14" style="color:var(--faint);flex-shrink:0;transition:transform .2s,color .2s" class="guide-chev"><use href="#ic-chevr"/></svg>
      </a>
      <?php endforeach; ?>
    </div>

    </div>

    <div data-sr>
      <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:12px;margin-bottom:20px">
        <div style="text-align:left"><p class="f-eye" style="margin-bottom:6px">Sacred Calendar</p><h2 class="f-head" style="font-size:1.625rem;color:var(--ink)">Upcoming Vrats</h2></div>
        <a href="<?= base_url('panchang/vrat') ?>" class="btn-ghost" style="white-space:nowrap">All →</a>
      </div>
      <div style="display:flex;flex-direction:column;gap:12px" class="vrat-g">
      <?php
      $vm = new \App\Models\VratModel();
      foreach($vm->getUpcoming(4) as $i => $v):
        $ts = strtotime($v['date']);
        $days = max(0,(int)ceil(($ts-time())/86400));
        $soon = $days <= 3;
        $colors = ['#C4920A','#C86878','#C8A010','#5E8C4E'];
        $col = $colors[$i % count($colors)];
      ?>
      <a href="<?= base_url('panchang/vrat/'.$v['slug']) ?>"
         class="vrat-card" data-sr data-d="<?=$i+1?>"
         style="display:flex;align-items:center;gap:20px;padding:22px 24px;background:#fff;text-decoration:none;border-radius:14px;border:1px solid var(--line);text-align:left">
        <!-- Coloured date block -->
        <div style="width:60px;height:60px;border-radius:12px;background:<?=$col?>12;border:1px solid <?=$col?>30;flex-shrink:0;display:flex;flex-direction:column;align-items:center;justify-content:center">
          <div style="font-size:.55rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;color:<?=$col?>"><?= date('M',$ts) ?></div>
          <div class="f-serif" style="font-size:1.625rem;font-weight:700;color:<?=$col?>;line-height:1"><?= date('d',$ts) ?></div>
        </div>
        <div style="flex:1">
          <p class="f-serif" style="font-weight:700;font-size:1.0625rem;color:var(--ink)"><?= esc($v['vrat_name']) ?></p>
          <p style="font-size:.78rem;color:<?= $soon?'var(--gold)':'var(--muted)' ?>;margin-top:3px;font-weight:<?= $soon?'700':'500' ?>">
            <?= $days===0?'Today':($days===1?'Tomorrow':'in '.$days.' days') ?>
          </p>
        </div>
        <svg width="14" height="14" style="color:var(--faint);flex-shrink:0"><use href="#ic-chevr"/></svg>
      </a>
      <?php endforeach; ?>
    </div>

    </div>
    </div>

  </div>
</section>
<style>@media(min-width:900px){.gv-grid{grid-template-columns:1.05fr .95fr!important;gap:48px!important}}</style>

<!-- ══════════════════════════════════════
     SUBSCRIBE CTA — compact maroon band
══════════════════════════════════════ -->
<section style="padding:44px 0 0;background:linear-gradient(background: linear-gradient(
160deg,
#FFFDF8 0%,
#FFF3E0 45%,
#FFE0B2 100%
);)">
  <div data-sr style="max-width:1180px;margin:0 auto;position:relative;overflow:hidden;border-radius:24px;background:linear-gradient(135deg,#7A1E12 0%,#A83410 55%,#B85B08 100%);box-shadow:0 26px 70px rgba(122,30,18,.28);margin-bottom:0">
    <!-- mandala accent -->
    <svg style="position:absolute;right:-60px;top:50%;transform:translateY(-50%);width:340px;height:340px;opacity:.13;animation:spinSlow 110s linear infinite" viewBox="0 0 400 400" fill="none"><?php for($i=0;$i<30;$i++): ?><line x1="200" y1="200" x2="200" y2="20" stroke="#FFE8C2" stroke-width="1" transform="rotate(<?=$i*12?> 200 200)"/><?php endfor; ?><?php foreach([70,130,190] as $r): ?><circle cx="200" cy="200" r="<?=$r?>" stroke="#FFE8C2" stroke-width="1"/><?php endforeach; ?></svg>

    <div style="position:relative;display:grid;grid-template-columns:1fr;gap:28px;align-items:center;padding:44px 40px" class="cta-grid">
      <div style="text-align:center" class="cta-copy">
        <p style="font-size:.7rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#FBC04A;margin-bottom:12px">WhatsApp Subscription</p>
        <h2 class="f-head" style="font-size:clamp(1.875rem,3.4vw,2.75rem);color:#fff;line-height:1.1;margin-bottom:12px">Sacred wisdom, <span style="font-style:italic;color:#FFE8C2">every morning</span></h2>
        <p style="font-size:1rem;color:rgba(255,240,224,.82);line-height:1.6;max-width:440px;margin:0 auto;font-family:'Cormorant Garamond',serif;font-weight:600">Daily tithi, vrat reminders & puja guides — straight to your WhatsApp.</p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:8px;margin-top:18px">
          <?php foreach(['Daily Panchang','Vrat Reminders','Ritual Guides','Member Offers'] as $f): ?>
          <span style="display:inline-flex;align-items:center;gap:7px;padding:7px 14px;background:rgba(255,232,194,.12);border:1px solid rgba(255,232,194,.25);border-radius:50px;font-size:.76rem;font-weight:600;color:#FFE8C2"><span style="width:5px;height:5px;border-radius:50%;background:#FBC04A"></span><?= $f ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <div style="text-align:center" class="cta-action">
        <div style="display:inline-flex;align-items:baseline;gap:8px;margin-bottom:16px">
          <span class="f-serif" style="font-size:2.75rem;font-weight:700;color:#fff">₹99</span>
          <span style="font-size:.85rem;color:rgba(255,240,224,.8)">/year · just ₹8/mo</span>
        </div><br>
        <a href="<?= base_url('subscribe') ?>" style="display:inline-flex;align-items:center;gap:9px;background:#fbc04a;color:var(--maroon);font-size:.8rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;padding:15px 34px;border-radius:8px;text-decoration:none;box-shadow:0 10px 28px rgba(0,0,0,.18);transition:transform .2s" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='none'">Subscribe Now <svg width="14" height="14" stroke-width="2.2"><use href="#ic-arrow"/></svg></a>
      </div>
    </div>
  </div>
</section>
<style>@media(min-width:820px){.cta-grid{grid-template-columns:1.5fr 1fr!important;gap:40px!important;padding:48px 52px!important}.cta-copy{text-align:left!important}.cta-copy p,.cta-copy h2{margin-left:0!important}.cta-copy>div{justify-content:flex-start!important}.cta-action{text-align:right!important;border-left:1px solid rgba(255,232,194,.2);padding-left:40px}}
section:last-of-type{margin-bottom:0!important}</style>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
// ── Stat counter ──
(function(){
  const nums = document.querySelectorAll('.stat-num');
  if(!nums.length) return;
  const obs = new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(!e.isIntersecting) return;
      const el = e.target;
      const raw = el.dataset.target || el.textContent;
      const prefix = raw.match(/^[^\d]*/)?.[0] || '';
      const suffix = raw.match(/[^\d]+$/)?.[0] || '';
      const num = parseFloat(raw.replace(/[^\d.]/g,''));
      if(isNaN(num)){obs.unobserve(el);return}
      const start = performance.now(), dur = 1600;
      const tick = now=>{
        const p = Math.min((now-start)/dur,1);
        const ease = 1-Math.pow(1-p,3);
        el.textContent = prefix+Math.floor(ease*num)+(p===1?suffix:'+');
        if(p<1) requestAnimationFrame(tick);
        else el.textContent = prefix+num+suffix;
      };
      requestAnimationFrame(tick);
      obs.unobserve(el);
    });
  },{threshold:.4});
  nums.forEach(el=>obs.observe(el));
})();

// ── Guide chevron hover ──
document.querySelectorAll('.guide-row').forEach(r=>{
  const ch = r.querySelector('.guide-chev');
  r.addEventListener('mouseenter',()=>{if(ch){ch.style.transform='translateX(4px)';ch.style.color='var(--gold)'}});
  r.addEventListener('mouseleave',()=>{if(ch){ch.style.transform='';ch.style.color='var(--faint)'}});
});
</script>
<?= $this->endSection() ?>
