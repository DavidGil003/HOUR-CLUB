<?php

declare(strict_types=1);

namespace HorologyHub\Models\DTO;

class ScrapedWatch
{
    public function __construct(
        public string $brand,
        public string $model,
        public string $referenceNumber,
        public float $price,
        public string $currency,
        public string $condition, // 'Naked' or 'Box & Papers'
        public string $sourceUrl
    ) {
    }
}
