<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.acct-outer{max-width:1200px;margin:0 auto;padding:16px 16px 32px}
.acct-layout{display:flex;gap:32px;align-items:flex-start}
.acct-inner{flex:1;min-width:0;max-width:520px}
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
          <div class="acct-page-title">Notifications</div>
          <div class="acct-page-sub">Manage what you receive on WhatsApp</div>
        </div>
      </div>

      <?php if(session()->getFlashdata('success')): ?>
      <div data-reveal style="margin-bottom:20px;padding:12px 16px;background:#E8F5E8;border:1px solid #C0DCC0;border-radius:10px;font-size:.875rem;color:#1A5C1A;display:flex;align-items:center;gap:8px">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <?= session()->getFlashdata('success') ?>
      </div>
      <?php endif; ?>

      <form method="POST" action="<?= base_url('account/notifications') ?>" id="notifForm">
        <?= csrf_field() ?>

        <div data-reveal style="background:#fff;border:1px solid #E8DCC8;border-radius:14px;overflow:hidden;margin-bottom:16px">
          <?php
          $toggles = [
            ['daily_panchang','Daily Panchang',    'Tithi, nakshatra & muhurat — every morning',          '<path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4"/><circle cx="12" cy="12" r="4"/>'],
            ['vrat_reminders','Vrat Reminders',    '3-day alert before every fasting day',                '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>'],
            ['puja_reminders','Booking Reminders', 'Reminder 24 hours before your booked puja',          '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
            ['offers',        'Offers & Updates',  'Member discounts and new feature announcements',      '<path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/><circle cx="7" cy="7" r="1"/>'],
          ];
          foreach($toggles as $i=>$t):
            $on = $prefs[$t[0]] ?? false;
          ?>
          <div style="display:flex;align-items:center;gap:14px;padding:16px 20px<?= $i>0?';border-top:1px solid #E8DCC8':'' ?>">
            <div style="width:36px;height:36px;background:#F2EBE0;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
              <svg width="15" height="15" fill="none" stroke="#7B2D00" stroke-width="1.75" viewBox="0 0 24 24"><?= $t[3] ?></svg>
            </div>
            <div style="flex:1">
              <p style="font-weight:600;font-size:.9rem;color:#120804;margin-bottom:3px"><?= $t[1] ?></p>
              <p style="font-size:.78rem;color:#8C6848"><?= $t[2] ?></p>
            </div>
            <label style="position:relative;display:inline-block;width:44px;height:24px;cursor:pointer;flex-shrink:0">
              <input type="checkbox" name="<?= $t[0] ?>" value="1" <?= $on?'checked':'' ?> onchange="autoSave()"
                     style="opacity:0;width:0;height:0;position:absolute" id="tog-<?= $t[0] ?>">
              <span class="tog-track" id="track-<?= $t[0] ?>" style="position:absolute;inset:0;border-radius:24px;background:<?= $on?'#7B2D00':'#E0D4C4' ?>;transition:background .2s">
                <span class="tog-thumb" style="position:absolute;top:3px;left:<?= $on?'23px':'3px' ?>;width:18px;height:18px;border-radius:50%;background:#fff;transition:left .2s;box-shadow:0 1px 4px rgba(0,0,0,.15)"></span>
              </span>
            </label>
          </div>
          <?php endforeach; ?>
        </div>

        <?php if(!session()->get('subscribed')): ?>
        <div data-reveal style="background:#120804;border-radius:12px;padding:20px;margin-bottom:16px">
          <p style="font-weight:600;font-size:.9rem;color:#fff;margin-bottom:4px">WhatsApp notifications require a subscription</p>
          <p style="font-size:.8rem;color:rgba(255,255,255,.4);margin-bottom:14px">Subscribe for ₹99/year to receive all alerts on WhatsApp.</p>
          <a href="<?= base_url('subscribe') ?>" style="display:inline-flex;font-size:.8125rem;font-weight:700;color:#120804;background:#B8922A;border-radius:8px;padding:8px 16px;text-decoration:none">Subscribe Now →</a>
        </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-dark" data-reveal style="width:100%;justify-content:center;padding:13px">
          Save Preferences
        </button>
      </form>

      <p style="text-align:center;font-size:.75rem;color:#8C6848;margin-top:16px">Reply <strong>STOP</strong> to any WhatsApp message to unsubscribe immediately.</p>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
// Toggle visual update
document.querySelectorAll('[id^="tog-"]').forEach(inp => {
  inp.addEventListener('change', () => {
    const key = inp.id.replace('tog-','');
    const track = document.getElementById('track-' + key);
    const thumb = track.querySelector('.tog-thumb');
    track.style.background = inp.checked ? '#7B2D00' : '#E0D4C4';
    thumb.style.left = inp.checked ? '23px' : '3px';
  });
});

let saveTimer;
function autoSave() {
  clearTimeout(saveTimer);
  const btn = document.querySelector('[type="submit"]');
  btn.textContent = 'Saving…';
  saveTimer = setTimeout(() => document.getElementById('notifForm').submit(), 800);
}
</script>
<?= $this->endSection() ?>
