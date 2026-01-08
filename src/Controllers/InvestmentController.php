<?php

declare(strict_types=1);

namespace HorologyHub\Controllers;

use HorologyHub\Core\View;

class InvestmentController
{
    public function index(): void
    {
        // Mocking price history data for Chart.js
        // In real app, fetch from PriceHistoryRepository
        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'datasets' => [
                [
                    'label' => 'Rolex Submariner (Box & Papers)',
                    'data' => [13500, 13800, 14200, 14100, 14500, 14800],
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1
                ],
                [
                    'label' => 'Rolex Submariner (Naked)',
                    'data' => [11500, 11700, 11900, 11800, 12000, 12200],
                    'borderColor' => 'rgb(255, 99, 132)',
                    'tension' => 0.1
                ]
            ]
        ];

        View::render('investment/index', [
            'title' => 'Investment Analysis',
            'chartData' => $chartData
        ]);
    }
}
