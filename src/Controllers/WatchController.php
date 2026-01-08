<?php

declare(strict_types=1);

namespace HorologyHub\Controllers;

use HorologyHub\Core\View;
use HorologyHub\Models\Repository\WatchRepository;

class WatchController
{
    private WatchRepository $repository;

    public function __construct()
    {
        $this->repository = new WatchRepository();
    }

    public function index(): void
    {
        $watches = $this->repository->findAll();

        View::render('catalog/index', [
            'title' => 'Watch Catalog',
            'watches' => $watches
        ]);
    }
}
