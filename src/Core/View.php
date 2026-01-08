<?php

declare(strict_types=1);

namespace HorologyHub\Core;

class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data);

        $viewFile = __DIR__ . '/../../views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new \RuntimeException("View not found: $viewFile");
        }

        require $viewFile;
    }
}
