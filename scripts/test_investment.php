<?php

require_once __DIR__ . '/../vendor/autoload.php';

use HorologyHub\Controllers\InvestmentController;

echo "--- Testing InvestmentController ---\n";
$controller = new InvestmentController();

ob_start();
$controller->index();
$output = ob_get_clean();

if (strpos($output, 'Market Value Analysis') !== false && strpos($output, 'priceChart') !== false) {
    echo "[PASS] InvestmentController generated Chart HTML.\n";
} else {
    echo "[FAIL] InvestmentController output wrong.\n";
    // echo $output;
}
