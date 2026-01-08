<?php

declare(strict_types=1);

namespace HorologyHub\Models\DTO;

class InvestmentRating
{
    public function __construct(
        public float $score,
        public string $analysisText,
        public string $recommendation // 'Buy', 'Hold', 'Pass'
    ) {
    }
}
