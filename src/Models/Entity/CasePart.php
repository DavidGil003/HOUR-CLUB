<?php

declare(strict_types=1);

namespace HorologyHub\Models\Entity;

class CasePart extends WatchPart
{
    public function __construct(
        int $id,
        string $name,
        float $price,
        array $specifications,
        array $compatibleMovements
    ) {
        parent::__construct($id, 'Case', $name, $price, $specifications, $compatibleMovements);
    }

    public function isCompatibleWith(WatchPart $otherPart): bool
    {
        if ($otherPart instanceof Dial) {
            return $otherPart->isCompatibleWith($this); // Delegate to Dial
        }

        if ($otherPart instanceof Movement) {
            return in_array($otherPart->getName(), $this->compatibleMovements);
        }

        return true;
    }
}
