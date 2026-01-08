<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use HorologyHub\Controllers\WatchController;

require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// Initialize Router
$router = new HorologyHub\Core\Router();

$router->get('/', [WatchController::class, 'index']);
$router->get('/index.php', [WatchController::class, 'index']);
$router->get('/catalog', [WatchController::class, 'index']);
$router->get('/watch', [WatchController::class, 'show']);

// Builder Routes
$router->get('/builder', [HorologyHub\Controllers\BuilderController::class, 'index']);
$router->post('/builder/validate', [HorologyHub\Controllers\BuilderController::class, 'validate']);

// Investment Routes
$router->get('/investment', [HorologyHub\Controllers\InvestmentController::class, 'index']);

// API Routes
$router->get('/api/watches', [HorologyHub\Controllers\ApiController::class, 'getWatches']);
$router->get('/api/parts', [HorologyHub\Controllers\ApiController::class, 'getParts']);




// Dispatch
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
