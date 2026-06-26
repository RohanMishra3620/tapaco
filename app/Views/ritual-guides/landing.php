<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- HERO -->
<div class="cat-ritual" style="padding:44px 24px 36px">
  <p style="font-size:.6rem;font-weight:800;letter-spacing:.22em;text-transform:uppercase;color:#fbc04;margin-bottom:10px">Sacred Texts</p>
  <h1 style="font-family:'Cormorant Garamond',serif;font-size:2.4rem;font-weight:700;color:#fbc04a;line-height:1.05;margin-bottom:10px">Ritual Guides</h1>
  <p style="font-size:.92rem;color:#fbc04a;line-height:1.65;margin-bottom:22px;max-width:300px">Step-by-step vidhi for every puja. Written by Vedic scholars. Free to read, forever.</p>
  <!-- Mini search bar -->
  <div style="position:relative;max-width:360px">
    <svg style="position:absolute;left:13px;top:50%;transform:translateY(-50%)" width="16" height="16" fill="none" stroke="rgba(0,0,0,.4)" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35" stroke-linecap="round"/></svg>
    <input type="text" placeholder="Search puja or festival…" onclick="window.location='<?= base_url('search') ?>'"
      style="width:100%;padding:13px 16px 13px 40px;border-radius:10px;border:none;font-size:.88rem;background:#fbc04a;color:#130700;outline:none;cursor:pointer;box-sizing:border-box">
  </div>
</div>

<!-- STATS BAR -->
<div style="display:grid;grid-template-columns:repeat(3,1fr);background:#fff;border-bottom:1px solid #EDE5D8">
  <?php foreach([['50+','Ritual guides'],['Hindi &amp; EN','Languages'],['Free','Always']] as $i=>[$n,$l]): ?>
  <div style="padding:15px 8px;text-align:center;<?= $i<2?'border-right:1px solid #EDE5D8':'' ?>">
    <div style="font-family:'Cormorant Garamond',serif;font-size:1.4rem;font-weight:700;color:#1C5228"><?= $n ?></div>
    <div style="font-size:.6rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:#9A7A58;margin-top:2px"><?= $l ?></div>
  </div>
  <?php endforeach; ?>
</div>

<!-- CATEGORY FILTER TABS -->
<div style="display:flex;gap:0;border-bottom:1px solid #EDE5D8;background:#fff;overflow-x:auto;-webkit-overflow-scrolling:touch;position:sticky;top:62px;z-index:20">
  <?php foreach ($tabs as $tab): ?>
  <a href="<?= base_url('ritual-guides?sub='.$tab['slug']) ?>"
     style="flex-shrink:0;padding:14px 18px;font-size:.82rem;font-weight:600;white-space:nowrap;text-decoration:none;transition:all .18s;<?= $active===$tab['slug']?'color:#1C5228;border-bottom:2px solid #1C5228;margin-bottom:-1px':'color:#9A7A58' ?>">
    <?= $tab['label'] ?>
  </a>
  <?php endforeach; ?>
</div>

