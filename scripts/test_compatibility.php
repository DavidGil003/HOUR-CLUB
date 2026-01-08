<?php

require_once __DIR__ . '/../vendor/autoload.php';

use HorologyHub\Models\Entity\Dial;
use HorologyHub\Models\Entity\CasePart;
use HorologyHub\Models\Entity\Movement;

echo "--- Testing Compatibility Engine Logic ---\n";

// 1. Dial Fits Case
$dial = new Dial(1, 'Seiko Dial', 50.0, ['diameter' => 28.5], ['NH35']);
$case = new CasePart(2, 'Sub Case', 100.0, ['dial_opening' => 28.5], ['NH35']);
$bigDial = new Dial(3, 'Big Dial', 50.0, ['diameter' => 29.0], ['NH35']);

if ($dial->isCompatibleWith($case)) {
    echo "[PASS] Dial 28.5 fits Case 28.5\n";
} else {
    echo "[FAIL] Dial 28.5 SHOULD fit Case 28.5\n";
}

if (!$bigDial->isCompatibleWith($case)) {
    echo "[PASS] Dial 29.0 does NOT fit Case 28.5\n";
} else {
    echo "[FAIL] Dial 29.0 SHOULD NOT fit Case 28.5\n";
}

// 2. Movement Fits Case
$movement = new Movement(4, 'NH35', 40.0, []);
// Case compatible with NH35 and NH36
$flexibleCase = new CasePart(5, 'Sub Case', 100.0, ['dial_opening' => 28.5], ['NH35', 'NH36']);
$strictCase = new CasePart(6, 'Small Case', 80.0, ['dial_opening' => 28.5], ['Miyota 9015']);

if ($flexibleCase->isCompatibleWith($movement)) {
    echo "[PASS] Case (NH35/NH36) accepts Movement NH35\n";
} else {
    echo "[FAIL] Case SHOULD accept Movement\n";
}

if (!$strictCase->isCompatibleWith($movement)) {
    echo "[PASS] Case (Miyota) rejects Movement NH35\n";
} else {
    echo "[FAIL] Case SHOULD reject Movement\n";
}
