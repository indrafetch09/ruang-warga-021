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

<!-- Stylesheets & Fonts -->
<!-- Favicon -->
<link rel="icon" type="image/svg" href="/images/favicon.svg" />
<link rel="apple-touch-icon" href="/images/logo_RW021.webp" />
<link rel="stylesheet" href="/css/theme.css" />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>