<!-- GUIDE LIST -->
<div style="padding:20px 16px 8px">
  <div class="card-grid">
    <?php if(empty($guides)): ?>
    <div style="text-align:center;padding:56px 20px;color:#9A7A58;grid-column:1/-1">
      <svg style="margin:0 auto 10px;display:block" width="36" height="36" fill="none" stroke="#2E6E38" stroke-width="1.4" viewBox="0 0 24 24"><use href="#ic-book"/></svg>
      <p style="font-size:.9rem">Guides coming soon for this category</p>
    </div>
    <?php else: ?>
    <?php foreach ($guides as $guide): ?>
    <a href="<?= base_url('ritual-guides/'.$guide['slug']) ?>" class="lotus-card reveal"
       style="display:flex;align-items:center;gap:14px;background:#fff;border:1px solid #EDE5D8;border-radius:16px;padding:16px;text-decoration:none">
      <div style="width:48px;height:48px;border-radius:13px;background:rgba(28,82,40,.07);display:flex;align-items:center;justify-content:center;flex-shrink:0;position:relative">
        <svg width="22" height="22" fill="none" stroke="#1C5228" stroke-width="1.7" viewBox="0 0 24 24"><use href="#ic-book"/></svg>
        <?php if($guide['audio_url']): ?>
        <span style="position:absolute;bottom:-3px;right:-3px;width:16px;height:16px;border-radius:50%;background:#1C5228;display:flex;align-items:center;justify-content:center">
          <svg width="8" height="8" fill="#fff" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
        </span>
        <?php endif; ?>
      </div>
      <div style="flex:1;min-width:0">
        <div style="display:flex;align-items:center;gap:6px;margin-bottom:3px;flex-wrap:wrap">
          <div style="font-weight:700;font-size:.9rem;color:#130700"><?= esc($guide['title']) ?></div>
          <?php if($guide['tag']): ?>
          <span style="font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;background:#ECFDF5;color:#1C5228;padding:2px 7px;border-radius:10px;flex-shrink:0"><?= esc($guide['tag']) ?></span>
          <?php endif; ?>
        </div>
        <div style="display:flex;align-items:center;gap:10px;font-size:.72rem;color:#9A7A58">
          <?php if($guide['audio_url']): ?><span style="display:flex;align-items:center;gap:3px"><svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><use href="#ic-music"/></svg> Audio</span><?php endif; ?>
          <span><?= $guide['confidence_score'] ?>% accurate</span>
          <?php if($guide['source']): ?><span>· <?= esc($guide['source']) ?></span><?php endif; ?>
        </div>
      </div>
      <svg width="15" height="15" fill="none" stroke="#C8A47A" stroke-width="2.2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6" stroke-linecap="round"/></svg>
    </a>
    <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<!-- DID YOU KNOW -->
<div style="margin:16px 16px 0;padding:20px;background:#F0FDF4;border:1px solid #BBF7D0;border-radius:18px">
  <p style="font-size:.58rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#1C5228;margin-bottom:12px">Did You Know?</p>
  <div style="display:flex;flex-direction:column;gap:10px">
    <?php foreach([
      'Every ritual guide is written &amp; verified by a Vedic scholar with 10+ years experience',
      'Guides are available in Hindi and English for ease of understanding',
      'Each guide includes a samagri checklist you can download or share on WhatsApp',
    ] as $fact): ?>
    <div style="display:flex;gap:10px;align-items:flex-start">
      <span style="color:#1C5228;font-size:1rem;flex-shrink:0;margin-top:-1px">✓</span>
      <span style="font-size:.82rem;color:#065F46;line-height:1.5"><?= $fact ?></span>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- SUBSCRIBE NUDGE -->
 <div style="margin:14px 16px 0;padding:22px;background:linear-gradient(15deg,#a00000 20%,#870000 80%);border-radius:20px">
  <p style="font-size:.58rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-bottom:8px">Never Miss a Vrat</p>
  <p style="font-family:'Cormorant Garamond',serif;font-size:1.4rem;font-weight:700;color:#fbc04a;line-height:1.2;margin-bottom:6px">Get ritual reminders on WhatsApp</p>
  <p style="font-size:.8rem;color:rgba(255,255,255,.6);margin-bottom:16px">Upcoming vrats, festival vidhi &amp; puja tips — every morning</p>
  <a href="<?= base_url('subscribe?from=ritual-guides') ?>" style="display:inline-flex;align-items:center;gap:7px;background:#fbc04a;;color:#1C5228;font-size:.8rem;font-weight:800;padding:12px 20px;border-radius:10px;text-decoration:none">
    Subscribe ₹99/year <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><use href="#ic-arrow"/></svg>
  </a>
</div>

<!-- BOOK A PANDIT -->
<div style="margin:14px 16px 28px;padding:16px 18px;background:#FFF9F0;border:1px solid #EDE0C8;border-radius:16px;display:flex;align-items:center;gap:14px">
  <div style="width:42px;height:42px;border-radius:11px;background:#7A1E12;display:flex;align-items:center;justify-content:center;flex-shrink:0">
    <svg width="21" height="21" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24"><use href="#ic-flame"/></svg>
  </div>
  <div style="flex:1">
    <div style="font-weight:700;font-size:.88rem;color:#130700;margin-bottom:2px">Need a Pandit?</div>
    <div style="font-size:.76rem;color:#6B4A28">Book a verified purohit for this puja</div>
  </div>
  <a href="<?= base_url('purohit-puja') ?>" style="background:#7A1E12;color:#fbc04a;font-size:.74rem;font-weight:700;padding:9px 13px;border-radius:9px;text-decoration:none;white-space:nowrap">Book →</a>
</div>

<?= $this->endSection() ?>
