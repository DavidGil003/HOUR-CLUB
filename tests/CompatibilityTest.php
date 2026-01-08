<?php

declare(strict_types=1);

namespace HorologyHub\Tests;

use PHPUnit\Framework\TestCase;
use HorologyHub\Services\CompatibilityEngine;
use HorologyHub\Models\Entity\Dial;
use HorologyHub\Models\Entity\CasePart;
use HorologyHub\Models\Entity\Movement;

class CompatibilityTest extends TestCase
{
    private CompatibilityEngine $engine;

    protected function setUp(): void
    {
        $this->engine = new CompatibilityEngine();
    }

    public function testDialFitsCase(): void
    {
        // Dial 28.5mm, Case opens 28.5mm -> Compatible
        $dial = new Dial(1, 'Seiko Dial', 50.0, ['diameter' => 28.5], ['NH35']);
        $case = new CasePart(2, 'Sub Case', 100.0, ['dial_opening' => 28.5], ['NH35']);

        $this->assertTrue($dial->isCompatibleWith($case));

        // Dial 29mm, Case opens 28.5mm -> Incompatible
        $bigDial = new Dial(3, 'Big Dial', 50.0, ['diameter' => 29.0], ['NH35']);
        $this->assertFalse($bigDial->isCompatibleWith($case));
    }

    public function testMovementCompatibility(): void
    {
        $movement = new Movement(4, 'NH35', 40.0, []);
        $case = new CasePart(5, 'Sub Case', 100.0, ['dial_opening' => 28.5], ['NH35', 'NH36']);

        $this->assertTrue($case->isCompatibleWith($movement));

        $incompatibleCase = new CasePart(6, 'Small Case', 80.0, ['dial_opening' => 28.5], ['Miyota 9015']);
        $this->assertFalse($incompatibleCase->isCompatibleWith($movement));
    }
}
