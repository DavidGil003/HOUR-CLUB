<?php

declare(strict_types=1);

namespace HorologyHub\Controllers;

use HorologyHub\Models\Repository\WatchRepository;
use HorologyHub\Models\Repository\PartRepository;

class ApiController
{
    private WatchRepository $watchRepo;
    private PartRepository $partRepo;

    public function __construct()
    {
        $this->watchRepo = new WatchRepository();
        $this->partRepo = new PartRepository();
    }

    public function getWatches(): void
    {
        $this->sendJson($this->watchRepo->findAll());
    }

    public function getParts(): void
    {
        $this->sendJson($this->partRepo->findAll());
    }

    private function sendJson(mixed $data, int $statusCode = 200): void
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);

        // Convert objects to arrays if they don't implement JsonSerializable
        // For simple DTOs/Entities, we might need a transformation layer, 
        // but for this phase, exposing public properties or using a simple mapping is fine.
        // Since our Entities use protected properties and getters, json_encode might return empty objects
        // unless they implement JsonSerializable.

        // Quick transformation for entities to array
        $mappedData = array_map(function ($item) {
            return $this->extractData($item);
        }, $data);

        echo json_encode(['data' => $mappedData, 'status' => $statusCode], JSON_PRETTY_PRINT);
    }

    private function extractData(object $entity): array
    {
        // Reflection or simple getter usage. 
        // For simplicity/performance without Reflection:
        if (method_exists($entity, 'getId')) {
            $data = [
                'id' => $entity->getId(),
            ];

            // Add specific fields based on type
            if (method_exists($entity, 'getBrand')) {
                $data['brand'] = $entity->getBrand();
                $data['model'] = $entity->getModel();
                $data['ref'] = $entity->getReferenceNumber();
            }

            if (method_exists($entity, 'getName')) {
                $data['name'] = $entity->getName();
                $data['type'] = $entity->getPartType();
                $data['price'] = $entity->getPrice();
            }

            return $data;
        }

        return (array) $entity;
    }
}
