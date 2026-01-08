<?php

declare(strict_types=1);

namespace HorologyHub\Models\Entity;

class Strap extends WatchPart
{
    public function __construct(
        int $id,
        string $name,
        float $price,
        string $imageUrl,
        array $specifications = [],
        array $compatibleMovements = []
    ) {
        // Straps are generally universal or based on lug width, not movement, but we keep the signature
        parent::__construct($id, 'Strap', $name, $price, $imageUrl, $specifications, $compatibleMovements);
    }

    public function isCompatibleWith(WatchPart $otherPart): bool
    {
        // Simplification: Assume all straps fit all cases for this demo
        // Real logic would check Lug Width from Case specs
        return true;
    }
}
