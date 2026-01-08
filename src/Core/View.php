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

    public static function url(string $path): string
    {
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        if ($scriptDir === '/') {
            $scriptDir = '';
        }
        return $scriptDir . '/' . ltrim($path, '/');
    }
}
