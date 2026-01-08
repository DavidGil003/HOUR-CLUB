<?php

declare(strict_types=1);

namespace HorologyHub\Models\Entity;

class Watch
{
    public function __construct(
        private int $id,
        private string $brand,
        private string $model,
        private string $referenceNumber,
        private string $movementType,
        private string $caseMaterial,
        private ?string $createdAt = null
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getBrand(): string
    {
        return $this->brand;
    }
    public function getModel(): string
    {
        return $this->model;
    }
    public function getReferenceNumber(): string
    {
        return $this->referenceNumber;
    }
    public function getMovementType(): string
    {
        return $this->movementType;
    }
    public function getCaseMaterial(): string
    {
        return $this->caseMaterial;
    }
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }
}
