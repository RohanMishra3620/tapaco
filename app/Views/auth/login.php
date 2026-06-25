<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.divider{display:flex;align-items:center;gap:12px;color:var(--faint);font-size:.75rem}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:var(--line)}
@keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-5px)}75%{transform:translateX(5px)}}
.shake{animation:shake .3s ease}
/* mobile login fixes */
@media(max-width:640px){
  .login-wrap{flex-direction:column!important}
  .login-right{padding:28px 20px 40px!important;align-items:flex-start!important}
  .login-right>div{max-width:100%!important;width:100%!important}
  .otp-d{max-width:42px!important;font-size:1.1rem!important}
  #step1 input[type=tel]{font-size:1rem!important}
}
</style>

<div class="login-wrap" style="min-height:calc(100vh - 60px);display:flex">

  <!-- LEFT — brand panel, desktop only -->
  <div class="login-left" style="display:none;width:44%;background:linear-gradient(160deg,#FDFAF2 0%,#FFF3E8 50%,#FFF0F4 100%);border-right:1px solid var(--line);position:relative;overflow:hidden;align-items:center;justify-content:center;padding:64px">

    <!-- Geometric mandala — static, faint -->
    <svg style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:480px;height:480px;opacity:.055;pointer-events:none" viewBox="0 0 300 300" fill="none">
      <?php for($i=0;$i<24;$i++): ?>
      <line x1="150" y1="150" x2="150" y2="18" stroke="#C4920A" stroke-width=".4" transform="rotate(<?=$i*15?> 150 150)"/>
      <?php endfor; ?>
      <?php foreach([18,36,54,72,90,108,124,136,144,149] as $r): ?>
      <circle cx="150" cy="150" r="<?=$r?>" stroke="#C4920A" stroke-width=".4"/>
      <?php endforeach; ?>
      <?php for($i=0;$i<12;$i++): ?>
      <ellipse cx="150" cy="32" rx="4" ry="14" transform="rotate(<?=$i*30?> 150 150)" fill="#C4920A" opacity=".5"/>
      <?php endfor; ?>
      <circle cx="150" cy="150" r="6" fill="#C4920A"/>
    </svg>

    <!-- Flame SVG (no emoji) -->
    <div style="position:relative;z-index:2;text-align:center;max-width:280px">
      <svg width="56" height="72" viewBox="0 0 56 72" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin:0 auto 28px;display:block;filter:drop-shadow(0 0 24px rgba(156,122,42,.5))">
        <!-- bowl base -->
        <ellipse cx="28" cy="62" rx="22" ry="6" fill="#6B4800" opacity=".6"/>
        <path d="M8 58 Q28 68 48 58 L44 50 Q28 58 12 50 Z" fill="#8A5C00" opacity=".8"/>
        <!-- flame outer -->
        <path d="M28 4 C28 4 44 18 44 34 C44 43.9 36.8 52 28 52 C19.2 52 12 43.9 12 34 C12 18 28 4 28 4Z" fill="#C4920A" opacity=".7"/>
        <!-- flame inner -->
        <path d="M28 16 C28 16 38 26 38 35 C38 40.5 33.5 45 28 45 C22.5 45 18 40.5 18 35 C18 26 28 16 28 16Z" fill="#C4920A"/>
        <!-- flame tip -->
        <path d="M28 28 C28 28 33 33 33 38 C33 40.8 30.8 43 28 43 C25.2 43 23 40.8 23 38 C23 33 28 28 28 28Z" fill="#FDFAF5"/>
        <!-- wick -->
        <line x1="28" y1="50" x2="28" y2="58" stroke="#4A2C00" stroke-width="2"/>
      </svg>

      <h2 style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;background:linear-gradient(120deg,#C4920A,#C86878);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1.15;margin-bottom:6px">The Tapa Co.</h2>
      <p style="font-family:'Playfair Display',serif;color:var(--saffron);font-style:italic;font-size:1rem;margin-bottom:24px">Sacred Ritual Platform</p>
      <p style="font-size:.875rem;line-height:1.75;color:var(--muted);margin-bottom:32px">Your complete companion for pujas, ritual guides, panchang and sacred reminders.</p>

      <div style="display:flex;flex-direction:column;gap:9px;text-align:left">
        <?php foreach(['500+ ritual guides & vidhi','Daily panchang & vrat calendar','Book verified pandits at home','WhatsApp alerts for ₹99/year'] as $item): ?>
        <div style="display:flex;align-items:center;gap:10px">
          <span style="width:6px;height:6px;border-radius:50%;background:linear-gradient(135deg,var(--saffron),var(--rose));flex-shrink:0"></span>
          <span style="font-size:.875rem;color:var(--muted)"><?= $item ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <style>@media(min-width:900px){.login-left{display:flex!important}}</style>

  <!-- RIGHT — form -->
  <div class="login-right" style="flex:1;display:flex;align-items:center;justify-content:center;padding:48px 24px;background:var(--bg)">
    <div style="width:100%;max-width:340px">

      <!-- Mobile brand -->
      <div class="login-mob" style="text-align:center;margin-bottom:36px">
        <svg width="36" height="46" viewBox="0 0 56 72" fill="none" style="margin:0 auto 12px;display:block">
          <ellipse cx="28" cy="62" rx="22" ry="6" fill="#6B4800" opacity=".5"/>
          <path d="M8 58 Q28 68 48 58 L44 50 Q28 58 12 50 Z" fill="#8A5C00" opacity=".7"/>
          <path d="M28 4 C28 4 44 18 44 34 C44 43.9 36.8 52 28 52 C19.2 52 12 43.9 12 34 C12 18 28 4 28 4Z" fill="#C4920A" opacity=".6"/>
          <path d="M28 16 C28 16 38 26 38 35 C38 40.5 33.5 45 28 45 C22.5 45 18 40.5 18 35 C18 26 28 16 28 16Z" fill="#C4920A"/>
          <path d="M28 28 C28 28 33 33 33 38 C33 40.8 30.8 43 28 43 C25.2 43 23 40.8 23 38 C23 33 28 28 28 28Z" fill="#FDFAF5"/>
          <line x1="28" y1="50" x2="28" y2="58" stroke="#4A2C00" stroke-width="2"/>
        </svg>
        <h1 style="font-family:'Playfair Display',serif;font-size:1.375rem;font-weight:700;background:linear-gradient(135deg,var(--saffron),var(--rose));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">The Tapa Co.</h1>
        <p style="font-size:.875rem;color:var(--muted);margin-top:3px">Sacred Ritual Platform</p>
      </div>
      <style>@media(min-width:900px){.login-mob{display:none!important}}</style>

      <div style="margin-bottom:28px">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700;color:var(--ink);margin-bottom:6px">Welcome back</h2>
        <p style="font-size:.9rem;color:var(--muted);line-height:1.6">Enter your mobile — we'll send a 6-digit code.</p>
      </div>

      <?php if(session()->getFlashdata('error')): ?>
      <div style="margin-bottom:18px;padding:11px 14px;background:#FEF2F2;border:1px solid #FECACA;border-radius:4px;font-size:.875rem;color:#991111">
        <?= esc(session()->getFlashdata('error')) ?>
      </div>
      <?php endif; ?>

      <!-- STEP 1 -->
      <div id="step1">
        <label style="display:block;font-size:.65rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--muted);margin-bottom:8px">Mobile Number</label>
        <div style="display:flex;gap:8px;margin-bottom:6px">
          <div style="display:flex;align-items:center;gap:6px;padding:11px 13px;background:var(--cream);border:1px solid var(--line);border-radius:4px;flex-shrink:0;user-select:none">
            <span style="font-size:.875rem">IN</span>
            <span style="font-size:.875rem;font-weight:700;color:var(--ink)">+91</span>
          </div>
          <input id="phoneInput" type="tel" inputmode="numeric" maxlength="10" placeholder="98765 43210" class="field">
        </div>
        <p style="font-size:.72rem;color:var(--faint);margin-bottom:22px">Indian mobile numbers only (starts 6–9)</p>

        <button id="sendBtn" onclick="sendOtp()" class="btn btn-ink" style="width:100%;justify-content:center;padding:13px;font-size:.9375rem;margin-bottom:18px">
          <span id="sendLbl">Send OTP</span>
          <svg id="sendArrow" width="14" height="14"><use href="#ic-arrow"/></svg>
          <svg id="sendSpin" width="14" height="14" style="display:none;animation:spin 1s linear infinite" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" opacity=".2"/><path fill="currentColor" d="M4 12a8 8 0 018-8v8z" opacity=".75"/></svg>
        </button>

        <div class="divider" style="margin-bottom:16px">or</div>
        <p style="text-align:center;font-size:.78rem;color:var(--muted)">
          By continuing, you agree to our <a href="#" style="color:var(--rust);font-weight:600">Terms</a> &amp; <a href="#" style="color:var(--rust);font-weight:600">Privacy Policy</a>
        </p>
      </div>

      <!-- STEP 2 -->
      <div id="step2" style="display:none">
        <div style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#fff;border:1px solid var(--line);border-radius:4px;margin-bottom:18px">
          <svg width="14" height="14" fill="none" stroke="#2D7A2D" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <p style="font-size:.875rem;color:var(--ink2)">OTP sent to <strong id="dispPhone" style="color:var(--ink)"></strong></p>
        </div>

        <div id="devHint" style="display:none;background:#FFFBEB;border:1px solid #FDE68A;border-radius:4px;padding:11px 14px;margin-bottom:18px">
          <p style="font-size:.65rem;font-weight:700;color:#92400E;margin-bottom:3px;letter-spacing:.08em;text-transform:uppercase">Dev Mode</p>
          <p style="font-size:.875rem;color:#78350F">Code: <span id="devOtp" style="font-family:monospace;font-weight:700;font-size:1.25rem;letter-spacing:.12em"></span></p>
        </div>

        <label style="display:block;font-size:.65rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--muted);margin-bottom:10px">6-Digit Code</label>
        <div style="display:flex;gap:7px;margin-bottom:22px">
          <?php for($i=0;$i<6;$i++): ?>
          <input type="text" inputmode="numeric" maxlength="1" data-idx="<?=$i?>"
                 class="otp-d" oninput="onOtpIn(this)" onkeydown="onOtpKey(event,this)" onpaste="onPaste(event)">
          <?php endfor; ?>
        </div>

        <button id="verifyBtn" onclick="verifyOtp()" class="btn btn-ink" style="width:100%;justify-content:center;padding:13px;font-size:.9375rem;margin-bottom:18px">
          <span id="verifyLbl">Verify &amp; Sign In</span>
          <svg id="verifyArrow" width="14" height="14"><use href="#ic-arrow"/></svg>
          <svg id="verifySpin" width="14" height="14" style="display:none;animation:spin 1s linear infinite" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" opacity=".2"/><path fill="currentColor" d="M4 12a8 8 0 018-8v8z" opacity=".75"/></svg>
        </button>

        <div style="display:flex;align-items:center;justify-content:space-between;font-size:.8125rem">
          <button onclick="goBack()" style="display:flex;align-items:center;gap:5px;background:none;border:none;cursor:pointer;color:var(--muted);font-size:.8125rem;padding:0;transition:color .2s" onmouseover="this.style.color='var(--ink)'" onmouseout="this.style.color='var(--muted)'">
            ← Change number
          </button>
          <span id="cdWrap" style="color:var(--muted)">Resend in <strong id="cdNum" style="color:var(--ink)">30</strong>s</span>
          <button id="resendBtn" onclick="resendOtp()" style="display:none;background:none;border:none;cursor:pointer;font-size:.8125rem;font-weight:700;color:var(--rust);padding:0">Resend</button>
        </div>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
const BASE='<?= base_url() ?>';
let phone='',cdT;

function sendOtp(){
  phone=document.getElementById('phoneInput').value.trim();
  if(!/^[6-9]\d{9}$/.test(phone)){shakeEl(document.getElementById('phoneInput'));return}
  setBusy('send',true);
  fetch(BASE+'auth/send-otp',{method:'POST',headers:{'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'},body:JSON.stringify({'<?= csrf_token() ?>':'<?= csrf_hash() ?>',phone})})
  .then(r=>r.json()).then(d=>{
    setBusy('send',false);
    if(d.success){
      stepTo('step1','step2');
      document.getElementById('dispPhone').textContent='+91 '+phone.replace(/(\d{5})(\d{5})/,'$1 $2');
      if(d.dev_otp){document.getElementById('devHint').style.display='block';document.getElementById('devOtp').textContent=d.dev_otp}
      startCd();setTimeout(()=>document.querySelector('.otp-d').focus(),350);
    }else shakeEl(document.getElementById('phoneInput'));
  }).catch(()=>setBusy('send',false));
}

function verifyOtp(){
  const otp=[...document.querySelectorAll('.otp-d')].map(b=>b.value).join('');
  if(otp.length!==6){document.querySelectorAll('.otp-d').forEach(shakeEl);return}
  setBusy('verify',true);
  fetch(BASE+'auth/verify-otp',{method:'POST',headers:{'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'},body:JSON.stringify({'<?= csrf_token() ?>':'<?= csrf_hash() ?>',phone,otp})})
  .then(r=>r.json()).then(d=>{
    setBusy('verify',false);
    if(d.success&&d.redirect){window.location.href=d.redirect}
    else{document.querySelectorAll('.otp-d').forEach(b=>{b.value='';b.classList.remove('ok');b.style.borderColor='#C02020';b.style.background='#FEF2F2';shakeEl(b);setTimeout(()=>{b.style.borderColor='';b.style.background=''},1400)});document.querySelector('.otp-d').focus()}
  }).catch(()=>setBusy('verify',false));
}

function goBack(){stepTo('step2','step1');clearInterval(cdT)}
function resendOtp(){document.getElementById('resendBtn').style.display='none';document.getElementById('cdWrap').style.display='';sendOtp()}

function stepTo(from,to){
  const f=document.getElementById(from),t=document.getElementById(to);
  f.style.opacity='0';f.style.transform='translateX(-14px)';
  setTimeout(()=>{f.style.display='none';t.style.opacity='0';t.style.transform='translateX(14px)';t.style.display='block';requestAnimationFrame(()=>{t.style.transition='opacity .28s ease,transform .28s ease';t.style.opacity='1';t.style.transform='none'})},210);
}

function startCd(){
  let s=30;document.getElementById('cdNum').textContent=s;document.getElementById('cdWrap').style.display='';document.getElementById('resendBtn').style.display='none';clearInterval(cdT);
  cdT=setInterval(()=>{s--;document.getElementById('cdNum').textContent=s;if(s<=0){clearInterval(cdT);document.getElementById('cdWrap').style.display='none';document.getElementById('resendBtn').style.display=''}},1000);
}

function onOtpIn(el){el.value=el.value.replace(/\D/,'');el.classList.toggle('ok',!!el.value);if(el.value&&+el.dataset.idx<5)document.querySelector(`.otp-d[data-idx="${+el.dataset.idx+1}"]`).focus();if([...document.querySelectorAll('.otp-d')].every(b=>b.value))setTimeout(verifyOtp,300)}
function onOtpKey(e,el){if(e.key==='Backspace'&&!el.value&&+el.dataset.idx>0){const p=document.querySelector(`.otp-d[data-idx="${+el.dataset.idx-1}"]`);p.focus();p.classList.remove('ok')}}
function onPaste(e){e.preventDefault();const t=(e.clipboardData||window.clipboardData).getData('text').replace(/\D/g,'').slice(0,6);const bs=document.querySelectorAll('.otp-d');[...t].forEach((c,i)=>{if(bs[i]){bs[i].value=c;bs[i].classList.add('ok')}});if(t.length===6)setTimeout(verifyOtp,300)}

function setBusy(w,busy){const p=w==='send'?'send':'verify';document.getElementById(p+'Btn').disabled=busy;document.getElementById(p+'Lbl').textContent=busy?(w==='send'?'Sending…':'Verifying…'):(w==='send'?'Send OTP':'Verify & Sign In');document.getElementById(p+'Arrow').style.display=busy?'none':'';document.getElementById(p+'Spin').style.display=busy?'':'none'}
function shakeEl(el){el.classList.remove('shake');void el.offsetWidth;el.classList.add('shake');setTimeout(()=>el.classList.remove('shake'),350)}

document.getElementById('phoneInput').addEventListener('keydown',e=>{if(e.key==='Enter')sendOtp()});
</script>
<?= $this->endSection() ?>
