<?php

declare(strict_types=1);

namespace HorologyHub\Services;

use HorologyHub\Models\WatchDTO;
use GuzzleHttp\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ValuationService
{
    private Client $client;
    private Logger $logger;
    private ?string $apiKey;

    public function __construct()
    {
        $this->apiKey = $_ENV['OPENAI_API_KEY'] ?? null;
        $this->client = new Client([
            'timeout' => 15.0,
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ]
        ]);

        $this->logger = new Logger('ai_valuation');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/ai.log', Logger::WARNING));
    }

    public function analyzeInvestment(WatchDTO $watch): ?array
    {
        if (!$this->apiKey) {
            $this->logger->warning("AI Analysis skipped: No API Key provided.");
            return [
                'rating' => 'N/A',
                'reasoning' => 'AI Service not configured (Missing API Key).',
                'estimated_value' => null
            ];
        }

        try {
            $prompt = $this->buildPrompt($watch);

            $response = $this->client->post('chat/completions', [
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are an expert watch appraiser. Analyze the investment potential.'],
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'temperature' => 0.7
                ]
            ]);

            $body = json_decode((string) $response->getBody(), true);
            $content = $body['choices'][0]['message']['content'] ?? '';

            return $this->parseResponse($content);

        } catch (\Exception $e) {
            $this->logger->error("AI Analysis failed: " . $e->getMessage());
            return null;
        }
    }

    private function buildPrompt(WatchDTO $watch): string
    {
        return sprintf(
            "Analyze this watch: %s %s (Ref: %s). Condition: %s. Price: %s %s. " .
            "Provide a JSON response with keys: 'rating' (1-10), 'reasoning' (short text), 'estimated_market_value' (numeric).",
            $watch->brand,
            $watch->model,
            $watch->referenceNumber,
            $watch->condition,
            $watch->price,
            $watch->currency
        );
    }

    private function parseResponse(string $content): array
    {
        // Try to extract JSON from the response
        if (preg_match('/\{.*\}/s', $content, $matches)) {
            $json = json_decode($matches[0], true);
            if ($json) {
                return $json;
            }
        }

        return [
            'rating' => null,
            'reasoning' => "Failed to parse AI response: $content",
            'estimated_value' => null
        ];
    }
}
