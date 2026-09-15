<?php

declare(strict_types=1);

require __DIR__ . '/includes/functions.php';
require __DIR__ . '/data/products.php';

$slug = trim((string) ($_GET['slug'] ?? ''));
$product = null;
foreach ($products as $candidate) {
    if ($candidate['slug'] === $slug) {
        $product = $candidate;
        break;
    }
}

if ($product === null || !isset($product['features'])) {
    http_response_code(404);
    $product = null;
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $product ? e($product['name'] . ' — ' . $product['description']) : 'Product not found' ?>">
    <title><?= $product ? e($product['name']) . ' | Northstar Digital Market' : 'Product not found | Northstar Digital Market' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="site-shell">
    <header class="site-header">
        <a class="brand" href="index.php" aria-label="Northstar Digital Market home"><span class="brand-mark">N</span><span>northstar<span class="brand-dot">.</span></span></a>
        <nav class="main-nav" aria-label="Main navigation"><a href="catalog.php">Catalog</a><a href="northstar.php">Why Northstar</a><a href="sales.php">Talk to sales</a></nav>
        <a class="header-cta" href="sales.php">Start a conversation <span aria-hidden="true">↗</span></a>
    </header>
    <main>
    <?php if ($product === null): ?>
        <section class="page-hero page-hero-catalog">
            <div><p class="eyebrow"><span class="eyebrow-line"></span> Not found</p><h1>That system<br><em>doesn't exist.</em></h1></div>
            <p>It may have been renamed or retired. <a class="text-link" href="catalog.php">Browse the full catalog →</a></p>
        </section>
    <?php else: ?>
        <section class="page-hero page-hero-product">
            <div>
                <p class="eyebrow"><span class="eyebrow-line"></span> <?= e($product['category']) ?> / <?= e($product['label']) ?></p>
                <h1><?= e($product['name']) ?></h1>
            </div>
            <p><?= e($product['description']) ?></p>
        </section>

        <section class="product-detail-section">
            <div class="product-detail-visual">
                <div class="product-art art-detail"><?= product_art($product['art'], $product['name']) ?></div>
                <?php if (!empty($product['popular'])): ?><span class="product-badge product-badge-static">Most popular</span><?php endif; ?>
            </div>
            <div class="product-detail-copy">
                <p class="eyebrow">Why teams choose it</p>
                <ul class="detail-benefits">
                    <?php foreach ($product['benefits'] as $benefit): ?><li><?= e($benefit) ?></li><?php endforeach; ?>
                </ul>
                <div class="detail-pricing-card">
                    <span class="detail-pricing-label">Pricing</span>
                    <strong class="detail-pricing-value"><?= e($product['price_label']) ?></strong>
                    <span class="detail-pricing-note">Per team, billed monthly. Volume pricing available.</span>
                    <a class="button button-dark" href="sales.php?product=<?= urlencode($product['slug']) ?>#contact">Talk to sales <span aria-hidden="true">↗</span></a>
                </div>
            </div>
        </section>

        <section class="detail-features-section">
            <p class="eyebrow"><span class="eyebrow-line"></span> Features</p>
            <h2><?= (int) $product['feature_count'] ?> tools built<br><em>into one system.</em></h2>
            <ul class="feature-list">
                <?php foreach ($product['features'] as $feature): ?><li><?= e($feature) ?></li><?php endforeach; ?>
            </ul>
        </section>

        <section class="detail-faq-section">
            <p class="eyebrow"><span class="eyebrow-line"></span> FAQ</p>
            <h2>Common<br><em>questions.</em></h2>
            <div class="faq-list">
                <?php foreach ($product['faq'] as $item): ?>
                <details class="faq-item">
                    <summary><?= e($item['q']) ?></summary>
                    <p><?= e($item['a']) ?></p>
                </details>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="detail-cta-section">
            <div>
                <p class="eyebrow"><span class="eyebrow-line"></span> Ready when you are</p>
                <h2>Talk to sales about<br><em><?= e($product['name']) ?>.</em></h2>
            </div>
            <a class="button button-dark" href="sales.php?product=<?= urlencode($product['slug']) ?>#contact">Talk to sales <span aria-hidden="true">↗</span></a>
        </section>
    <?php endif; ?>
    </main>
    <footer class="site-footer"><a class="brand" href="index.php"><span class="brand-mark">N</span><span>northstar<span class="brand-dot">.</span></span></a><span>Digital products for durable businesses.</span><span>© <?= date('Y') ?> Northstar Digital Market</span></footer>
</div>
<script src="assets/app.js"></script>
</body>
</html>
