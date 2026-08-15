<?php
// ponytail: Head partial with SEO meta tags & core typography/theme assets
$pageTitle = $title ?? $pageTitle ?? 'Ruang Warga 021';
$pageDesc = $description ?? $pageDesc ?? 'Portal Sistem Informasi, Layanan Administrasi, dan Pengelolaan Warga RW 021 Bojong Nangka.';
?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?= htmlspecialchars($pageTitle) ?></title>

<!-- SEO Meta Tags -->
<meta name="description" content="<?= htmlspecialchars($pageDesc) ?>" />
<meta name="keywords" content="RW 021, Dasana Indah, Bojong Nangka, Kelapa Dua, Tangerang, Ruang Warga, Sistem Informasi RW" />
<meta name="author" content="Pengurus RW 021" />
<meta name="robots" content="index, follow" />

<!-- Open Graph / Social Media -->
<meta property="og:type" content="website" />
<meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>" />
<meta property="og:description" content="<?= htmlspecialchars($pageDesc) ?>" />
<meta property="og:site_name" content="Ruang Warga 021" />

<!-- Stylesheets & Fonts -->
<link rel="icon" type="image/webp" href="/images/logo_RW021.webp" />
<link rel="apple-touch-icon" href="/images/logo_RW021.webp" />
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="/css/theme.css" />
<style>
    body {
        font-family: "Plus Jakarta Sans", sans-serif;
    }
</style>