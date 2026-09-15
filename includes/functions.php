<?php

declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function product_art(string $type, string $name = ''): string
{
    if (str_starts_with($type, 'platform:')) {
        $name = substr($type, 9);
        $type = 'platform';
    }

    return match ($type) {
        'flow' => '<div class="flow-art"><span class="flow-node node-a">01</span><span class="flow-line line-a"></span><span class="flow-node node-b">AI</span><span class="flow-line line-b"></span><span class="flow-node node-c">✓</span><span class="flow-label">AUTOMATE / REPEAT / SCALE</span></div>',
        'shield' => '<div class="shield-art"><span class="shield-shape">✦</span><span class="shield-ring ring-a"></span><span class="shield-ring ring-b"></span><span class="shield-label">TRUST<br>BY DESIGN</span></div>',
        'signal' => '<div class="signal-art"><span class="signal-bars"><i></i><i></i><i></i><i></i><i></i></span><span class="signal-spark">↗</span><span class="signal-label">SEE THE<br>WHOLE PICTURE</span></div>',
        'platform' => '<div class="platform-art"><span class="platform-mark">' . e($name) . '</span><span class="platform-caption">SHOP SYSTEM</span></div>',
        default => '<div class="flow-art"></div>',
    };
}

function submit_inquiry(array $input, array $products): array
{
    $name = trim((string) ($input['name'] ?? ''));
    $email = trim((string) ($input['email'] ?? ''));
    $company = trim((string) ($input['company'] ?? ''));
    $productSlug = trim((string) ($input['product'] ?? ''));

    if ($name === '' || $company === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Please add your name, company, and a valid work email.'];
    }

    $knownProduct = array_filter($products, static fn (array $product): bool => $product['slug'] === $productSlug);
    if ($knownProduct === []) {
        return ['success' => false, 'message' => 'Choose a system so our team knows where to start.'];
    }

    return ['success' => true, 'message' => 'Thanks, ' . $name . '. We will be in touch with ' . $company . ' shortly.'];
}
