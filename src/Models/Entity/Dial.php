<?php

declare(strict_types=1);

namespace HorologyHub\Models\Entity;

class Dial extends WatchPart
{
    public function __construct(
        int $id,
        string $name,
        float $price,
        string $imageUrl,
        array $specifications,
        array $compatibleMovements
    ) {
        parent::__construct($id, 'Dial', $name, $price, $imageUrl, $specifications, $compatibleMovements);
    }

    public function isCompatibleWith(WatchPart $otherPart): bool
    {
        // Example logic: Dial compatibility
        if ($otherPart instanceof CasePart) {
            // Check if dial diameter fits in case
            return $this->specifications['diameter'] <= $otherPart->getSpecifications()['dial_opening'];
        }

        if ($otherPart instanceof Movement) {
            // Check if dial feet match movement or if movement is in compatible list
            return in_array($otherPart->getName(), $this->compatibleMovements);
        }

        return true; // Default to true if no specific constraint known
    }
}
