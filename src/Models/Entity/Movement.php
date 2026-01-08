<?php

declare(strict_types=1);

namespace HorologyHub\Models\Entity;

class Movement extends WatchPart
{
    public function __construct(
        int $id,
        string $name,
        float $price,
        string $imageUrl,
        array $specifications
    ) {
        parent::__construct($id, 'Movement', $name, $price, $imageUrl, $specifications, []);
    }

    public function isCompatibleWith(WatchPart $otherPart): bool
    {
        // Movement is usually the reference point
        if ($otherPart instanceof CasePart || $otherPart instanceof Dial) {
            return $otherPart->isCompatibleWith($this);
        }
        return true;
    }
}
