<?php

declare(strict_types=1);

namespace HorologyHub\Models\Repository;

use HorologyHub\Models\Entity\WatchPart;
use HorologyHub\Models\Entity\Dial;
use HorologyHub\Models\Entity\CasePart;
use HorologyHub\Models\Entity\Movement;

class PartRepository
{
    /**
     * @return WatchPart[]
     */
    public function findAll(): array
    {
        // Mock data for Phase 3 UI development
        return [
            // Dials
            new Dial(101, 'Sunburst Blue Dial', 45.00, 'https://modmodewatches.com/cdn/shop/files/Seiko-5-srpe53-oem-dial-sunburst-blue-28-5mm-Day-date-window-Mod-Mode-Watches-5.jpg?v=1716949392', ['diameter' => 28.5], ['NH35', 'NH36']),
            new Dial(102, 'Matte Black Scuba', 40.00, 'https://modmodewatches.com/cdn/shop/files/Seiko-5-srpd55-oem-dial-black-28-5mm-Day-date-window-Mod-Mode-Watches-4.jpg?v=1716949219', ['diameter' => 28.5], ['NH35']),
            new Dial(103, 'White Enamel Roman', 55.00, 'https://modmodewatches.com/cdn/shop/files/Seiko-5-srpc35-oem-dial-black-28-5mm-Day-date-window-Mod-Mode-Watches-4.jpg?v=1716949229', ['diameter' => 28.5], ['NH35', 'NH36']),

            // Cases
            new CasePart(201, 'Submariner Style Case', 89.00, 'https://modmodewatches.com/cdn/shop/files/Skx007-Style-Conversion-Case-Polished-Silver-For-Srp-Turtle-Reissue-mod-mode-watches-6.jpg?v=1697521502', ['dial_opening' => 28.5], ['NH35', 'NH36']),
            new CasePart(202, 'Dress Watch Case', 75.00, 'https://modmodewatches.com/cdn/shop/files/Nmk940-Gs-Dress-Watch-Case-Bundle-Steel-Finish-Mod-Mode-Watches-6.jpg?v=1690861110', ['dial_opening' => 28.5], ['NH35']),

            // Movements
            new Movement(301, 'Seiko NH35 Automatic', 42.00, 'https://modmodewatches.com/cdn/shop/products/Seiko-Sii-Nh35a-Automatic-Movement-Mod-Mode-Watches-4.jpg?v=1630327339', []),
            new Movement(302, 'Miyota 9015', 85.00, 'https://static.wixstatic.com/media/d54fd5_5a4e76878c434241957262f3e8b01037~mv2.jpg/v1/fill/w_480,h_356,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/d54fd5_5a4e76878c434241957262f3e8b01037~mv2.jpg', []),

            // Hands
            new \HorologyHub\Models\Entity\Hands(401, 'Mercedes Hands Silver', 15.00, 'https://modmodewatches.com/cdn/shop/files/MMW-Merc-Hand-Set-Polished-Silver-C3-Lume-mod-mode-watches-2.jpg?v=1686641214', [], ['NH35', 'NH36']),
            new \HorologyHub\Models\Entity\Hands(402, 'Dauphine Hands Blue', 18.00, 'https://modmodewatches.com/cdn/shop/products/Dauphin-Hand-set-Polished-Silver-Finish-Mod-Mode-Watches-2_16279f06-e7de-4903-810a-7da65d95fe8a.jpg?v=1626084063', [], ['NH35', 'NH36']),

            // Straps
            new \HorologyHub\Models\Entity\Strap(501, 'Oyster Steel Bracelet', 45.00, 'https://modmodewatches.com/cdn/shop/products/C028-Curved-End-Oyster-Bracelet-Polished-and-Brushed-Silver-Finish-For-Skx007-Mod-Mode-Watches-4.jpg?v=1630125867', [], []),
            new \HorologyHub\Models\Entity\Strap(502, 'Leather Brown Strap', 25.00, 'https://m.media-amazon.com/images/I/71R2o5-kQjL._AC_UY1000_.jpg', [], []),
            new \HorologyHub\Models\Entity\Strap(503, 'NATO Black/Grey', 15.00, 'https://m.media-amazon.com/images/I/71r9WvXqTXL._AC_UY1000_.jpg', [], []),
        ];
    }

    public function findById(int $id): ?WatchPart
    {
        $parts = $this->findAll();
        foreach ($parts as $part) {
            if ($part->getId() === $id) {
                return $part;
            }
        }
        return null;
    }
}
