<?php

declare(strict_types=1);

namespace HorologyHub\Services;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use HorologyHub\Models\DTO\ScrapedWatch;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ScraperService
{
    private Client $client;
    private Logger $logger;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 10.0,
            'headers' => ['User-Agent' => 'HorologyHub-Scraper/1.0']
        ]);

        $this->logger = new Logger('scraper');
        // Ensure logs directory exists
        if (!is_dir(__DIR__ . '/../../logs')) {
            mkdir(__DIR__ . '/../../logs', 0777, true);
        }
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/scraper.log', Logger::WARNING));
    }

    public function scrapeUrl(string $url): ?ScrapedWatch
    {
        try {
            $response = $this->client->request('GET', $url);
            $html = (string) $response->getBody();
            return $this->scrapeHtml($html, $url);
        } catch (\Exception $e) {
            $this->logger->error("Failed to scrape URL: $url - " . $e->getMessage());
            return null;
        }
    }

    public function scrapeHtml(string $html, string $sourceUrl): ?ScrapedWatch
    {
        $crawler = new Crawler($html);

        try {
            // These selectors are hypothetical/generic for now.
            // In a real scenario, we'd need site-specific strategies/adapters.
            // For the dummy test, we'll design the HTML to match these.

            $brand = $crawler->filter('.watch-brand')->count() ? $crawler->filter('.watch-brand')->text() : 'Unknown';
            $model = $crawler->filter('.watch-model')->count() ? $crawler->filter('.watch-model')->text() : 'Unknown';
            $ref = $crawler->filter('.watch-ref')->count() ? $crawler->filter('.watch-ref')->text() : '';

            $priceText = $crawler->filter('.watch-price')->count() ? $crawler->filter('.watch-price')->text() : '0';
            // Simple cleanup for price: remove non-numeric chars except dot/comma needed
            $price = (float) preg_replace('/[^0-9.]/', '', str_replace(',', '.', $priceText));

            $conditionText = $crawler->filter('.watch-condition')->count() ? $crawler->filter('.watch-condition')->text() : '';
            $condition = stripos($conditionText, 'Box') !== false ? 'Box & Papers' : 'Naked';

            return new ScrapedWatch(
                trim($brand),
                trim($model),
                trim($ref),
                $price,
                'EUR',
                $condition,
                $sourceUrl
            );

        } catch (\Exception $e) {
            $this->logger->error("Parsing error for $sourceUrl: " . $e->getMessage());
            return null;
        }
    }
}
