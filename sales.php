<?php

declare(strict_types=1);

require __DIR__ . '/includes/functions.php';
require __DIR__ . '/data/products.php';

$selectedProduct = trim((string) ($_GET['product'] ?? ''));
$notice = null;
$noticeType = 'success';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = submit_inquiry($_POST, $products);
    $notice = $result['message'];
    $noticeType = $result['success'] ? 'success' : 'error';
    if ($result['success']) {
        $selectedProduct = '';
    }
}
?><!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content="Talk to the Northstar Digital Market sales team."><title>Talk to sales | Northstar Digital Market</title><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet"><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="site-shell"><header class="site-header"><a class="brand" href="index.php" aria-label="Northstar Digital Market home"><span class="brand-mark">N</span><span>northstar<span class="brand-dot">.</span></span></a><nav class="main-nav" aria-label="Main navigation"><a href="catalog.php">Catalog</a><a href="northstar.php">Why Northstar</a><a href="sales.php" aria-current="page">Talk to sales</a></nav><a class="header-cta" href="catalog.php">View systems <span aria-hidden="true">↗</span></a></header>
<main><section class="page-hero page-hero-sales"><div><p class="eyebrow"><span class="eyebrow-line"></span> Make your next move</p><h1>Bring a better<br><em>system to work.</em></h1></div><p>Tell us what your team is solving. We will point you to the right starting line.</p></section><section class="contact-section sales-page-section" id="contact"><div class="contact-copy"><p class="eyebrow"><span class="eyebrow-line"></span> A useful conversation</p><h2>Start with<br><em>the problem.</em></h2><p>Our team will help you map the right system to your workflow, team size, and timeline. No pressure, no mystery demo.</p><div class="contact-details"><span>hello@northstardigital.test</span><span>Mon–Fri / 09:00–18:00 UTC</span><span>Response within one business day</span></div></div><form class="inquiry-form" method="post" action="sales.php#contact"><label>Name<input type="text" name="name" required></label><label>Work email<input type="email" name="email" required></label><label>Company<input type="text" name="company" required></label><label>What are you interested in?<select name="product" required><option value="">Select a system</option><?php foreach ($products as $product): ?><option value="<?= e($product['slug']) ?>" <?= $selectedProduct === $product['slug'] ? 'selected' : '' ?>><?= e($product['name']) ?></option><?php endforeach; ?></select></label><label class="full-field">A note for our team<textarea name="message" rows="3" placeholder="What would you like to improve?"></textarea></label><button class="button button-light" type="submit">Start a conversation <span aria-hidden="true">↗</span></button></form></section><?php if ($notice !== null): ?><div class="notice notice-<?= e($noticeType) ?>" role="status"><?= e($notice) ?></div><?php endif; ?></main><footer class="site-footer"><a class="brand" href="index.php"><span class="brand-mark">N</span><span>northstar<span class="brand-dot">.</span></span></a><span>Digital products for durable businesses.</span><span>© <?= date('Y') ?> Northstar Digital Market</span></footer></div><script src="assets/app.js"></script></body></html>
