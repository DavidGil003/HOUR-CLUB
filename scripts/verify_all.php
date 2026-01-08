<?php

echo "========================================\n";
echo "HOROLOGY HUB - SYSTEM VERIFICATION SUIT\n";
echo "========================================\n\n";

$passCount = 0;
$failCount = 0;

function runStep($name, $command)
{
    global $passCount, $failCount;
    echo ">> Checking: $name...\n";
    exec($command, $output, $returnVar);

    if ($returnVar === 0) {
        echo "   [OK] Passed.\n";
        $passCount++;
    } else {
        echo "   [FAIL] Failed with exit code $returnVar\n";
        foreach ($output as $line) {
            echo "   > $line\n";
        }
        $failCount++;
    }
    echo "\n";
}

// 1. Check Phase 0: Structure
echo "--- Phase 0: Project Setup ---\n";
if (file_exists(__DIR__ . '/../public/index.php') && is_dir(__DIR__ . '/../vendor')) {
    echo "   [OK] Directory Structure & Vendor validated.\n";
    $passCount++;
} else {
    echo "   [FAIL] Critical files missing.\n";
    $failCount++;
}
echo "\n";

// 2. Check Phase 1: Scraping & AI
echo "--- Phase 1: Acquisition ---\n";
// Add quotes around the script path
runStep("Data Acquisition Script", "php \"" . __DIR__ . "/acquire_data.php\" https://example.com/watch");

// 3. Check Phase 2: Logic
echo "--- Phase 2: Business Logic ---\n";
runStep("Compatibility Logic", "php \"" . __DIR__ . "/test_compatibility.php\"");

// 4. Check Phase 3: MVC UI
echo "--- Phase 3: MVC Interface ---\n";
runStep("Internal MVC Controller Test", "php \"" . __DIR__ . "/test_mvc_internal.php\"");
runStep("Investment Chart Test", "php \"" . __DIR__ . "/test_investment.php\"");

// 5. Check Phase 4: API
echo "--- Phase 4: REST API ---\n";
runStep("API Client Test", "php \"" . __DIR__ . "/test_api_client.php\"");

echo "========================================\n";
echo "SUMMARY: Passed: $passCount | Failed: $failCount\n";
if ($failCount === 0) {
    echo "RESULT: SYSTEM GREEN. READY FOR PHASE 4.\n";
} else {
    echo "RESULT: SYSTEM ISSUES DETECTED. REVIEW LOGS.\n";
}
echo "========================================\n";
