<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.acct-outer{max-width:1200px;margin:0 auto;padding:16px 16px 32px}
.acct-layout{display:flex;gap:32px;align-items:flex-start}
.acct-inner{flex:1;min-width:0}
.acct-page-head{display:flex;align-items:center;gap:12px;margin-bottom:20px}
.acct-back{display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:9px;border:1px solid #E8DCC8;color:#8C6848;text-decoration:none;flex-shrink:0}
.acct-back:hover{background:#F5EDE2}
.acct-page-title{font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:700;color:#120804}
.acct-page-sub{font-size:.8rem;color:#8C6848;margin-top:2px}
@media(min-width:640px){.acct-outer{padding:24px 24px 40px}}
@media(min-width:1024px){.acct-outer{padding:40px 24px}.acct-back{display:none}}
</style>
<div class="acct-outer">
  <div class="acct-layout">

    <?php include __DIR__.'/_sidebar.php'; ?>

    <div class="acct-inner">
      <div class="acct-page-head">
        <a href="<?= base_url('account') ?>" class="acct-back">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
          <div class="acct-page-title">Subscriptions</div>
          <div class="acct-page-sub">Manage your WhatsApp subscription</div>
        </div>
      </div>

      <?php if($sub): ?>

      <!-- Active sub card -->
      <div data-reveal style="background:#120804;border-radius:16px;padding:32px;position:relative;overflow:hidden;margin-bottom:16px">
        <svg style="position:absolute;right:-30px;bottom:-30px;width:180px;height:180px;opacity:.04;pointer-events:none" viewBox="0 0 300 300" fill="none">
          <?php for($i=0;$i<12;$i++): ?><ellipse cx="150" cy="40" rx="4" ry="24" transform="rotate(<?=$i*30?> 150 150)" fill="white"/><?php endfor; ?>
        </svg>
        <div style="position:relative;z-index:1">
          <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:16px">
            <div>
              <div style="display:inline-flex;align-items:center;gap:5px;background:rgba(76,175,80,.15);border:1px solid rgba(76,175,80,.25);border-radius:100px;padding:3px 10px;margin-bottom:12px">
                <span style="width:5px;height:5px;border-radius:50%;background:#4CAF50;flex-shrink:0"></span>
                <span style="font-size:.6rem;font-weight:700;letter-spacing:.08em;color:#4CAF50">ACTIVE</span>
              </div>
              <h2 class="serif" style="font-size:1.375rem;font-weight:700;color:#fff;margin-bottom:4px">WhatsApp Subscription</h2>
              <p style="font-size:.875rem;color:rgba(255,255,255,.4)">Sacred reminders & daily panchang</p>
            </div>
            <div class="serif" style="font-size:2rem;font-weight:700;color:#B8922A">₹<?= number_format($sub['amount']) ?></div>
          </div>

          <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin-bottom:24px" class="sub-meta-grid">
            <?php foreach([['Started',date('d M Y',strtotime($sub['starts_at']))],['Expires',date('d M Y',strtotime($sub['expires_at']))]] as [$k,$v]): ?>
            <div style="background:rgba(255,255,255,.06);border-radius:10px;padding:14px 16px">
              <p style="font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.25);margin-bottom:4px"><?= $k ?></p>
              <p style="font-weight:600;font-size:.9rem;color:rgba(255,255,255,.85)"><?= $v ?></p>
            </div>
            <?php endforeach; ?>
            <?php if($sub['whatsapp_number']): ?>
            <div style="background:rgba(255,255,255,.06);border-radius:10px;padding:14px 16px;grid-column:span 2">
              <p style="font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.25);margin-bottom:4px">WhatsApp</p>
              <p style="font-weight:600;font-size:.9rem;color:rgba(255,255,255,.85)">+91 <?= esc($sub['whatsapp_number']) ?></p>
            </div>
            <?php endif; ?>
          </div>
          <style>@media(min-width:480px){.sub-meta-grid{grid-template-columns:repeat(3,1fr)!important}}</style>

          <?php
          $daysLeft = max(0,ceil((strtotime($sub['expires_at'])-time())/86400));
          $pct = min(100,round(($daysLeft/365)*100));
          ?>
          <div>
            <div style="display:flex;justify-content:space-between;font-size:.75rem;color:rgba(255,255,255,.3);margin-bottom:8px">
              <span>Subscription period</span>
              <span><?= $daysLeft ?> days remaining</span>
            </div>
            <div style="height:4px;background:rgba(255,255,255,.08);border-radius:4px;overflow:hidden">
              <div style="height:100%;width:<?= $pct ?>%;background:#B8922A;border-radius:4px"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- What's included -->
      <div class="card" data-reveal style="padding:24px;margin-bottom:16px">
        <h3 class="serif" style="font-weight:700;color:#120804;margin-bottom:16px">What's included</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
          <?php foreach([['Daily Panchang','Tithi, nakshatra & muhurat every morning'],['Vrat Reminders','3 days before every fasting day'],['Ritual Guides','Curated puja content on WhatsApp'],['Member Offers','Exclusive discounts on bookings']] as [$h,$s]): ?>
          <div style="padding:14px;background:#F9F5EE;border-radius:10px;border:1px solid #F0E8D8">
            <p style="font-weight:600;font-size:.875rem;color:#120804;margin-bottom:4px"><?= $h ?></p>
            <p style="font-size:.75rem;color:#8C6848;line-height:1.5"><?= $s ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div data-reveal style="text-align:center">
        <p style="font-size:.75rem;color:#8C6848;margin-bottom:12px">Auto-renewal is not enabled. You'll need to subscribe again after expiry.</p>
        <button onclick="if(confirm('Cancel subscription? You\'ll still have access until expiry.'))alert('Cancellation request sent.')"
          style="font-size:.875rem;color:#C02020;border:1px solid rgba(192,32,32,.15);border-radius:8px;padding:8px 20px;background:none;cursor:pointer;transition:background .2s"
          onmouseover="this.style.background='#FEF2F2'" onmouseout="this.style.background='transparent'">
          Cancel Subscription
        </button>
      </div>

      <?php else: ?>

      <!-- No sub — upsell -->
      <div data-reveal style="background:#fff;border:1px solid #E8DCC8;border-radius:16px;padding:64px 24px;text-align:center">
        <div style="width:56px;height:56px;background:#F2EBE0;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px">
          <svg width="24" height="24" fill="none" stroke="#7B2D00" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2 class="serif" style="font-size:1.25rem;font-weight:700;color:#120804;margin-bottom:8px">No active subscription</h2>
        <p style="font-size:.9rem;color:#8C6848;max-width:320px;margin:0 auto 28px;line-height:1.7">Subscribe to get daily panchang, vrat reminders and exclusive content on WhatsApp — only ₹99/year.</p>
        <a href="<?= base_url('subscribe') ?>" class="btn btn-dark" style="display:inline-flex;padding:12px 28px">Subscribe for ₹99/year →</a>
      </div>

      <?php endif; ?>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
