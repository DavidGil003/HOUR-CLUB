<?php

require_once __DIR__ . '/../vendor/autoload.php';

use HorologyHub\Services\ValuationService;
use HorologyHub\Models\WatchDTO;
use Dotenv\Dotenv;

// Load env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$service = new ValuationService();

// Mock Watch
$watch = new WatchDTO(
    'Rolex',
    'Submariner',
    '124060',
    9150.00,
    'EUR',
    'Box & Papers',
    'http://example.com'
);

echo "Analyzing watch: {$watch->brand} {$watch->model}...\n";
$result = $service->analyzeInvestment($watch);

if ($result) {
    echo "Rating: " . ($result['rating'] ?? 'N/A') . "\n";
    echo "Reasoning: " . ($result['reasoning'] ?? 'N/A') . "\n";
    echo "Est. Value: " . ($result['estimated_value'] ?? 'N/A') . "\n";
} else {
    echo "Analysis failed.\n";
}
