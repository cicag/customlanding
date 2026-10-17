<?php
$raw = @file_get_contents(__DIR__ . '/../src/data.json');
$data = ($raw !== false) ? json_decode($raw, true) : null;
if (!is_array($data)) { $data = array(); }

$e = function ($value, $default = '') {
    return htmlspecialchars((string)($value ?? $default), ENT_QUOTES, 'UTF-8');
};

$safeHref = function ($url) {
    $url = trim((string)$url);
    if ($url === '') {
        return '';
    }
    $lower = strtolower($url);
    if (preg_match('#^(https?:|mailto:|tel:)#', $lower)) {
        return $url;
    }
    if (preg_match('#^[a-z][a-z0-9+.\-]*:#', $lower)) {
        return '';
    }
    return 'https://' . $url;
};

$company    = isset($data['Company'])   && is_array($data['Company'])   ? $data['Company']   : array();
$nav        = isset($data['Nav'])       && is_array($data['Nav'])       ? $data['Nav']       : array();
$features   = isset($data['Features'])  && is_array($data['Features'])  ? $data['Features']  : array();
$offerings  = isset($data['Offerings']) && is_array($data['Offerings']) ? $data['Offerings'] : array();
$services   = isset($offerings['services']) && is_array($offerings['services']) ? $offerings['services'] : array();
$legal      = isset($data['Legalitas']) && is_array($data['Legalitas']) ? $data['Legalitas'] : array();
$legalItems = isset($legal['items']) && is_array($legal['items']) ? $legal['items'] : array();
$contact    = isset($data['Contact'])   && is_array($data['Contact'])   ? $data['Contact']   : array();
$footer     = isset($data['Footer'])    && is_array($data['Footer'])    ? $data['Footer']    : array();

$wa = preg_replace('/[^0-9]/', '', (string)($contact['whatsapp'] ?? ''));
if ($wa === '') {
    $wa = preg_replace('/[^0-9]/', '', (string)($contact['phone'] ?? ''));
}
$contactHref = ($wa !== '')
    ? 'https://wa.me/' . $wa
    : 'mailto:' . (string)($contact['email'] ?? '');

$mapEmbed = trim((string)($contact['map_embed'] ?? ''));

