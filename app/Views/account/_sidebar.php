<!-- Account sidebar — desktop only -->
<aside style="width:210px;flex-shrink:0;display:none" class="acct-sidebar">
  <div style="background:#fff;border:1px solid var(--line);border-radius:6px;overflow:hidden;position:sticky;top:76px">

    <!-- User summary -->
    <div style="background:var(--dark);padding:18px">
      <div style="display:flex;align-items:center;gap:12px">
        <div style="width:36px;height:36px;border-radius:4px;background:var(--rust);display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-weight:700;font-size:.9375rem;color:#fff;flex-shrink:0">
          <?= strtoupper(substr(session()->get('user_name') ?? 'D', 0, 1)) ?>
        </div>
        <div style="min-width:0">
          <p style="font-weight:600;font-size:.875rem;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= esc(session()->get('user_name') ?? 'Devotee') ?></p>
          <p style="font-size:.7rem;color:rgba(255,255,255,.35);margin-top:2px">+91 <?= esc(session()->get('user_phone') ?? '') ?></p>
        </div>
      </div>
    </div>

    <!-- Nav -->
    <nav style="padding:6px">
      <?php
      $cur = current_url();
      $links = [
        ['account',               'My Account',    '#ic-user'],
        ['account/saved',         'Saved Guides',  '#ic-book'],
        ['account/bookings',      'My Bookings',   '#ic-cal'],
        ['account/subscriptions', 'Subscriptions', '#ic-shield'],
        ['account/notifications', 'Notifications', '#ic-bell'],
        ['account/language',      'Language',      '#ic-globe'],
      ];
      foreach($links as [$h,$lb,$ic]):
        $on = rtrim($cur,'/') === rtrim(base_url($h),'/');
      ?>
      <a href="<?= base_url($h) ?>" class="sdb-link <?= $on?'on':'' ?>" style="margin-bottom:1px">
        <svg width="14" height="14" style="flex-shrink:0"><use href="<?= $ic ?>"/></svg>
        <?= $lb ?>
        <?php if($on): ?>
        <span style="margin-left:auto;width:4px;height:4px;border-radius:50%;background:var(--rust);flex-shrink:0"></span>
        <?php endif; ?>
      </a>
      <?php endforeach; ?>
    </nav>

    <div style="padding:6px;border-top:1px solid var(--line)">
      <a href="<?= base_url('logout') ?>" class="sdb-link" style="color:#991111" onmouseover="this.style.background='#FEF2F2'" onmouseout="this.style.background='transparent'">
        <svg width="14" height="14" style="flex-shrink:0"><use href="#ic-out"/></svg>
        Log out
      </a>
    </div>
  </div>
</aside>
<style>@media(min-width:1024px){.acct-sidebar{display:block!important}}</style>
