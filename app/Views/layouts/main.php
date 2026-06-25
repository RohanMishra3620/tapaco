<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title><?= $title ?? 'The Tapa Co.' ?> — Sacred Rituals</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<!-- Tailwind (Play CDN) + premium palette config — powers all inner pages -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        saffron:  { DEFAULT:'#B85B08', dark:'#8A4106', light:'#D4720A' },  // primary accent
        deepmar:  { DEFAULT:'#7A1E12', dark:'#5A140A', light:'#A83410' },  // deep maroon — headings
        ashgray:  { DEFAULT:'#5A3A1A', dark:'#3A1C04', light:'#9A6A38' },  // warm muted body text
        goldleaf: { DEFAULT:'#B07D08', dark:'#8A6206', light:'#C8A010' },  // aged gold
        turmeric: { DEFAULT:'#C8A010', dark:'#A07808', light:'#E0B81C' },  // marigold yellow
        cream:    { DEFAULT:'#F7EFE0', dark:'#EADFC8' },                   // warm surface
        marigold: '#D4720A',
        vermil:   '#B0341A',  // vermilion
        sacred:   '#B85B08',
        ivory:    '#FDFAF2',
      },
      fontFamily: {
        serif: ['Cormorant Garamond','Playfair Display','serif'],
        display: ['Playfair Display','serif'],
        sans: ['Inter','sans-serif'],
        deva: ['Noto Serif Devanagari','serif'],
      },
      boxShadow: {
        sm: '0 2px 12px rgba(122,30,18,.06)',
        md: '0 10px 30px rgba(122,30,18,.10)',
      },
    }
  },
  corePlugins: { preflight: false }   // keep our own reset; avoid clobbering components
}
</script>

<style>
/* ── Reset ── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility}
body{background-color:#FDFAF2;color:#1A0900;font-family:'Inter',sans-serif;overflow-x:hidden;min-height:100vh;font-size:16px;line-height:1.6}
/* living warm aurora — slow drifting glow behind everything */
body::before{content:'';position:fixed;inset:-20%;z-index:-2;pointer-events:none;
  background:
    radial-gradient(38% 46% at 18% 22%, rgba(196,146,10,.13), transparent 60%),
    radial-gradient(42% 52% at 84% 28%, rgba(184,91,8,.11), transparent 62%),
    radial-gradient(48% 50% at 70% 92%, rgba(122,30,18,.08), transparent 66%),
    radial-gradient(40% 44% at 30% 80%, rgba(200,160,16,.04), transparent 64%);
  background-repeat:no-repeat;background-size:160% 160%;
  animation:auroraDrift 26s ease-in-out infinite alternate}
body::after{display:none}
@keyframes auroraDrift{0%{background-position:0% 0%,100% 0%,50% 100%,0% 100%}50%{background-position:60% 40%,40% 60%,80% 50%,40% 30%}100%{background-position:100% 100%,0% 100%,20% 0%,100% 70%}}
a{text-decoration:none;color:inherit}
img{display:block;max-width:100%}
button{font-family:inherit;cursor:pointer}

/* ── Design tokens ── */
:root{
  --bg:      #FFFFFF;
  --gold:    #B07D08;
  --gold2:   #8A6206;
  --saffron: #B85B08;
  --maroon:  #7A1E12;
  --rose:    #B0566A;
  --marigold:#C8A010;
  --ink:     #130700;
  --ink2:    #3A1C04;
  --muted:   #6B4A28;
  --faint:   #9A7A50;
  --line:    #EDE5D8;
  --cream:   #F8F2E8;
  --peach:   #FFF3E8;
  --blush:   #FFF0F4;
  --butter:  #FFFBEE;
  --sage:    #F0F6EE;
  --rust:    #C4920A;
  --rust2:   #A07808;
  --dark:    #FFF3E8;
}

/* ── Keyframes ── */
@keyframes fadeUp  {from{opacity:0;transform:translateY(28px)}to{opacity:1;transform:none}}
@keyframes fadeIn  {from{opacity:0}to{opacity:1}}
@keyframes spinSlow{to{transform:translate(-50%,-50%) rotate(360deg)}}
@keyframes shimmer {0%{transform:translateX(-110%)}100%{transform:translateX(110%)}}
@keyframes scaleIn {from{opacity:0;transform:scale(.98)}to{opacity:1;transform:scale(1)}}
@keyframes petal   {0%{opacity:0;transform:translateY(0) rotate(0deg) scale(1)}15%{opacity:.6}85%{opacity:.15}100%{opacity:0;transform:translateY(-160px) rotate(270deg) scale(.4)}}
@keyframes pulse   {0%,100%{transform:scale(1);opacity:.7}50%{transform:scale(1.08);opacity:1}}
/* ── Pooja / aarti animations ── */
@keyframes flicker {0%,100%{transform:scale(1) rotate(-1deg);opacity:1}25%{transform:scale(1.06,.97) rotate(1.5deg);opacity:.92}50%{transform:scale(.97,1.05) rotate(-1.5deg);opacity:1}75%{transform:scale(1.04,.99) rotate(1deg);opacity:.95}}
@keyframes haloBreathe{0%,100%{opacity:.45;transform:translate(-50%,-50%) scale(1)}50%{opacity:.85;transform:translate(-50%,-50%) scale(1.12)}}
@keyframes ember   {0%{opacity:0;transform:translateY(0) translateX(0) scale(1)}12%{opacity:1}70%{opacity:.5}100%{opacity:0;transform:translateY(-220px) translateX(var(--drift,12px)) scale(.3)}}
@keyframes sway    {0%,100%{transform:rotate(-3deg)}50%{transform:rotate(3deg)}}
@keyframes omFloat {0%,100%{transform:translate(-50%,-50%) rotate(0deg)}50%{transform:translate(-50%,-52%) rotate(2deg)}}
@keyframes ringSpin{to{transform:translate(-50%,-50%) rotate(360deg)}}
@keyframes ripple  {0%{transform:translate(-50%,-50%) scale(.55);opacity:.55}100%{transform:translate(-50%,-50%) scale(1.5);opacity:0}}
@keyframes pendulum{0%,100%{transform:rotate(-5deg)}50%{transform:rotate(5deg)}}

