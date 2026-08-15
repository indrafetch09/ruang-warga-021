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
<!-- Favicon -->
<link rel="icon" type="image/svg" href="/images/favicon.svg" />
<link rel="apple-touch-icon" href="/images/logo_RW021.webp" />
<link rel="stylesheet" href="/css/theme.css" />
<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        50: 'var(--color-primary-50)',
                        100: 'var(--color-primary-100)',
                        200: 'var(--color-primary-200)',
                        300: 'var(--color-primary-300)',
                        400: 'var(--color-primary-400)',
                        500: 'var(--color-primary-500)',
                        600: 'var(--color-primary-600)',
                        700: 'var(--color-primary-700)',
                        800: 'var(--color-primary-800)',
                        900: 'var(--color-primary-900)',
                        accent: 'var(--color-primary-accent)',
                    },
                    secondary: {
                        50: 'var(--color-secondary-50)',
                        100: 'var(--color-secondary-100)',
                        200: 'var(--color-secondary-200)',
                        300: 'var(--color-secondary-300)',
                        400: 'var(--color-secondary-400)',
                        500: 'var(--color-secondary-500)',
                        600: 'var(--color-secondary-600)',
                        700: 'var(--color-secondary-700)',
                        800: 'var(--color-secondary-800)',
                        900: 'var(--color-secondary-900)',
                        accent: 'var(--color-secondary-accent)',
                    },
                    accent: {
                        50: 'var(--color-secondary-50)',
                        100: 'var(--color-secondary-100)',
                        200: 'var(--color-secondary-200)',
                        300: 'var(--color-secondary-300)',
                        400: 'var(--color-secondary-400)',
                        500: 'var(--color-secondary-500)',
                        600: 'var(--color-secondary-600)',
                        700: 'var(--color-secondary-700)',
                        800: 'var(--color-secondary-800)',
                        900: 'var(--color-secondary-900)',
                        DEFAULT: 'var(--color-secondary-accent)',
                    },
                    purple: {
                        50: 'var(--color-primary-50)',
                        100: 'var(--color-primary-100)',
                        200: 'var(--color-primary-200)',
                        300: 'var(--color-primary-300)',
                        400: 'var(--color-primary-400)',
                        500: 'var(--color-primary-500)',
                        600: 'var(--color-primary-600)',
                        700: 'var(--color-primary-700)',
                        800: 'var(--color-primary-800)',
                        900: 'var(--color-primary-900)',
                    },
                    emerald: {
                        50: 'var(--color-emerald-50)',
                        100: 'var(--color-emerald-100)',
                        200: 'var(--color-emerald-200)',
                        300: 'var(--color-emerald-300)',
                        400: 'var(--color-emerald-400)',
                        500: 'var(--color-emerald-500)',
                        600: 'var(--color-emerald-600)',
                        700: 'var(--color-emerald-700)',
                        800: 'var(--color-emerald-800)',
                        900: 'var(--color-emerald-900)',
                    },
                    amber: {
                        50: 'var(--color-amber-50)',
                        100: 'var(--color-amber-100)',
                        200: 'var(--color-amber-200)',
                        300: 'var(--color-amber-300)',
                        400: 'var(--color-amber-400)',
                        500: 'var(--color-amber-500)',
                        600: 'var(--color-amber-600)',
                        700: 'var(--color-amber-700)',
                        800: 'var(--color-amber-800)',
                        900: 'var(--color-amber-900)',
                    }
                },
                fontFamily: {
                    sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                }
            }
        }
    }
</script>