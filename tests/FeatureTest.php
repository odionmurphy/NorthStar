<?php

declare(strict_types=1);

require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../data/products.php';

$passed = 0;
$failed = 0;

function check_test(bool $condition, string $description): void
{
    global $passed, $failed;
    if ($condition) {
        $passed++;
        echo "PASS  {$description}\n";
        return;
    }

    $failed++;
    echo "FAIL  {$description}\n";
}

check_test(count($products) === 18, 'catalog includes three Northstar products and fifteen shop systems');
check_test(product_art('flow') !== '', 'product art renders for a known type');
check_test(str_contains(product_art('platform:Shopify'), 'Shopify'), 'platform art renders its shop-system label');
check_test(e('<script>') === '&lt;script&gt;', 'output helper escapes unsafe markup');
check_test(submit_inquiry([
    'name' => 'Avery Chen',
    'email' => 'avery@example.com',
    'company' => 'Northstar Labs',
    'product' => 'autoflow-os',
], $products)['success'] === true, 'valid inquiry is accepted');
check_test(submit_inquiry([
    'name' => '',
    'email' => 'not-an-email',
    'company' => '',
    'product' => 'autoflow-os',
], $products)['success'] === false, 'invalid inquiry is rejected');
check_test(submit_inquiry([
    'name' => 'Avery Chen',
    'email' => 'avery@example.com',
    'company' => 'Northstar Labs',
    'product' => 'unknown-product',
], $products)['success'] === false, 'unknown product is rejected');

printf("\n%d passed, %d failed\n", $passed, $failed);
exit($failed === 0 ? 0 : 1);
