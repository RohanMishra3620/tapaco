<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.acct-outer{max-width:1200px;margin:0 auto;padding:16px 16px 32px}
.acct-layout{display:flex;gap:32px;align-items:flex-start}
.acct-inner{flex:1;min-width:0;max-width:480px}
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
          <div class="acct-page-title">Language</div>
          <div class="acct-page-sub">Choose your preferred reading language</div>
        </div>
      </div>

      <?php if(session()->getFlashdata('success')): ?>
      <div data-reveal style="margin-bottom:20px;padding:12px 16px;background:#E8F5E8;border:1px solid #C0DCC0;border-radius:10px;font-size:.875rem;color:#1A5C1A;display:flex;align-items:center;gap:8px">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <?= session()->getFlashdata('success') ?>
      </div>
      <?php endif; ?>

      <form method="POST" action="<?= base_url('account/language') ?>">
        <?= csrf_field() ?>

        <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:20px">
          <?php foreach([['en','🇬🇧','English','Ritual guides and content in English'],['hi','🇮🇳','हिन्दी','देवनागरी लिपि में विधि और मंत्र']] as [$v,$fl,$nm,$sub]): ?>
          <label id="label-<?=$v?>" onclick="pickLang('<?=$v?>')"
                 style="display:flex;align-items:center;gap:16px;padding:18px 20px;border-radius:12px;border:1.5px solid <?= $current===$v?'#7B2D00':'#E8DCC8' ?>;background:<?= $current===$v?'rgba(123,45,0,.04)':'#fff' ?>;cursor:pointer;transition:border-color .2s,background .2s">
            <input type="radio" name="lang" value="<?=$v?>" <?= $current===$v?'checked':'' ?> style="display:none" id="radio-<?=$v?>">
            <span style="font-size:1.75rem;flex-shrink:0"><?=$fl?></span>
            <div style="flex:1">
              <p style="font-weight:700;font-size:.9375rem;color:#120804;margin-bottom:3px"><?=$nm?></p>
              <p style="font-size:.8rem;color:#8C6848<?= $v==='hi'?';font-family:"Noto Serif Devanagari",serif':'' ?>"><?=$sub?></p>
            </div>
            <div id="check-<?=$v?>" style="width:20px;height:20px;border-radius:50%;border:2px solid <?= $current===$v?'#7B2D00':'#E0D4C4' ?>;background:<?= $current===$v?'#7B2D00':'transparent' ?>;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .2s">
              <?php if($current===$v): ?>
              <svg width="10" height="10" fill="none" stroke="#fff" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <?php endif; ?>
            </div>
          </label>
          <?php endforeach; ?>
        </div>

        <div data-reveal style="background:#F9F5EE;border:1px solid #F0E8D8;border-radius:10px;padding:14px 16px;margin-bottom:20px">
          <p style="font-size:.6875rem;font-weight:700;color:#7B2D00;letter-spacing:.08em;text-transform:uppercase;margin-bottom:6px">Note</p>
          <p style="font-size:.8rem;color:#8C6848;line-height:1.6">This sets the default language for ritual guides. You can still switch language per article using the toggle at the top of each page.</p>
        </div>

        <button type="submit" class="btn btn-dark" style="width:100%;justify-content:center;padding:13px">
          Save Language Preference
        </button>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
function pickLang(lang) {
  ['en','hi'].forEach(l => {
    const active = l === lang;
    const lbl = document.getElementById('label-' + l);
    const chk = document.getElementById('check-' + l);
    const rad = document.getElementById('radio-' + l);
    lbl.style.borderColor = active ? '#7B2D00' : '#E8DCC8';
    lbl.style.background = active ? 'rgba(123,45,0,.04)' : '#fff';
    chk.style.borderColor = active ? '#7B2D00' : '#E0D4C4';
    chk.style.background = active ? '#7B2D00' : 'transparent';
    chk.innerHTML = active ? '<svg width="10" height="10" fill="none" stroke="#fff" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>' : '';
    rad.checked = active;
  });
}
</script>
<?= $this->endSection() ?>
