<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12 text-center">
    <!-- Celebration -->
    <div class="relative mb-6">
        <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto animate-float" style="background:linear-gradient(150deg,#7A1E12,#B85B08);box-shadow:0 16px 40px rgba(122,30,18,.25)"><svg width="44" height="44" fill="none" stroke="#FBC04A" stroke-width="1.4" viewBox="0 0 24 24"><use href="#ic-flame"/></svg></div>
        <div class="absolute -top-1 -right-1 w-9 h-9 rounded-full flex items-center justify-center" style="background:#1E7A3C"><svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2.4" viewBox="0 0 24 24"><use href="#ic-check"/></svg></div>
    </div>

    <h1 class="font-serif text-2xl font-bold text-deepmar mb-2">You&rsquo;re Subscribed!</h1>
    <p class="text-ashgray text-sm mb-1">Welcome to The Tapa Co. sacred community</p>
    <p class="text-saffron text-xs font-semibold">Active until <?= esc($expires_at) ?></p>

    <!-- What happens next -->
    <div class="w-full max-w-sm mt-6 gold-border rounded-2xl bg-white shadow-xl p-5 text-left mb-6">
        <p class="text-xs font-semibold text-ashgray uppercase tracking-widest mb-3">What happens next</p>
        <div class="space-y-3">
            <?php
            $steps = [
                ['ic-chat', 'Welcome message on WhatsApp', 'Check your WhatsApp shortly'],
                ['ic-sun', 'Daily panchang starts tomorrow', 'Tithi, nakshatra & muhurat'],
                ['ic-moon', 'Vrat reminders begin', '3 days before every vrat'],
            ];
            foreach ($steps as [$icon, $h, $s]): ?>
            <div class="flex items-start gap-3 reveal">
                <span class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#B85B0814;color:var(--saffron)"><svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><use href="#<?= $icon ?>"/></svg></span>
                <div>
                    <p class="font-semibold text-deepmar text-sm"><?= $h ?></p>
                    <p class="text-ashgray text-xs"><?= $s ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="w-full max-w-sm space-y-2">
        <a href="<?= base_url('/') ?>"
           class="block text-center bg-saffron text-white font-bold py-3.5 rounded-2xl active:scale-95 transition-all text-sm">
            Back to Home
        </a>
        <a href="<?= base_url('account') ?>"
           class="block text-center text-ashgray text-sm py-3 border border-goldleaf/20 rounded-2xl hover:border-saffron/40 hover:text-saffron transition-colors">
            View My Account
        </a>
    </div>
</div>

<?= $this->endSection() ?>
