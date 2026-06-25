<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.acct-outer{max-width:1200px;margin:0 auto;padding:16px 16px 32px}
.acct-layout{display:flex;gap:32px;align-items:flex-start}
.acct-inner{flex:1;min-width:0}
.acct-page-head{display:flex;align-items:center;gap:12px;margin-bottom:20px}
.acct-back{display:flex;align-items:center;justify-content:center;width:34px;height:34px;
  border-radius:9px;border:1px solid #E8DCC8;color:#8C6848;text-decoration:none;flex-shrink:0}
.acct-back:hover{background:#F5EDE2}
.acct-page-title{font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:700;color:#120804}
.acct-page-sub{font-size:.8rem;color:#8C6848;margin-top:2px}

/* Booking card */
.bk-card{background:#fff;border:1px solid #EAE0D0;border-radius:16px;padding:18px;margin-bottom:10px}
.bk-top{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:14px}
.bk-icon{width:42px;height:42px;border-radius:10px;background:#F5EDE2;
  display:flex;align-items:center;justify-content:center;flex-shrink:0}
.bk-name{font-weight:600;font-size:.9rem;color:#120804;margin-bottom:2px}
.bk-type{font-size:.72rem;color:#8C6848}
.bk-tag{font-size:.65rem;font-weight:700;padding:4px 10px;border-radius:50px;flex-shrink:0;white-space:nowrap}
.bk-meta{display:grid;grid-template-columns:1fr 1fr;gap:10px;padding-top:14px;border-top:1px solid #EAE0D0}
.bk-meta-full{grid-column:1/-1}
.bk-meta-lbl{font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#C4A880;margin-bottom:3px}
.bk-meta-val{font-weight:600;font-size:.875rem;color:#120804}
.bk-again{margin-top:14px;padding-top:14px;border-top:1px solid #EAE0D0;text-align:right}
.bk-again a{font-size:.85rem;font-weight:600;color:#7B2D00;text-decoration:none}

/* Empty state */
.acct-empty{background:#fff;border:1px solid #EAE0D0;border-radius:16px;padding:52px 20px;text-align:center}
.acct-empty-icon{width:54px;height:54px;background:#F5EDE2;border-radius:14px;
  display:flex;align-items:center;justify-content:center;margin:0 auto 16px}

@media(min-width:640px){
  .acct-outer{padding:24px 24px 40px}
  .bk-meta{grid-template-columns:repeat(3,1fr)}
}
@media(min-width:1024px){
  .acct-outer{padding:40px 24px}
  .acct-back{display:none}
}
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
          <div class="acct-page-title">My Bookings</div>
          <div class="acct-page-sub">Your puja and bhajan booking history</div>
        </div>
      </div>

      <?php if(empty($bookings)): ?>
      <div class="acct-empty">
        <div class="acct-empty-icon">
          <svg width="24" height="24" fill="none" stroke="#7B2D00" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        </div>
        <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:700;color:#120804;margin-bottom:8px">No bookings yet</h2>
        <p style="font-size:.875rem;color:#8C6848;margin-bottom:22px">Book a puja or bhajan mandali to get started.</p>
        <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
          <a href="<?= base_url('purohit-puja') ?>" class="btn btn-dark" style="padding:10px 20px">Book a Puja</a>
          <a href="<?= base_url('bhajan-mandali') ?>" class="btn btn-outline" style="padding:10px 20px">Bhajan Mandali</a>
        </div>
      </div>

      <?php else: ?>
      <?php foreach($bookings as $b):
        $status = $b['status'];
        $statusMap = [
          'confirmed' => ['background:#E6F5E6;color:#1A5C1A','Confirmed'],
          'pending'   => ['background:#FFF8E0;color:#7A5C00','Pending'],
          'cancelled' => ['background:#FEF0F0;color:#C02020','Cancelled'],
        ];
        [$sBg,$sLabel] = $statusMap[$status] ?? ['background:#F5EDE2;color:#5C3820', ucfirst($status)];
      ?>
      <div class="bk-card" data-reveal>
        <div class="bk-top">
          <div style="display:flex;align-items:center;gap:12px">
            <div class="bk-icon">
              <svg width="20" height="20" fill="none" stroke="var(--saffron)" stroke-width="1.6" viewBox="0 0 24 24"><use href="#ic-flame"/></svg>
            </div>
            <div>
              <div class="bk-name"><?= esc($b['ref_name'] ?? 'Booking') ?></div>
              <div class="bk-type"><?= $b['type']==='mandali' ? 'Bhajan Mandali' : 'Purohit & Puja' ?></div>
            </div>
          </div>
          <span class="bk-tag" style="<?= $sBg ?>"><?= $sLabel ?></span>
        </div>

        <div class="bk-meta">
          <div>
            <div class="bk-meta-lbl">Booking ID</div>
            <div class="bk-meta-val">#<?= $b['id'] ?></div>
          </div>
          <div>
            <div class="bk-meta-lbl">Date</div>
            <div class="bk-meta-val"><?= date('d M Y', strtotime($b['booking_date'])) ?></div>
          </div>
          <div class="bk-meta-full" style="grid-column:1/-1">
            <div class="bk-meta-lbl">Amount</div>
            <div class="bk-meta-val" style="color:#7A1E12">₹<?= number_format($b['amount'] ?? 0) ?></div>
          </div>
        </div>

        <?php if($status === 'confirmed'): ?>
        <div class="bk-again">
          <a href="<?= base_url($b['type']==='mandali'?'bhajan-mandali':'purohit-puja') ?>">Book again →</a>
        </div>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
