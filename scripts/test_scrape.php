<?php

require_once __DIR__ . '/../vendor/autoload.php';

use HorologyHub\Services\ScraperService;

// Ensure logs directory exists
if (!is_dir(__DIR__ . '/../logs')) {
    mkdir(__DIR__ . '/../logs');
}

$scraper = new ScraperService();

// Test with local dummy file
$html = file_get_contents(__DIR__ . '/../tests/dummy_watch.html');
echo "Scraping dummy HTML...\n";
$watch = $scraper->scrapeHtml($html, 'local-test');

if ($watch) {
    echo "Success!\n";
    echo "Brand: " . $watch->brand . "\n";
    echo "Model: " . $watch->model . "\n";
    echo "Ref: " . $watch->referenceNumber . "\n";
    echo "Price: " . $watch->price . "\n";
    echo "Condition: " . $watch->condition . "\n";
} else {
    echo "Failed to scrape.\n";
}
