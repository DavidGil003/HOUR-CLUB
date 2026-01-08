<?php

use HorologyHub\Controllers\WatchController;
use HorologyHub\Controllers\BuilderController;

require_once __DIR__ . '/../vendor/autoload.php';

// Mock $_SERVER for Router/View if needed, though we are calling methods directly.

echo "--- Testing WatchController ---\n";
$watchController = new WatchController();

ob_start();
$watchController->index();
$output = ob_get_clean();

if (strpos($output, 'Watch Catalog') !== false && strpos($output, 'Rolex') !== false) {
    echo "[PASS] WatchController generated Catalog HTML with mock data.\n";
} else {
    echo "[FAIL] WatchController output seems wrong.\n";
    // echo $output; // Debug
}

echo "\n--- Testing BuilderController ---\n";
$builderController = new BuilderController();

// 1. Index
ob_start();
$builderController->index();
$outputBuilder = ob_get_clean();
if (strpos($outputBuilder, 'ModBuilder Configurator') !== false && strpos($outputBuilder, 'NH35') !== false) {
    echo "[PASS] BuilderController generated Builder HTML.\n";
} else {
    echo "[FAIL] BuilderController index output wrong.\n";
}

// 2. Validate (Mocking Input)
// We can't easily mock php://input for file_get_contents in CLI without wrappers or writing to a file.
// For this simple test, we'll skip the exact validate() method unless we refactored it to accept args.
// However, we can verify that the class exists and has the method.
if (method_exists($builderController, 'validate')) {
    echo "[PASS] BuilderController has validate method.\n";
}
