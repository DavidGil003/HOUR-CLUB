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

    public function findById(int $id): ?Watch
    {
        // Simple search in mock data
        $watches = $this->findAll();
        foreach ($watches as $watch) {
            if ($watch->getId() === $id) {
                return $watch;
            }
        }
        return null;
    }

    private function getMockData(): array
    {
        return [
            new Watch(1, 'Rolex', 'Submariner Date', '126610LN', 'Automatic', 'Oystersteel', 'https://content.rolex.com/v7/dam/2023-06/upright-bba-with-shadow/m126610ln-0001.png?impolicy=v7-main-prod'),
            new Watch(2, 'Omega', 'Speedmaster Moonwatch', '310.30.42.50.01.001', 'Manual', 'Steel', 'https://www.omegawatches.com/media/catalog/product/o/m/omega-speedmaster-31030425001001-l.png'),
            new Watch(3, 'Seiko', 'SKX007', 'SKX007K2', 'Automatic', 'Steel', 'https://modmodewatches.com/cdn/shop/products/Seiko-Skx007-Automatic-Dive-Watch-Mod-Mode-Watches-2_1080x.jpg?v=1623916298'),
            new Watch(4, 'Patek Philippe', 'Nautilus', '5711/1A', 'Automatic', 'Steel', 'https://static.patek.com/images/articles/face_white/350/5711_1A_010.jpg'),
            new Watch(5, 'Audemars Piguet', 'Royal Oak', '15500ST', 'Automatic', 'Steel', 'https://www.audemarspiguet.com/content/dam/ap/com/products/watches/15500ST.OO.1220ST.01/15500ST.OO.1220ST.01_01.png?imwidth=480'),
            new Watch(6, 'Tudor', 'Black Bay 58', 'M79030N-0001', 'Automatic', 'Steel', 'https://www.tudorwatch.com/-/media/model-images/www/m79030n-0001/f.png'),
            new Watch(7, 'Cartier', 'Santos de Cartier', 'WSSA0029', 'Automatic', 'Steel', 'https://www.cartier.com/dw/image/v2/BFCY_PRD/on/demandware.static/-/Sites-cartier-master/default/dw83635391/images/large/wssa0029_01_santos_de_cartier_watch.png?sw=350&sh=350&sm=fit&sfrm=png'),
            new Watch(8, 'IWC', 'Portugieser Chronograph', 'IW371605', 'Automatic', 'Steel', 'https://www.iwc.com/content/dam/rcq/iwc/18/74/02/8/1874028.png.transform.global_image_png_350.png'),
            new Watch(9, 'Breitling', 'Navitimer B01', 'AB0138241G1P1', 'Automatic', 'Steel', 'https://www.breitling.com/avif/media/image/3/AB0138241G1P1/asset-version-8a71676df0/ab0138241g1p1-navitimer-b01-chronograph-43.png'),
            new Watch(10, 'Tag Heuer', 'Carrera', 'CBN2A1A.BA0643', 'Automatic', 'Steel', 'https://www.tagheuer.com/on/demandware.static/-/Sites-tagheuer-master/default/dw15db2b23/images/TAG_Heuer_Carrera/CBN2A1A.BA0643/CBN2A1A.BA0643_0913.png?impolicy=resize&width=380&height=380'),
            new Watch(11, 'Vacheron Constantin', 'Overseas', '4500V/110A-B128', 'Automatic', 'Steel', 'https://www.vacheron-constantin.com/dam/rcq/vacheron-constantin/16/41/39/1/1641391.png.transform.global_image_png_500.png'),
            new Watch(12, 'Jaeger-LeCoultre', 'Reverso Tribute', 'Q3978480', 'Manual', 'Steel', 'https://img.jaeger-lecoultre.com/product-sq-2000/q3978480_front_0.png'),
            new Watch(13, 'Panerai', 'Luminor Marina', 'PAM01312', 'Automatic', 'Steel', 'https://www.panerai.com/content/dam/rcq/panerai/18/43/40/0/1843400.png.transform.global_image_png_500.png'),
            new Watch(14, 'A. Lange & Söhne', 'Lange 1', '191.032', 'Manual', 'Pink Gold', 'https://www.alange-soehne.com/content/dam/alangesoehne/com/en/watches/lange-1/lange-1/lange-1-191-032-pink-gold-01.png?imwidth=480'),
            new Watch(15, 'Casio', 'G-Shock', 'GA-2100-1A1', 'Quartz', 'Resin', 'https://www.casio.com/content/dam/casio/product-info/locales/in/en/timepiece/product/watch/G/GA/GA2/ga-2100-1a1/assets/GA-2100-1A1.png.transform/product-panel/image.png'),
        ];
    }
}
