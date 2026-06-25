<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
/* ── Account mobile system ── */
.acct-outer{max-width:1200px;margin:0 auto;padding:16px 16px 32px}
.acct-layout{display:flex;gap:32px;align-items:flex-start}

/* Profile hero */
.acct-hero{border-radius:20px;padding:28px 24px;position:relative;overflow:hidden;margin-bottom:16px;
  background:linear-gradient(150deg,#4A0E08 0%,#7A1E12 50%,#A83410 100%)}
.acct-hero-om{display:none}
.acct-avatar{width:56px;height:56px;border-radius:14px;background:rgba(251,192,74,.2);
  border:1.5px solid rgba(251,192,74,.35);display:flex;align-items:center;justify-content:center;
  font-family:'Cormorant Garamond',serif;font-weight:700;font-size:1.5rem;color:#FBC04A;flex-shrink:0}
.acct-name{font-family:'Cormorant Garamond',serif;font-size:1.375rem;font-weight:700;color:#fff;margin-bottom:3px}
.acct-phone{font-size:.8rem;color:rgba(255,255,255,.45)}
.acct-badge{display:inline-flex;align-items:center;gap:5px;margin-top:8px;
  background:rgba(45,140,45,.18);border:1px solid rgba(45,140,45,.3);
  border-radius:100px;padding:3px 10px;font-size:.65rem;font-weight:700;color:#5BC85B;letter-spacing:.04em}
.acct-badge-dot{width:5px;height:5px;border-radius:50%;background:#5BC85B;flex-shrink:0}

/* Stats row */
.acct-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:16px}
.acct-stat{background:#fff;border:1px solid #EAE0D0;border-radius:14px;padding:16px 12px;text-align:center}
.acct-stat-n{font-family:'Cormorant Garamond',serif;font-size:1.6rem;font-weight:700;color:#120804;line-height:1}
.acct-stat-l{font-size:.65rem;color:#8C6848;margin-top:5px;letter-spacing:.05em}

/* Nav tiles */
.acct-nav{display:flex;flex-direction:column;gap:8px}
.acct-tile{display:flex;align-items:center;gap:14px;padding:15px 18px;background:#fff;
  border:1px solid #EAE0D0;border-radius:14px;text-decoration:none;
  transition:border-color .2s,box-shadow .2s}
.acct-tile:hover{border-color:rgba(122,30,18,.25);box-shadow:0 6px 20px rgba(122,30,18,.08)}
.acct-tile-icon{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;
  justify-content:center;flex-shrink:0;background:#F5EDE2}
.acct-tile-lbl{font-weight:600;font-size:.9rem;color:#120804}
.acct-tile-sub{font-size:.75rem;color:#8C6848;margin-top:2px}
.acct-tile-chev{margin-left:auto;flex-shrink:0;color:#C4A880}

/* Sub CTA tile */
.acct-sub-tile{background:linear-gradient(135deg,#FFFAF2,#F7EBD8);border-color:#E0CEB0!important}
.acct-sub-tile .acct-tile-icon{background:rgba(122,30,18,.08)}

/* Logout */
.acct-logout{margin-top:20px;padding-top:16px;border-top:1px solid #EAE0D0;text-align:center}
.acct-logout a{display:inline-flex;align-items:center;gap:8px;font-size:.875rem;
  color:#C02020;text-decoration:none;padding:9px 18px;border:1px solid rgba(192,32,32,.15);
  border-radius:8px;transition:background .2s}
.acct-logout a:hover{background:#FEF2F2}

@media(min-width:640px){
  .acct-outer{padding:24px 24px 40px}
  .acct-stats{gap:14px}
  .acct-stat{padding:20px}
  .acct-stat-n{font-size:1.875rem}
  .acct-nav{display:grid;grid-template-columns:1fr 1fr;gap:10px}
  .acct-logout{display:none} /* shown in sidebar on desktop */
}
@media(min-width:1024px){
  .acct-outer{padding:40px 24px}
  .acct-nav{grid-template-columns:1fr}
}
</style>

<div class="acct-outer">
  <div class="acct-layout">

    <?php include __DIR__.'/_sidebar.php'; ?>

    <div style="flex:1;min-width:0">

      <!-- Hero -->
      <div class="acct-hero" data-reveal>
        <div class="acct-hero-om"></div>
        <div style="position:relative;z-index:1;display:flex;align-items:center;gap:16px">
          <div class="acct-avatar"><?= strtoupper(substr($user['name'] ?? 'D', 0, 1)) ?></div>
          <div>
            <div class="acct-name"><?= esc($user['name'] ?? 'Devotee') ?></div>
            <div class="acct-phone">+91 <?= esc($user['phone'] ?? '') ?></div>
            <?php if($subStatus): ?>
            <div class="acct-badge"><span class="acct-badge-dot"></span>WhatsApp Active</div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Stats -->
      <div class="acct-stats">
        <?php foreach([[$savedCount,'Saved'],[$bookingCount,'Bookings'],[$subStatus?'Active':'—','Plan']] as $i=>[$n,$l]): ?>
        <div class="acct-stat" data-reveal="delay-<?=$i+1?>">
          <div class="acct-stat-n"><?= $n ?></div>
          <div class="acct-stat-l"><?= $l ?></div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Nav tiles -->
      <div class="acct-nav">
        <?php foreach([
          ['account/saved',        'Saved Guides',   'Your bookmarked rituals',              'M19 21l-7-4-7 4V5a2 2 0 012-2h10a2 2 0 012 2z',       '#7B2D00'],
          ['account/bookings',     'My Bookings',    'Puja & bhajan history',                'M3 4h18v16H3zM3 10h18M8 2v4M16 2v4',                  '#B85B08'],
          ['account/subscriptions','Subscriptions',  'Manage WhatsApp plan',                 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',         '#1A6B3A'],
          ['account/notifications','Notifications',  'What lands on WhatsApp',               'M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0', '#7B5C00'],
          ['account/language',     'Language',       'English / Hindi preference',           'M12 2a10 10 0 100 20A10 10 0 0012 2zM2 12h20M12 2a15.3 15.3 0 010 20', '#0A4A7A'],
        ] as $idx=>[$href,$lbl,$sub,$ic,$clr]): ?>
        <a href="<?= base_url($href) ?>" class="acct-tile" data-reveal="delay-<?=$idx+1?>">
          <div class="acct-tile-icon" style="background:<?= $clr ?>18">
            <svg width="17" height="17" fill="none" stroke="<?= $clr ?>" stroke-width="1.75" viewBox="0 0 24 24"><path d="<?= $ic ?>" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div>
            <div class="acct-tile-lbl"><?= $lbl ?></div>
            <div class="acct-tile-sub"><?= $sub ?></div>
          </div>
          <svg class="acct-tile-chev" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <?php endforeach; ?>

        <?php if(!$subStatus): ?>
        <a href="<?= base_url('subscribe') ?>" class="acct-tile acct-sub-tile" data-reveal>
          <div class="acct-tile-icon" style="background:rgba(122,30,18,.1)">
            <svg width="17" height="17" fill="none" stroke="#7A1E12" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div>
            <div class="acct-tile-lbl" style="color:#7A1E12">Subscribe — ₹99/year</div>
            <div class="acct-tile-sub">Daily panchang & vrat on WhatsApp</div>
          </div>
          <span style="font-size:.75rem;font-weight:700;color:#7A1E12;white-space:nowrap;margin-left:auto">Get →</span>
        </a>
        <?php endif; ?>
      </div>

      <!-- Logout (mobile only) -->
      <div class="acct-logout">
        <a href="<?= base_url('logout') ?>">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4-4-4M21 12H9M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" stroke-linecap="round"/></svg>
          Log out
        </a>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
