<?php

declare(strict_types=1);

namespace HorologyHub\Models;

class WatchDTO
{
    public function __construct(
        public string $brand,
        public string $model,
        public string $referenceNumber,
        public float $price,
        public string $currency,
        public string $condition,
        public string $sourceUrl
    ) {
    }
}
