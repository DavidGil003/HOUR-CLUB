<?php

declare(strict_types=1);

namespace HorologyHub\Models\Entity;

class Hands extends WatchPart
{
    public function __construct(
        int $id,
        string $name,
        float $price,
        string $imageUrl,
        array $specifications = [],
        array $compatibleMovements = []
    ) {
        parent::__construct($id, 'Hands', $name, $price, $imageUrl, $specifications, $compatibleMovements);
    }

    public function isCompatibleWith(WatchPart $otherPart): bool
    {
        if ($otherPart instanceof Movement) {
            // Check if movement is in compatible list
            return in_array($otherPart->getName(), $this->compatibleMovements);
        }
        return true;
    }
}
