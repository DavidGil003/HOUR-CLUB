<?php

declare(strict_types=1);

namespace HorologyHub\Models\Repository;

use HorologyHub\Models\Entity\WatchPart;
use HorologyHub\Models\Entity\Dial;
use HorologyHub\Models\Entity\CasePart;
use HorologyHub\Models\Entity\Movement;

class PartRepository
{
    /**
     * @return WatchPart[]
     */
    public function findAll(): array
    {
        // Mock data for Phase 3 UI development
        return [
            new Dial(101, 'Sunburst Blue Dial', 45.00, ['diameter' => 28.5], ['NH35', 'NH36']),
            new Dial(102, 'Matte Black Scuba', 40.00, ['diameter' => 28.5], ['NH35']),
            new CasePart(201, 'Submariner Style Case', 89.00, ['dial_opening' => 28.5], ['NH35', 'NH36']),
            new CasePart(202, 'Dress Watch Case', 75.00, ['dial_opening' => 28.5], ['NH35']),
            new Movement(301, 'Seiko NH35 Automatic', 42.00, []),
            new Movement(302, 'Miyota 9015', 85.00, []),
        ];
    }

    public function findById(int $id): ?WatchPart
    {
        $parts = $this->findAll();
        foreach ($parts as $part) {
            if ($part->getId() === $id) {
                return $part;
            }
        }
        return null;
    }
}
