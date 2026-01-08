<?php

declare(strict_types=1);

namespace HorologyHub\Services;

use HorologyHub\Models\DTO\ScrapedWatch;
use HorologyHub\Models\DTO\InvestmentRating;

class AIService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = $_ENV['OPENAI_API_KEY'] ?? '';
    }

    public function evaluate(ScrapedWatch $watch): InvestmentRating
    {
        if (empty($this->apiKey)) {
            return $this->mockAnalysis($watch);
        }

        // Logic to call OpenAI API would go here.
        // For now, we return the mock analysis to ensure functionality without keys.
        return $this->mockAnalysis($watch);
    }

    private function mockAnalysis(ScrapedWatch $watch): InvestmentRating
    {
        // Simple heuristic mock logic
        $score = mt_rand(40, 60) / 10.0;

        // If "Box & Papers", +2
        if ($watch->condition === 'Box & Papers') {
            $score += 2.0;
        }

        // Random fluctuation for "Dynamic" feel
        $random = mt_rand(-20, 20) / 10; // -2.0 to 2.0
        $score += $random;

        // Cap at 10
        $score = min(10.0, max(0.0, $score));

        $recommendation = match (true) {
            $score >= 7.5 => 'Buy',
            $score >= 4.0 => 'Hold',
            default => 'Pass'
        };

        return new InvestmentRating(
            $score,
            "Mock AI Analysis: Price {$watch->price} for {$watch->brand} {$watch->model} is within market deviation. Condition {$watch->condition} affects value positively.",
            $recommendation
        );
    }
}
