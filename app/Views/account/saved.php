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
.acct-empty{background:#fff;border:1px solid #EAE0D0;border-radius:16px;padding:52px 20px;text-align:center}
.acct-empty-icon{width:54px;height:54px;background:#F5EDE2;border-radius:14px;
  display:flex;align-items:center;justify-content:center;margin:0 auto 16px}
.saved-grid{display:grid;grid-template-columns:1fr;gap:8px}
@media(min-width:560px){.saved-grid{grid-template-columns:1fr 1fr}}
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
          <div class="acct-page-title">Saved Guides</div>
          <div class="acct-page-sub">Your bookmarked ritual guides</div>
        </div>
      </div>

      <?php if(empty($saved)): ?>
      <div class="acct-empty">
        <div class="acct-empty-icon">
          <svg width="24" height="24" fill="none" stroke="#7B2D00" stroke-width="1.75" viewBox="0 0 24 24"><path d="M19 21l-7-4-7 4V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
        </div>
        <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:700;color:#120804;margin-bottom:8px">No saved guides yet</h2>
        <p style="font-size:.875rem;color:#8C6848;margin-bottom:22px">Bookmark ritual guides to find them quickly.</p>
        <a href="<?= base_url('ritual-guides') ?>" class="btn btn-dark" style="display:inline-flex;padding:10px 20px">Browse Guides →</a>
      </div>

      <?php else: ?>
      <div class="saved-grid" id="savedGrid">
        <?php foreach($saved as $s): ?>
        <div id="card-<?= $s['id'] ?>" style="background:#fff;border:1px solid #EAE0D0;border-radius:14px;padding:16px;display:flex;align-items:center;gap:14px;transition:opacity .3s,transform .3s">
          <div style="width:42px;height:42px;background:#F5EDE2;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <svg width="18" height="18" fill="none" stroke="#7B2D00" stroke-width="1.75" viewBox="0 0 24 24"><path d="M19 21l-7-4-7 4V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
          </div>
          <div style="flex:1;min-width:0">
            <p style="font-weight:600;font-size:.875rem;color:#120804;margin-bottom:3px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= esc($s['title']) ?></p>
            <p style="font-size:.72rem;color:#8C6848"><?= esc($s['tag'] ?? $s['subcategory'] ?? '') ?></p>
          </div>
          <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;flex-shrink:0">
            <a href="<?= base_url('ritual-guides/'.$s['slug']) ?>" style="font-size:.78rem;font-weight:600;color:#7B2D00;text-decoration:none;white-space:nowrap">Read →</a>
            <button onclick="unsave(<?= $s['id'] ?>,'<?= csrf_hash() ?>')"
              style="display:flex;align-items:center;gap:4px;background:none;border:none;cursor:pointer;font-size:.72rem;color:#C4A880;padding:0;transition:color .2s"
              onmouseover="this.style.color='#C02020'" onmouseout="this.style.color='#C4A880'">
              <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>
              Remove
            </button>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
function unsave(id, tok) {
  const card = document.getElementById('card-' + id);
  if (!card) return;
  fetch('<?= base_url('ritual-guides/save/') ?>' + id, {
    method: 'POST',
    headers: {'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'},
    body: JSON.stringify({'<?= csrf_token() ?>': tok})
  }).then(r => r.json()).then(d => {
    if (!d.saved) {
      card.style.opacity = '0'; card.style.transform = 'translateX(16px)';
      setTimeout(() => card.remove(), 320);
    }
  });
}
</script>
<?= $this->endSection() ?>
