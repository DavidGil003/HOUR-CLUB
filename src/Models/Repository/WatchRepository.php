<?php

declare(strict_types=1);

namespace HorologyHub\Models\Repository;

use HorologyHub\Core\Database;
use HorologyHub\Models\Entity\Watch;
use PDO;

class WatchRepository
{
    private ?PDO $db = null;

    public function __construct()
    {
        try {
            $this->db = Database::getInstance()->getConnection();
        } catch (\Exception $e) {
            // DB Connectivity failed. We will fall back to mock data.
            $this->db = null;
        }
    }

    /**
     * @return Watch[]
     */
    public function findAll(int $limit = 20, int $offset = 0): array
    {
        if ($this->db === null) {
            return $this->getMockData();
        }

        // For development/demo without Seeded DB, return mock data if table empty or DB fails
        try {
            $stmt = $this->db->prepare("SELECT * FROM watches LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            $watches = [];
            while ($row = $stmt->fetch()) {
                $watches[] = $this->mapRowToEntity($row);
            }

            if (empty($watches)) {
                return $this->getMockData();
            }

            return $watches;
        } catch (\PDOException $e) {
            // Fallback for safety during initial setup
            return $this->getMockData();
        }
    }

    private function mapRowToEntity(array $row): Watch
    {
        return new Watch(
            (int) $row['id'],
            $row['brand'],
            $row['model'],
            $row['reference_number'] ?? '',
            $row['movement_type'] ?? '',
            $row['case_material'] ?? '',
            $row['created_at']
        );
    }

    private function getMockData(): array
    {
        return [
            new Watch(1, 'Rolex', 'Submariner', '124060', 'Automatic', 'Oystersteel'),
            new Watch(2, 'Omega', 'Speedmaster', '310.30.42.50.01.001', 'Manual', 'Steel'),
            new Watch(3, 'Seiko', 'SKX007', 'SKX007K2', 'Automatic', 'Steel'),
        ];
    }
}