$footerText = str_replace('{year}', date('Y'), (string)($footer['text'] ?? ''));
$brandName  = (string)($company['name'] ?? 'Landing Page');
$headerName = trim((string)($company['header_name'] ?? '')) !== '' ? (string)$company['header_name'] : $brandName;
$heroName   = trim((string)($company['hero_name'] ?? '')) !== '' ? (string)$company['hero_name'] : $brandName;
$logo       = (string)($company['logo'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#111827" />
  <link rel="icon" type="image/png" href="imgs/pavicon.png" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />
  <title><?= $e($brandName) ?></title>
  <meta name="description" content="<?= $e($company['description'] ?? '') ?>" />
  <meta name="author" content="<?= $e($brandName) ?>" />
</head>
<body>
  <a class="skip-link" href="#main">Lewati ke konten utama</a>

  <header class="site-header">
    <div class="container header-inner">
      <a class="brand" href="#top">
        <?php if ($logo !== ''): ?>
          <img class="brand__img" src="<?= $e($logo) ?>" alt="<?= $e($headerName) ?>" />
        <?php else: ?>
          <span class="brand__mark" aria-hidden="true"><i class="<?= $e($company['logo_icon'] ?? 'fa fa-leaf') ?>"></i></span>
        <?php endif; ?>
        <span class="brand__name"><?= $e($headerName) ?></span>
      </a>

      <button type="button" class="nav-toggle" aria-expanded="false" aria-controls="primary-nav" aria-label="Buka menu navigasi">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </button>

      <nav id="primary-nav" class="primary-nav" aria-label="Navigasi utama">
        <ul class="nav-list">
          <li><a href="#layanan"><?= $e($nav['services'] ?? 'Layanan') ?></a></li>
          <li><a href="#legalitas"><?= $e($nav['legal'] ?? 'Legalitas') ?></a></li>
          <li><a href="#kontak" class="btn-flat btn-flat--primary btn-flat--sm"><?= $e($nav['contact'] ?? 'Kontak Kami') ?></a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="main">
    <section id="top" class="hero">
      <div class="container">
        <div class="hero__inner">
          <div class="hero__content">
            <span class="eyebrow"><?= $e($company['tagline'] ?? '') ?></span>
            <h1 class="hero__title"><?= $e($heroName) ?></h1>
            <p class="hero__motto"><?= $e($company['motto'] ?? '') ?></p>
            <p class="hero__desc"><?= $e($company['description'] ?? '') ?></p>
            <a href="#layanan" class="btn-flat btn-flat--inverse btn-flat--lg"><?= $e($nav['hero_button'] ?? 'Lihat Layanan Kami') ?></a>
          </div>
          <?php $heroLogo = (string)($company['hero_logo'] ?? ''); ?>
          <div class="hero__logo<?= $heroLogo === '' ? ' hero__logo--empty' : '' ?>">
            <?php if ($heroLogo !== ''): ?>
              <img src="<?= $e($heroLogo) ?>" alt="Logo <?= $e($heroName) ?>" />
            <?php else: ?>
              <i class="<?= $e($company['logo_icon'] ?? 'fa fa-leaf') ?>" aria-hidden="true"></i>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <section id="keunggulan" class="section">
      <div class="container">
        <div class="features__box">
          <ul class="features__grid">
            <?php foreach ($features as $f): ?>
              <li class="feature">
                <span class="feature__icon"><i class="<?= $e($f['icon'] ?? '') ?>" aria-hidden="true"></i></span>
                <h3><?= $e($f['title'] ?? '') ?></h3>
                <p><?= $e($f['text'] ?? '') ?></p>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </section>

    <section id="layanan" class="section">
      <div class="container">
        <div class="section__head section__head--center">
          <h2><?= $e($offerings['title'] ?? 'Apa yang Kami Tawarkan') ?></h2>
          <?php if (trim((string)($offerings['description'] ?? '')) !== ''): ?>
            <span class="section__pill"><?= $e($offerings['description']) ?></span>
          <?php endif; ?>
          <?php if (trim((string)($offerings['sub_description'] ?? '')) !== ''): ?>
            <p class="section__sub"><?= $e($offerings['sub_description']) ?></p>
          <?php endif; ?>
        </div>
        <div class="offerings__list">
          <?php foreach ($services as $s): ?>
            <?php $points = isset($s['details']) && is_array($s['details']) ? $s['details'] : array(); ?>
            <details class="service" open>
              <summary class="service__summary">
                <span class="service__head">
                  <span class="service__name"><?= $e($s['name'] ?? '') ?></span>
                </span>
                <i class="fa fa-chevron-down service__caret" aria-hidden="true"></i>
              </summary>
              <div class="service__body">
                <?php if (!empty($points)): ?>
                  <ul class="service__points">
                    <?php foreach ($points as $d): ?>
                      <?php
                        $img  = trim((string)($d['image'] ?? ''));
                        $link = trim((string)($d['link'] ?? ''));
                        $href = $link !== '' ? $safeHref($link) : '';
                        $linkLabel = trim((string)($d['link_label'] ?? ''));
                        if ($linkLabel === '') {
                            $linkLabel = $link !== '' ? $link : 'Selengkapnya';
                        }
                      ?>
                      <li class="service__point<?= $img !== '' ? ' service__point--media' : '' ?>">
                        <?php if ($img !== ''): ?>
                          <button type="button" class="service__point-media" aria-label="Perbesar gambar: <?= $e($d['highlight'] ?? $s['name'] ?? '') ?>">
                            <img class="service__point-img" src="<?= $e($img) ?>" alt="<?= $e($d['highlight'] ?? $s['name'] ?? '') ?>" loading="lazy">
                          </button>
                        <?php endif; ?>
                        <div class="service__point-body">
                          <?php if (trim((string)($d['highlight'] ?? '')) !== ''): ?>
                            <span class="service__point-highlight"><?= $e($d['highlight']) ?></span>
                          <?php endif; ?>
                          <?php if (trim((string)($d['description'] ?? '')) !== ''): ?>
                            <p class="service__point-desc"><?= $e($d['description']) ?></p>
                          <?php endif; ?>
                          <?php if ($href !== ''): ?>
                            <a class="service__point-link" href="<?= $e($href) ?>"<?= preg_match('#^https?:#i', $href) ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>
                              <i class="fa fa-external-link" aria-hidden="true"></i>
                              <span><?= $e($linkLabel) ?></span>
                            </a>
                          <?php endif; ?>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </div>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section id="legalitas" class="section section--muted">
      <div class="container">
        <div class="section__head section__head--center">
          <h2><?= $e($legal['title'] ?? 'Legalitas') ?></h2>
          <p><?= $e($legal['description'] ?? '') ?></p>
        </div>
        <dl class="legal__grid">
          <?php foreach ($legalItems as $item): ?>
            <div class="legal__item">
              <dt class="legal__label">
                <span class="legal__icon" aria-hidden="true"><i class="<?= $e($item['icon'] ?? 'fa fa-file-text-o') ?>"></i></span>
                <span><?= $e($item['label'] ?? '') ?></span>
              </dt>
              <dd class="legal__value"><?= $e($item['value'] ?? '') ?></dd>
            </div>
          <?php endforeach; ?>
        </dl>
      </div>
    </section>

    <section id="kontak" class="section contact">
      <div class="container">
        <div class="section__head section__head--center">
          <h2><?= $e($contact['title'] ?? 'Kontak Kami') ?></h2>
          <p><?= $e($contact['description'] ?? '') ?></p>
        </div>
        <div class="contact__layout">
          <div class="contact__details">
            <ul class="contact__list">
              <li class="contact__item">
                <i class="fa fa-envelope contact__icon" aria-hidden="true"></i>
                <span class="contact__meta">
                  <span class="contact__label"><?= $e($contact['email_label'] ?? 'Email') ?></span>
                  <a class="contact__value" href="mailto:<?= $e($contact['email'] ?? '') ?>"><?= $e($contact['email'] ?? '') ?></a>
                </span>
              </li>
              <li class="contact__item">
                <i class="fa fa-phone contact__icon" aria-hidden="true"></i>
                <span class="contact__meta">
                  <span class="contact__label"><?= $e($contact['phone_label'] ?? 'Telepon / WhatsApp') ?></span>
                  <a class="contact__value" href="<?= $wa !== '' ? 'https://wa.me/' . $e($wa) : 'tel:' . $e($contact['phone'] ?? '') ?>"><?= $e($contact['phone'] ?? '') ?></a>
                </span>
              </li>
              <li class="contact__item">
                <i class="fa fa-map-marker contact__icon" aria-hidden="true"></i>
                <span class="contact__meta">
                  <span class="contact__label"><?= $e($contact['location_label'] ?? 'Lokasi') ?></span>
                  <span class="contact__value"><?= $e($contact['location'] ?? '') ?></span>
                </span>
              </li>
            </ul>
            <a class="btn-flat btn-flat--inverse btn-flat--lg" href="<?= $e($contactHref) ?>"><?= $e($contact['button'] ?? 'Kirim Pesan') ?></a>
          </div>
          <div class="contact__map">
            <div class="contact__map-frame">
              <?php if ($mapEmbed !== ''): ?>
                <iframe
                  src="<?= $e($mapEmbed) ?>"
                  title="Peta lokasi <?= $e($brandName) ?>"
                  loading="lazy"
                  allowfullscreen
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
              <?php else: ?>
                <p class="contact__map-empty">Peta lokasi belum tersedia.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container">
      <p><?= $e($footerText) ?></p>
    </div>
  </footer>

  <div class="lightbox" id="lightbox" hidden role="dialog" aria-modal="true" aria-label="Pratinjau gambar">
    <button type="button" class="lightbox__close" aria-label="Tutup pratinjau">&times;</button>
    <img class="lightbox__img" alt="">
  </div>

  <script src="js/main.js"></script>
</body>
</html>
