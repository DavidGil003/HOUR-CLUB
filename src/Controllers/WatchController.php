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

    public function show(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: ' . \HorologyHub\Core\View::url('/catalog'));
            return;
        }

        $watch = $this->repository->findById($id);

        if (!$watch) {
            http_response_code(404);
            View::render('errors/404', ['title' => 'Watch Not Found']); // Ideally create this view
            return;
        }

        View::render('watch/show', [
            'title' => $watch->getBrand() . ' ' . $watch->getModel(),
            'watch' => $watch
        ]);
    }
}