/* ── Marigold toran flowers + mango leaves ── */
.toran{position:absolute;top:0;left:0;right:0;display:flex;justify-content:center;align-items:flex-start;gap:12px;pointer-events:none;z-index:1}
.toran .hang{transform-origin:top center;animation:pendulum 3.4s ease-in-out infinite;display:flex;flex-direction:column;align-items:center}
.toran .str{width:1.5px;background:linear-gradient(#9A6A38,#C28A3A);opacity:.6}
.marigold{width:17px;height:17px;border-radius:50%;
  background:
    radial-gradient(circle at 50% 50%,#B5600E 0 16%,transparent 17%),
    repeating-conic-gradient(from 0deg,#F6A828 0deg 22.5deg,#DE860F 22.5deg 45deg);
  box-shadow:inset 0 0 0 1px rgba(150,75,8,.35),0 1px 3px rgba(150,75,8,.4)}
.marigold.sm{width:13px;height:13px}
.mleaf{width:11px;height:18px;border-radius:0 100% 0 100%;background:linear-gradient(150deg,#4E8C3A,#2E6A28);box-shadow:0 1px 2px rgba(30,70,30,.3);transform:rotate(8deg)}

/* floating clickable hero chips */
.float-chip:hover{transform:translateY(-4px);box-shadow:0 22px 50px rgba(122,30,18,.24)}
/* clickable shrine card */
.shrine-card:hover{transform:translateY(-5px);box-shadow:0 40px 90px rgba(122,30,18,.2)}
.shrine-card .shrine-hint{transition:opacity .25s,transform .25s}
.shrine-card:hover .shrine-hint{opacity:1;transform:translateX(2px)}

/* ── Restored inner-page components (were in old layout) ── */
.nudge-card{background:linear-gradient(135deg,#7A1E12 0%,#A83410 100%);color:#fff;box-shadow:0 10px 30px rgba(122,30,18,.18)}

/* ── Category page heroes ── */
.cat-purohit,.cat-bhajan,.cat-ritual,.cat-panchang{
  position:relative;overflow:hidden;
  border:none!important;border-radius:0!important;margin:0!important;box-shadow:none!important;
  padding:44px 28px 36px!important;
}
.cat-purohit{background:linear-gradient(135deg,#3A0A06 0%,#6E1810 55%,#9A3010 100%)!important}
.cat-bhajan {background:linear-gradient(135deg,#1A0844 0%,#3A1480 55%,#5A1E90 100%)!important}
.cat-ritual {background:linear-gradient(135deg,#0E2A14 0%,#1C5228 55%,#2E6E38 100%)!important}
.cat-panchang{background:linear-gradient(135deg,#1A1A08 0%,#3A3200 55%,#5A4A08 100%)!important}
/* decorative glow blob */
.cat-purohit::before,.cat-bhajan::before,.cat-ritual::before,.cat-panchang::before{
  content:'';position:absolute;right:-60px;top:-60px;width:220px;height:220px;border-radius:50%;opacity:.18;pointer-events:none}
.cat-purohit::before{background:radial-gradient(circle,#FBC04A,transparent 70%)}
.cat-bhajan::before{background:radial-gradient(circle,#A070FF,transparent 70%)}
.cat-ritual::before{background:radial-gradient(circle,#60D890,transparent 70%)}
.cat-panchang::before{background:radial-gradient(circle,#FFD060,transparent 70%)}
/* force text inside heroes to white, but not colored CTA buttons */
.cat-purohit p,.cat-purohit h1,.cat-purohit h2,.cat-purohit span,.cat-purohit svg,
.cat-bhajan p,.cat-bhajan h1,.cat-bhajan h2,.cat-bhajan span,.cat-bhajan svg,
.cat-ritual p,.cat-ritual h1,.cat-ritual h2,.cat-ritual span,.cat-ritual svg,
.cat-panchang p,.cat-panchang h1,.cat-panchang h2,.cat-panchang span,.cat-panchang svg{color:#fff!important}
.cat-purohit .text-saffron,.cat-bhajan .text-saffron,.cat-ritual .text-saffron,.cat-panchang .text-saffron{color:rgba(255,255,255,.6)!important}
.cat-purohit .text-ashgray,.cat-bhajan .text-ashgray,.cat-ritual .text-ashgray,.cat-panchang .text-ashgray{color:rgba(255,255,255,.55)!important}
@media(max-width:640px){
  .cat-purohit,.cat-bhajan,.cat-ritual,.cat-panchang{padding:32px 20px 26px!important}
}

/* ── Mobile tuning — kill big gaps, tighten rhythm ── */
@media(max-width:640px){
  .hero-sec{padding:22px 18px 32px!important;text-align:center}
  .hero-sec .h-badge{margin-bottom:14px!important;padding:7px 16px 7px 12px!important}
  .hero-sec .h-h1{font-size:2rem!important;margin-bottom:12px!important;line-height:1.1!important}
  .hero-sec .h-sub{font-size:1rem!important;margin-bottom:20px!important;line-height:1.6!important}
  .hero-sec .h-btns{gap:10px!important;margin-bottom:22px!important;justify-content:center!important}
  .hero-sec .h-btns a{padding:12px 22px!important;font-size:.8rem!important}
  .hero-sec .h-stats{padding:12px 18px!important;flex-wrap:nowrap!important}
  .hero-sec .h-stats .stat-num{font-size:1.4rem!important}
  .hero-sec .om-mark{font-size:clamp(120px,50vw,180px)!important}
  .om-mark{font-size:200px!important;left:50%!important;opacity:.55}
  main > section{padding-top:46px!important;padding-bottom:46px!important;padding-left:18px!important;padding-right:18px!important}
  .inner-shell{padding:6px 0 44px!important}
  .cat-purohit,.cat-bhajan,.cat-ritual,.cat-panchang{padding:32px 20px 26px!important;margin:0!important;border-radius:0!important}
  footer{margin-top:32px!important}
  footer > div{padding:40px 22px 0!important}
  /* account inner pages */
  .acct-outer{padding:14px 14px 80px!important}
  .acct-page-head{margin-bottom:16px!important}
  .acct-page-title{font-size:1.15rem!important}
  .bk-meta{grid-template-columns:1fr 1fr!important}
}
.lotus-card{position:relative;overflow:hidden;transition:box-shadow .2s,transform .2s;border-radius:16px!important;box-shadow:0 1px 4px rgba(0,0,0,.04)}
.lotus-card:hover{transform:translateY(-3px);box-shadow:0 16px 40px rgba(0,0,0,.1)!important;border-color:#C8A47A!important}
.chip{display:inline-flex;align-items:center;gap:5px;font-size:.72rem;font-weight:700;padding:4px 11px;border-radius:50px;background:var(--cream);color:var(--ink2);border:1px solid var(--line)}
/* inner-page reveal — gentle staggered entrance (visible by default) */
.reveal{animation:fadeUp .6s cubic-bezier(.22,1,.36,1) both}
.inner-shell .reveal:nth-child(1){animation-delay:.04s}
.inner-shell .reveal:nth-child(2){animation-delay:.10s}
.inner-shell .reveal:nth-child(3){animation-delay:.16s}
.inner-shell .reveal:nth-child(4){animation-delay:.22s}
.inner-shell .reveal:nth-child(5){animation-delay:.28s}
.inner-shell .reveal:nth-child(6){animation-delay:.34s}
.inner-shell .reveal:nth-child(7){animation-delay:.40s}
.inner-shell .reveal:nth-child(8){animation-delay:.46s}

/* ── Scroll reveal ── */
[data-sr]{opacity:0;transform:translateY(28px);transition:opacity .72s cubic-bezier(.22,1,.36,1),transform .72s cubic-bezier(.22,1,.36,1)}
[data-sr].in{opacity:1;transform:none}
[data-sr][data-d="1"]{transition-delay:.1s}
[data-sr][data-d="2"]{transition-delay:.2s}
[data-sr][data-d="3"]{transition-delay:.3s}
[data-sr][data-d="4"]{transition-delay:.4s}
[data-sr][data-d="5"]{transition-delay:.5s}

/* ── Type scale ── */
.f-display{font-family:'Cormorant Garamond',serif;font-weight:700;line-height:1.05;letter-spacing:-.01em}
.f-head   {font-family:'Cormorant Garamond',serif;font-weight:700;line-height:1.15}
.f-serif  {font-family:'Cormorant Garamond',serif}
.f-playfair{font-family:'Playfair Display',serif}
.f-eye    {font-size:.6875rem;font-weight:800;letter-spacing:.22em;text-transform:uppercase;color:var(--gold2)}
.f-body   {font-size:.9375rem;line-height:1.8;color:var(--ink2)}
.f-small  {font-size:.875rem;line-height:1.7;color:var(--ink2)}
.f-cap    {font-size:.78rem;line-height:1.5;color:var(--muted)}

/* ── NAV ── */
.nav-root{
  position:sticky;top:0;z-index:100;height:62px;
  background:rgba(255,255,255,0.96);
  border-bottom:1px solid #EDE5D8;
  backdrop-filter:blur(12px);
  transition:box-shadow .25s
}
.nav-root.sh{box-shadow:0 4px 24px rgba(0,0,0,.07)}
.nav-inner{max-width:1240px;margin:0 auto;padding:0 24px;height:100%;display:flex;align-items:center;justify-content:space-between;gap:20px}

/* wordmark */
.wordmark{display:flex;flex-direction:column;align-items:flex-start;line-height:1;text-decoration:none}
.wordmark-name{font-family:'Cormorant Garamond',serif;font-weight:700;font-size:1.25rem;color:#7A1E12;letter-spacing:.01em}
.wordmark-sub{font-size:.48rem;letter-spacing:.26em;text-transform:uppercase;color:#B0906A;margin-top:4px}

/* nav links */
.nav-links{display:none;align-items:center;gap:32px}
.nav-link{font-size:.8125rem;font-weight:500;color:var(--muted);letter-spacing:.02em;position:relative;padding:4px 0;transition:color .2s}
.nav-link::after{content:'';position:absolute;left:0;bottom:-2px;width:0;height:1.5px;background:var(--gold);border-radius:2px;transition:width .28s ease}
.nav-link:hover,.nav-link.on{color:var(--gold2)}
.nav-link:hover::after,.nav-link.on::after{width:100%}
@media(min-width:1024px){.nav-links{display:flex}}

/* ── Buttons — premium rectangles, not pills ── */
.btn{display:inline-flex;align-items:center;gap:8px;font-size:.8125rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;border:none;cursor:pointer;transition:all .25s;text-decoration:none;position:relative;overflow:hidden;border-radius:4px}
.btn::after{content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(255,255,255,.18),transparent);transform:translateX(-110%);transition:transform .55s ease}
.btn:hover::after{transform:translateX(110%)}
.btn-gold{background:var(--gold);color:#fff;padding:13px 32px}
.btn-gold:hover{background:var(--gold2);transform:translateY(-2px);box-shadow:0 8px 32px rgba(196,146,10,.3)}
.btn-outline{background:transparent;color:var(--gold);border:1.5px solid var(--gold);padding:11px 30px}
.btn-outline:hover{background:var(--gold);color:#fff;transform:translateY(-2px)}
.btn-ghost{background:none;border:none;padding:0;font-size:.8125rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;color:var(--gold)}
.btn-ghost:hover{color:var(--gold2)}
/* backward compat */
.btn-ink{background:var(--gold);color:#fff;padding:13px 32px;border-radius:4px}
.btn-ink:hover{background:var(--gold2);transform:translateY(-2px);box-shadow:0 8px 32px rgba(196,146,10,.3)}
.btn-primary{background:var(--gold);color:#fff;padding:13px 32px}
.btn-primary:hover{background:var(--gold2);transform:translateY(-2px);box-shadow:0 8px 32px rgba(196,146,10,.3)}
.btn-accent{background:var(--saffron);color:#fff;padding:13px 32px}
.btn-accent:hover{background:var(--gold);transform:translateY(-2px)}
.btn-line{background:transparent;color:var(--gold);border:1.5px solid var(--gold);padding:11px 30px;border-radius:4px}
.btn-line:hover{background:var(--gold);color:#fff}

/* ── Cards ── */
.card{background:#fff;border:1px solid #EDE5D8;border-radius:16px;overflow:hidden;transition:box-shadow .22s,transform .22s;box-shadow:0 1px 4px rgba(0,0,0,.04)}
.card:hover{box-shadow:0 12px 40px rgba(0,0,0,.1);transform:translateY(-4px)}

/* ── Tags ── */
.tag{display:inline-block;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:3px 10px;border-radius:3px}
.tag-gold   {background:#FFF3DC;color:#8A6200;border:1px solid #E8D080}
.tag-peach  {background:#FFF3E8;color:#8A4800;border:1px solid #E8C8A0}
.tag-rose   {background:#FFF0F4;color:#8A3048;border:1px solid #E8B8C8}
.tag-sage   {background:#F0F6EE;color:#2A5A28;border:1px solid #B0D0A8}

/* ── Form fields ── */
.field{width:100%;padding:13px 16px;border-radius:6px;border:1.5px solid var(--line);background:#fff;font-size:.9375rem;color:var(--ink);font-family:'Inter',sans-serif;outline:none;transition:border-color .22s,box-shadow .22s}
.field:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(196,146,10,.1)}
.field::placeholder{color:var(--faint)}

/* OTP */
.otp-d{flex:1;max-width:48px;aspect-ratio:1;text-align:center;font-size:1.25rem;font-weight:700;border:1.5px solid var(--line);border-radius:6px;background:#fff;color:var(--ink);font-family:'Inter',sans-serif;outline:none;transition:all .22s}
.otp-d:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(196,146,10,.1);transform:scale(1.04)}
.otp-d.ok{border-color:var(--gold);background:var(--butter)}
@media(max-width:400px){.otp-d{max-width:38px;font-size:1rem}}

/* ── Mobile bottom nav ── */
.bnav{
  position:fixed;bottom:0;left:0;right:0;z-index:60;
  background:rgba(255,255,255,.97);
  backdrop-filter:blur(20px);
  border-top:1px solid #EDE5D8;
  box-shadow:0 -6px 24px rgba(0,0,0,.06);
  display:flex;
  padding-bottom:env(safe-area-inset-bottom,0px)
}
.bnav-i{
  flex:1;display:flex;flex-direction:column;align-items:center;gap:2px;
  padding:10px 2px 12px;
  color:#9A7A58;text-decoration:none;
  font-size:.54rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;
  transition:color .15s;position:relative
}
.bnav-i:active{opacity:.7}
.bnav-i.on{color:#7A1E12}
.bnav-i.on svg{filter:drop-shadow(0 0 6px rgba(122,30,18,.35))}
.bnav-i.on::before{
  content:'';position:absolute;top:6px;left:50%;transform:translateX(-50%);
  width:32px;height:32px;border-radius:10px;
  background:rgba(122,30,18,.08)
}
.bnav-i svg{position:relative;z-index:1}
@media(min-width:1024px){.bnav{display:none!important}}

/* ── Drawer ── */
.drw{position:fixed;top:0;right:0;bottom:0;z-index:200;width:min(300px,85vw);background:var(--bg);transform:translateX(100%);transition:transform .3s cubic-bezier(.22,1,.36,1);display:flex;flex-direction:column;border-left:1px solid var(--line)}
.drw.open{transform:none}
.scrim{position:fixed;inset:0;z-index:199;background:rgba(30,12,4,.3);opacity:0;pointer-events:none;transition:opacity .3s}
.scrim.open{opacity:1;pointer-events:all}

/* ── Account sidebar ── */
.sdb-link{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:6px;font-size:.875rem;font-weight:500;color:var(--ink2);transition:all .18s}
.sdb-link:hover{background:var(--cream);color:var(--gold)}
.sdb-link.on{background:var(--butter);color:var(--gold2);font-weight:600}

/* ── Dividers ── */
.rule  {height:1px;background:var(--line)}
.rule-g{height:1px;background:linear-gradient(90deg,transparent,var(--gold),transparent)}

/* ── Ornamental flourish divider ── */
.flourish{display:flex;align-items:center;justify-content:center;gap:13px;margin:18px auto 0}
.flourish::before,.flourish::after{content:'';width:52px;height:1.5px}
.flourish::before{background:linear-gradient(90deg,transparent,var(--gold))}
.flourish::after{background:linear-gradient(90deg,var(--gold),transparent)}
.flourish i{width:8px;height:8px;background:var(--gold);transform:rotate(45deg);box-shadow:0 0 0 4px rgba(176,125,8,.14);flex-shrink:0}
.flourish i::before{content:'';position:absolute}

/* ── Status ── */
.s-ok  {background:#ECFDF5;color:#065F46}
.s-wait{background:#FFFBEB;color:#92400E}
.s-no  {background:#FEF2F2;color:#991B1B}

/* ── Page entrance ── */
main{animation:scaleIn .45s cubic-bezier(.22,1,.36,1)}
.nav-root{animation:fadeIn .35s ease}

/* ── Scrollbar ── */
::-webkit-scrollbar{width:4px}
::-webkit-scrollbar-thumb{background:var(--gold);border-radius:4px;opacity:.4}

/* ── Shake/spin ── */
@keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-5px)}75%{transform:translateX(5px)}}
.shake{animation:shake .3s ease}
@keyframes spin{to{transform:rotate(360deg)}}

/* ── Swiper ── */
.swiper-pagination-bullet{background:rgba(196,146,10,.3)!important;opacity:1!important;width:5px!important;height:5px!important}
.swiper-pagination-bullet-active{background:var(--gold)!important;width:18px!important;border-radius:3px!important}
</style>
</head>
<body>

<!-- SVG icons -->
<svg style="display:none" xmlns="http://www.w3.org/2000/svg">
  <symbol id="ic-flame" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2c0 0 4.5 5 4.5 9a4.5 4.5 0 01-9 0C7.5 7 12 2 12 2z"/><path d="M12 14c0 0 2 1.5 2 3a2 2 0 01-4 0c0-1.5 2-3 2-3z" fill="currentColor" stroke="none"/></symbol>
  <symbol id="ic-home" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12L12 3l9 9"/><path d="M9 21V12h6v9"/></symbol>
  <symbol id="ic-cal" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></symbol>
  <symbol id="ic-star" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.5 7H20l-5 3.5 2 6.5L12 15l-5 4 2-6.5L4 9h5.5z"/></symbol>
  <symbol id="ic-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1111.2 3 7 7 0 0021 12.8z"/></symbol>
  <symbol id="ic-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></symbol>
  <symbol id="ic-lotus" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21c-4 0-7-2.5-7-6 0 0 3 .5 4 2 0-3 1.5-6 3-8 1.5 2 3 5 3 8 1-1.5 4-2 4-2 0 3.5-3 6-7 6z"/></symbol>
  <symbol id="ic-download" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12m0 0l-4-4m4 4l4-4M4 19h16"/></symbol>
  <symbol id="ic-cart" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M3 3h2l2.4 12.3a2 2 0 002 1.7h7.7a2 2 0 002-1.7L23 6H6"/></symbol>
  <symbol id="ic-lock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 018 0v4"/></symbol>
  <symbol id="ic-clock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
  <symbol id="ic-pin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.2 7-11a7 7 0 10-14 0c0 5.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></symbol>
  <symbol id="ic-card" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></symbol>
  <symbol id="ic-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></symbol>
  <symbol id="ic-phone" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="2" width="12" height="20" rx="2"/><path d="M11 18h2"/></symbol>
  <symbol id="ic-chat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.5 8.5 0 01-12.3 7.6L3 21l1.9-5.7A8.5 8.5 0 1121 11.5z"/></symbol>
  <symbol id="ic-doc" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M9 13h6M9 17h6"/></symbol>
  <symbol id="ic-music" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></symbol>
  <symbol id="ic-user" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></symbol>
  <symbol id="ic-search" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></symbol>
  <symbol id="ic-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></symbol>
  <symbol id="ic-chevr" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></symbol>
  <symbol id="ic-book" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-4-7 4V5a2 2 0 012-2h10a2 2 0 012 2z"/></symbol>
  <symbol id="ic-bell" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></symbol>
  <symbol id="ic-globe" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></symbol>
  <symbol id="ic-shield" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></symbol>
  <symbol id="ic-out" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 16l4-4-4-4M21 12H9"/><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/></symbol>
</svg>

<!-- ═══ NAV ═══ -->
<header class="nav-root" id="navRoot">
  <div class="nav-inner">

    <a href="<?= base_url('/') ?>" class="wordmark">
      <span class="wordmark-name">The Tapa Co.</span>
      <span class="wordmark-sub">Sacred Rituals</span>
    </a>

    <nav class="nav-links">
      <?php
      $cur = current_url();
      foreach([['ritual-guides','Ritual Guides'],['panchang','Panchang'],['purohit-puja','Purohit & Puja'],['bhajan-mandali','Bhajan Mandali']] as [$sl,$lb]):
        $on = str_contains($cur, base_url($sl));
      ?>
      <a href="<?= base_url($sl) ?>" class="nav-link <?= $on?'on':'' ?>"><?= $lb ?></a>
      <?php endforeach; ?>
    </nav>

    <div style="display:flex;align-items:center;gap:10px">
      <a href="<?= base_url('search') ?>" style="display:none;width:34px;height:34px;align-items:center;justify-content:center;color:var(--muted);border-radius:50%;border:1px solid var(--line);transition:all .22s" id="deskSearch" onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'" onmouseout="this.style.borderColor='var(--line)';this.style.color='var(--muted)'">
        <svg width="14" height="14"><use href="#ic-search"/></svg>
      </a>

      <?php if(session()->get('user_id')): ?>
      <a href="<?= base_url('account') ?>">
        <div style="width:34px;height:34px;border-radius:50%;background:var(--gold);color:#fff;display:flex;align-items:center;justify-content:center;font-family:'Cormorant Garamond',serif;font-weight:700;font-size:.9375rem">
          <?= strtoupper(substr(session()->get('user_name') ?? 'D', 0, 1)) ?>
        </div>
      </a>
      <?php else: ?>
      <a href="<?= base_url('login') ?>" style="display:inline-flex;align-items:center;gap:7px;padding:9px 20px;font-size:.78rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:#7A1E12;color:#fff;border-radius:8px;text-decoration:none;transition:background .2s" onmouseover="this.style.background='#5A1008'" onmouseout="this.style.background='#7A1E12'">Login</a>
      <?php endif; ?>

      <button id="hamBtn" aria-label="Menu" style="display:flex;flex-direction:column;justify-content:center;gap:5px;width:34px;height:34px;border:1px solid var(--line);background:none;padding:7px;border-radius:50%;transition:border-color .22s" class="ham-vis" onmouseover="this.style.borderColor='var(--gold)'" onmouseout="this.style.borderColor='var(--line)'">
        <span class="hb" style="display:block;height:1.5px;background:var(--gold);border-radius:1px;transition:all .22s;width:16px"></span>
        <span class="hb" style="display:block;height:1.5px;background:var(--faint);border-radius:1px;transition:all .22s;width:10px;margin-left:6px"></span>
        <span class="hb" style="display:block;height:1.5px;background:var(--gold);border-radius:1px;transition:all .22s;width:16px"></span>
      </button>
    </div>
  </div>
</header>

<style>
@media(min-width:1024px){#deskSearch{display:flex!important}.ham-vis{display:none!important}}
#hamBtn.x .hb:nth-child(1){transform:rotate(45deg) translate(4px,4px)}
#hamBtn.x .hb:nth-child(2){opacity:0;width:0}
#hamBtn.x .hb:nth-child(3){transform:rotate(-45deg) translate(4px,-4px)}
</style>

<!-- ═══ DRAWER ═══ -->
<div class="scrim" id="scrim" onclick="closeNav()"></div>
<aside class="drw" id="drw">
  <div style="padding:20px 24px;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between">
    <a href="<?= base_url('/') ?>" class="wordmark"><span class="wordmark-name">The Tapa Co.</span><span class="wordmark-sub">Sacred Rituals</span></a>
    <button onclick="closeNav()" style="border:none;background:none;color:var(--muted);font-size:1rem;padding:4px">✕</button>
  </div>

  <div style="margin:16px;padding:16px;background:var(--cream);border-radius:8px;border:1px solid var(--line)">
    <p class="f-eye" style="margin-bottom:10px">Today's Panchang</p>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
      <?php foreach(['Tithi','Nakshatra','Paksha','Sunrise'] as $k): ?>
      <div>
        <span style="font-size:.62rem;color:var(--faint);display:block;text-transform:uppercase;letter-spacing:.1em"><?= $k ?></span>
        <strong id="dp<?= $k ?>" style="font-size:.875rem;color:var(--ink)">—</strong>
      </div>
      <?php endforeach; ?>
    </div>
    <a href="<?= base_url('panchang') ?>" style="display:block;margin-top:10px;font-size:.8rem;font-weight:600;color:var(--gold)">Full Panchang →</a>
  </div>

  <nav style="flex:1;overflow-y:auto;padding:6px 12px">
    <?php foreach([['/',  'Home'],['ritual-guides','Ritual Guides'],['panchang','Panchang'],['purohit-puja','Purohit & Puja'],['bhajan-mandali','Bhajan Mandali'],['subscribe','Subscribe — ₹99']] as [$h,$l]):
      $on = ($h==='/' ? rtrim($cur,'/') === rtrim(base_url('/'),'/') : str_contains($cur, base_url($h)));
    ?>
    <a href="<?= base_url($h) ?>" class="sdb-link <?= $on?'on':'' ?>" style="margin-bottom:2px"><?= $l ?></a>
    <?php endforeach; ?>
  </nav>

  <div style="padding:12px;border-top:1px solid var(--line)">
    <?php if(session()->get('user_id')): ?>
    <a href="<?= base_url('account') ?>" class="sdb-link" style="margin-bottom:2px">My Account</a>
    <a href="<?= base_url('logout') ?>" style="display:block;padding:10px 14px;font-size:.875rem;color:#B91C1C;border-radius:6px;transition:background .2s" onmouseover="this.style.background='#FEF2F2'" onmouseout="this.style.background='transparent'">Log out</a>
    <?php else: ?>
    <a href="<?= base_url('login') ?>" class="btn btn-gold" style="width:100%;justify-content:center">Sign in</a>
    <?php endif; ?>
  </div>
</aside>

<!-- ═══ MAIN ═══ -->
<?php
  $path   = trim(str_replace(rtrim(base_url(),'/'), '', current_url()), '/');
  $isHome = ($path === '' || $path === 'index.php');
?>
<main style="min-height:calc(100vh - 66px);padding-bottom:72px" id="mainWrap">
  <?php if($isHome): ?>
    <?= $this->renderSection('content') ?>
  <?php else: ?>
    <div class="inner-shell"><?= $this->renderSection('content') ?></div>
  <?php endif; ?>
</main>
<style>
@media(min-width:1024px){#mainWrap{padding-bottom:0}}
/* constrain mobile-first inner pages into a tidy centred column on desktop */
.inner-shell{max-width:960px;margin:0 auto;padding:18px 0 64px}
/* turn long full-width list rows into a grid of rectangular cards */
.card-grid{display:grid;grid-template-columns:1fr;gap:16px}
.card-grid>*{margin-top:0!important}
@media(min-width:640px){.card-grid{grid-template-columns:1fr 1fr}.card-grid .col-span-full{grid-column:1/-1}}
.inner-shell .lotus-card,.inner-shell .reveal{will-change:transform}
</style>

<!-- ═══ FOOTER ═══ -->
<footer style="background:linear-gradient(160deg,#4A0E08 0%,#6E1A10 40%,#8A3008 100%);margin-top:0;position:relative;overflow:hidden">
  <!-- top divider wave -->
  <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,transparent,#FBC04A 30%,#C4920A 60%,transparent)"></div>

  <div style="max-width:1200px;margin:0 auto;padding:56px 32px 0;position:relative">

    <div class="ft-grid" style="display:grid;grid-template-columns:1fr;gap:44px">

      <!-- Brand -->
      <div>
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px">
          <span style="width:44px;height:44px;border-radius:12px;background:rgba(251,192,74,.18);border:1px solid rgba(251,192,74,.3);display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <svg width="22" height="22" fill="none" stroke="#FBC04A" stroke-width="1.5" viewBox="0 0 24 24"><use href="#ic-flame"/></svg>
          </span>
          <span style="font-family:'Cormorant Garamond',serif;font-weight:700;font-size:1.5rem;color:#FBC04A">The Tapa Co.</span>
        </div>
        <p style="font-size:.9rem;color:rgba(255,232,194,.75);line-height:1.8;margin-bottom:22px;max-width:300px">Bringing ancient wisdom into everyday life — verified pandits, authentic guides and daily panchang.</p>
        <!-- social icons -->
        <div style="display:flex;gap:10px;margin-bottom:6px">
          <?php foreach([['ic-globe','Website'],['ic-music','Bhajan'],['ic-bell','Subscribe']] as [$si,$sl]): ?>
          <a href="<?= base_url($si==='ic-bell'?'subscribe':($si==='ic-music'?'bhajan-mandali':'#')) ?>" title="<?= $sl ?>"
             style="width:40px;height:40px;border-radius:10px;border:1px solid rgba(251,192,74,.25);background:rgba(251,192,74,.08);display:flex;align-items:center;justify-content:center;color:rgba(251,192,74,.7);transition:all .22s"
             onmouseover="this.style.background='rgba(251,192,74,.22)';this.style.borderColor='rgba(251,192,74,.6)';this.style.color='#FBC04A'"
             onmouseout="this.style.background='rgba(251,192,74,.08)';this.style.borderColor='rgba(251,192,74,.25)';this.style.color='rgba(251,192,74,.7)'">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><use href="#<?= $si ?>"/></svg>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Link columns -->
      <div class="ft-cols" style="display:grid;grid-template-columns:1fr 1fr;gap:32px">
        <?php foreach([
          ['Explore',[['ritual-guides','Ritual Guides'],['panchang','Panchang'],['purohit-puja','Purohit & Puja'],['bhajan-mandali','Bhajan Mandali']]],
          ['Account',[['account','My Account'],['account/bookings','My Bookings'],['account/saved','Saved Guides'],['search','Search']]],
        ] as [$h,$ls]): ?>
        <div>
          <p style="font-size:.6rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;color:#FBC04A;margin-bottom:16px"><?= $h ?></p>
          <?php foreach($ls as [$lh,$ll]): ?>
          <a href="<?= base_url($lh) ?>" style="display:block;font-size:.9rem;font-weight:500;color:rgba(255,232,194,.7);padding:6px 0;transition:color .2s,padding-left .2s"
             onmouseover="this.style.color='#FBC04A';this.style.paddingLeft='6px'"
             onmouseout="this.style.color='rgba(255,232,194,.7)';this.style.paddingLeft='0'"><?= $ll ?></a>
          <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Subscribe card -->
      <div style="background:rgba(251,192,74,.1);border:1px solid rgba(251,192,74,.25);border-radius:18px;padding:26px">
        <p style="font-size:.6rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;color:#FBC04A;margin-bottom:10px">Daily on WhatsApp</p>
        <h4 style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:700;color:#fff;line-height:1.25;margin-bottom:8px">Never miss a tithi or vrat</h4>
        <p style="font-size:.85rem;color:rgba(255,232,194,.7);line-height:1.6;margin-bottom:18px">Panchang, reminders & guides — just ₹99 a year.</p>
        <a href="<?= base_url('subscribe') ?>" style="display:inline-flex;align-items:center;gap:8px;background:#FBC04A;color:#5A0E08;font-size:.78rem;font-weight:800;letter-spacing:.04em;text-transform:uppercase;padding:12px 22px;border-radius:8px;text-decoration:none;transition:background .2s"
           onmouseover="this.style.background='#FFD060'"
           onmouseout="this.style.background='#FBC04A'">Subscribe ₹99 <svg width="13" height="13" stroke="currentColor" stroke-width="2.4" fill="none" viewBox="0 0 24 24"><use href="#ic-arrow"/></svg></a>
      </div>
    </div>

    <!-- Bottom bar -->
    <div style="margin-top:44px;border-top:1px solid rgba(251,192,74,.15);padding:22px 0;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px">
      <span style="font-size:.8rem;color:rgba(255,232,194,.5)">© <?= date('Y') ?> The Tapa Co. · Made with devotion in India 🇮🇳</span>
      <div style="display:flex;flex-wrap:wrap;gap:22px">
        <?php foreach(['Privacy Policy','Terms of Service','Contact'] as $t): ?>
        <a href="#" style="font-size:.8rem;font-weight:500;color:rgba(255,232,194,.5);transition:color .2s"
           onmouseover="this.style.color='#FBC04A'"
           onmouseout="this.style.color='rgba(255,232,194,.5)'"><?= $t ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</footer>
<style>
@media(min-width:880px){.ft-grid{grid-template-columns:1.2fr 1fr .9fr!important;gap:52px!important}}
@media(max-width:640px){footer{margin-top:0!important}.ft-cols{grid-template-columns:1fr 1fr!important}}
</style>

<!-- ═══ BOTTOM NAV ═══ -->
<nav class="bnav">
  <?php
  $items=[['/','/','Home','ic-home'],['panchang','cal','Panchang','ic-cal'],['purohit-puja','puja','Puja','ic-star'],['bhajan-mandali','bh','Bhajan','ic-music'],['account','acc','Account','ic-user']];
  foreach($items as [$href,$key,$lbl,$icon]):
    $on=($href==='/'?rtrim($cur,'/')===rtrim(base_url('/'),'/'):str_contains($cur,base_url($href)));
  ?>
  <a href="<?= base_url($href) ?>" class="bnav-i <?= $on?'on':'' ?>">
    <svg width="19" height="19"><use href="#<?= $icon ?>"/></svg>
    <?= $lbl ?>
  </a>
  <?php endforeach; ?>
</nav>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
const navRoot=document.getElementById('navRoot');
window.addEventListener('scroll',()=>navRoot.classList.toggle('sh',scrollY>6),{passive:true});
const hamBtn=document.getElementById('hamBtn'),drw=document.getElementById('drw'),scrim=document.getElementById('scrim');
function openNav(){drw.classList.add('open');scrim.classList.add('open');hamBtn.classList.add('x');document.body.style.overflow='hidden';loadPan()}
function closeNav(){drw.classList.remove('open');scrim.classList.remove('open');hamBtn.classList.remove('x');document.body.style.overflow=''}
hamBtn.addEventListener('click',()=>drw.classList.contains('open')?closeNav():openNav());
function loadPan(){
  fetch('<?= base_url('panchang/today-json') ?>').then(r=>r.json()).then(d=>{
    const m={Tithi:d.tithi,Nakshatra:d.nakshatra,Paksha:d.paksha,Sunrise:d.sunrise_time||d.sunrise};
    Object.entries(m).forEach(([k,v])=>{const el=document.getElementById('dp'+k);if(el)el.textContent=v||'—'});
  }).catch(()=>{});
}
loadPan();
(function(){
  const obs=new IntersectionObserver(entries=>{
    entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');obs.unobserve(e.target)}});
  },{threshold:.05,rootMargin:'0px 0px -20px 0px'});
  document.querySelectorAll('[data-sr]').forEach(el=>{
    const r=el.getBoundingClientRect();
    if(r.top<window.innerHeight&&r.bottom>0){el.style.transition='none';el.classList.add('in')}
    else obs.observe(el);
  });
})();
</script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
