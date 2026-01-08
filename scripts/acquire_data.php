<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use HorologyHub\Services\ScraperService;
use HorologyHub\Services\AIService;

// Load environment
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// CLI Arguments
$url = $argv[1] ?? null;

if (!$url) {
    // Default to test file if no URL provided
    echo "Usage: php acquire_data.php <url>\n";
    echo "Using dummy test data for demonstration...\n";
    $testFile = __DIR__ . '/../tests/dummy_watch.html';
    $html = file_get_contents($testFile);
}

$scraper = new ScraperService();
$ai = new AIService();

echo "--- HorologyHub Data Acquisition ---\n";

$watch = isset($html)
    ? $scraper->scrapeHtml($html, 'dummy-source')
    : $scraper->scrapeUrl($url);

if ($watch) {
    echo "Watch Found:\n";
    echo "  Brand: {$watch->brand}\n";
    echo "  Model: {$watch->model}\n";
    echo "  Price: {$watch->price}\n";
    echo "  Condition: {$watch->condition}\n";

    echo "\nRunning AI Valuation...\n";
    $rating = $ai->evaluate($watch);

    echo "  Score: {$rating->score}/10\n";
    echo "  Action: {$rating->recommendation}\n";
    echo "  Analysis: {$rating->analysisText}\n";
} else {
    echo "Error: Could not scrape data.\n";
}
