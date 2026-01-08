<?php

declare(strict_types=1);

namespace HorologyHub\Models\Entity;

abstract class WatchPart
{
    public function __construct(
        protected int $id,
        protected string $partType, // 'Dial', 'Hand', 'Case', 'Movement', 'Bezel'
        protected string $name,
        protected float $price,
        protected array $specifications,
        protected array $compatibleMovements
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getPartType(): string
    {
        return $this->partType;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getSpecifications(): array
    {
        return $this->specifications;
    }
    public function getCompatibleMovements(): array
    {
        return $this->compatibleMovements;
    }

    /**
     * Checks if this part is physically compatible with another part.
     * This logic can be overridden by specific part implementations.
     */
    abstract public function isCompatibleWith(WatchPart $otherPart): bool;
}
