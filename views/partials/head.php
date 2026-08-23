<?php
$headTitle = $title ?? $pageTitle ?? null;
$headDesc  = $description ?? $pageDesc ?? 'Portal Resmi Sistem Informasi & Layanan Digital Warga RW 021 Bojong Nangka.';
?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php if (!empty($headTitle)): ?>
    <title><?= htmlspecialchars($headTitle) ?></title>
<?php endif; ?>

<!-- SEO & Meta Tags -->
<meta name="description" content="<?= htmlspecialchars($headDesc) ?>" />
<meta name="keywords" content="RW 021, Dasana Indah, Bojong Nangka, Kelapa Dua, Tangerang, Ruang Warga, Sistem Informasi RW" />
<meta name="author" content="Pengurus RW 021" />
<meta name="robots" content="index, follow" />

<!-- Open Graph / Social Meta -->
<meta property="og:type" content="website" />
<meta property="og:title" content="<?= htmlspecialchars($headTitle ?? 'Ruang Warga 021') ?>" />
<meta property="og:description" content="<?= htmlspecialchars($headDesc) ?>" />
<meta property="og:site_name" content="Ruang Warga 021" />

<!-- Icons -->
<link rel="icon" type="image/svg" href="/images/favicon.svg">

<!-- Fonts & Frameworks -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/theme.css" />
<script src="https://cdn.tailwindcss.com"></script>