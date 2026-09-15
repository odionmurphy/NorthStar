<?php

declare(strict_types=1);

require __DIR__ . '/includes/functions.php';
require __DIR__ . '/data/products.php';

$category = trim((string) ($_GET['category'] ?? ''));
$search = trim((string) ($_GET['q'] ?? ''));
$visibleProducts = array_values(array_filter($products, static function (array $product) use ($category, $search): bool {
    $matchesCategory = $category === '' || $product['category'] === $category;
    $haystack = strtolower($product['name'] . ' ' . $product['description'] . ' ' . implode(' ', $product['tags']));
    return $matchesCategory && ($search === '' || str_contains($haystack, strtolower($search)));
}));
$categories = array_values(array_unique(array_map(static fn (array $product): string => $product['category'], $products)));
?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Explore Northstar's B2B digital product systems and supported shop platforms.">
    <title>Catalog | Northstar Digital Market</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="site-shell">
    <header class="site-header">
        <a class="brand" href="index.php" aria-label="Northstar Digital Market home"><span class="brand-mark">N</span><span>northstar<span class="brand-dot">.</span></span></a>
        <nav class="main-nav" aria-label="Main navigation"><a href="catalog.php" aria-current="page">Catalog</a><a href="northstar.php">Why Northstar</a><a href="sales.php">Talk to sales</a></nav>
        <a class="header-cta" href="sales.php">Start a conversation <span aria-hidden="true">↗</span></a>
    </header>
    <main>
        <section class="page-hero page-hero-catalog"><div><p class="eyebrow"><span class="eyebrow-line"></span> The catalog / 2026</p><h1>Products that<br><em>move commerce.</em></h1></div><p>Explore digital systems and shop platforms that help ambitious B2B teams automate, protect, understand, and sell.</p></section>
        <section class="catalog-section catalog-page-section">
            <form class="catalog-tools" method="get" action="catalog.php">
                <label class="search-box"><span aria-hidden="true">⌕</span><input type="search" name="q" value="<?= e($search) ?>" placeholder="Search systems, outcomes, industries..."></label>
                <div class="category-filters" role="group" aria-label="Filter products by category"><a class="filter-chip <?= $category === '' ? 'active' : '' ?>" href="catalog.php">All systems</a><?php foreach ($categories as $itemCategory): ?><a class="filter-chip <?= $category === $itemCategory ? 'active' : '' ?>" href="?category=<?= urlencode($itemCategory) ?>"><?= e($itemCategory) ?></a><?php endforeach; ?></div>
            </form>
            <div class="product-grid">
                <?php foreach ($visibleProducts as $index => $product): ?>
                    <article class="product-card product-card-<?= (($index % 3) + 1) ?> reveal">
                        <?php if (!empty($product['popular'])): ?><span class="product-badge">Most popular</span><?php endif; ?>
                        <div class="product-top"><span class="product-number"><?= sprintf('%02d', $index + 1) ?></span><span class="product-category"><?= e($product['category']) ?></span><span class="product-status"><span></span> Available now</span></div>
                        <div class="product-art art-<?= (($index % 3) + 1) ?>"><?= product_art($product['art'], $product['name']) ?></div>
                        <div class="product-body">
                            <div class="product-meta"><span><?= e($product['label']) ?></span><span><?= e($product['version']) ?></span></div>
                            <h2><?= e($product['name']) ?></h2>
                            <p><?= e($product['description']) ?></p>
                            <?php if (!empty($product['feature_count'])): ?><span class="product-feature-count"><?= (int) $product['feature_count'] ?> features included</span><?php endif; ?>
                            <?php if (!empty($product['benefits'])): ?>
                            <ul class="product-benefits">
                                <?php foreach (array_slice($product['benefits'], 0, 3) as $benefit): ?><li><?= e($benefit) ?></li><?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                            <div class="product-bottom">
                                <strong><?= e($product['price_label']) ?></strong>
                                <?php if (isset($product['features'])): ?>
                                <a class="cta-button" href="product.php?slug=<?= urlencode($product['slug']) ?>">View details <span aria-hidden="true">↗</span></a>
                                <?php else: ?>
                                <a class="icon-button" href="sales.php?product=<?= urlencode($product['slug']) ?>#contact" aria-label="Get <?= e($product['name']) ?>">↗</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php if ($visibleProducts === []): ?><div class="empty-state">No systems match that search. Try a broader term.</div><?php endif; ?>
        </section>
    </main>
    <footer class="site-footer"><a class="brand" href="index.php"><span class="brand-mark">N</span><span>northstar<span class="brand-dot">.</span></span></a><span>Digital products for durable businesses.</span><span>© <?= date('Y') ?> Northstar Digital Market</span></footer>
    </div>
<script src="assets/app.js"></script>
</body>
</html>
