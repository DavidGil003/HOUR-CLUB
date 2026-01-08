<?php

declare(strict_types=1);

namespace HorologyHub\Controllers;

use HorologyHub\Core\View;
use HorologyHub\Models\Repository\PartRepository;
use HorologyHub\Services\CompatibilityEngine;

class BuilderController
{
    private PartRepository $repo;

    public function __construct()
    {
        $this->repo = new PartRepository();
    }

    public function index(): void
    {
        $parts = $this->repo->findAll();

        // Group parts by type for the UI
        $grouped = [
            'Dial' => [],
            'Case' => [],
            'Movement' => []
        ];

        foreach ($parts as $part) {
            $grouped[$part->getPartType()][] = $part;
        }

        View::render('builder/index', [
            'title' => 'Seiko Mod Builder',
            'parts' => $grouped
        ]);
    }

    public function validate(): void
    {
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents('php://input'), true);

        $dialId = (int) ($input['dialId'] ?? 0);
        $caseId = (int) ($input['caseId'] ?? 0);
        $mvmtId = (int) ($input['mvmtId'] ?? 0);

        if (!$dialId || !$caseId || !$mvmtId) {
            echo json_encode(['valid' => false, 'message' => 'Missing parts selection.']);
            return;
        }

        $dial = $this->repo->findById($dialId);
        $case = $this->repo->findById($caseId);
        $mvmt = $this->repo->findById($mvmtId);

        if (!$dial || !$case || !$mvmt) {
            echo json_encode(['valid' => false, 'message' => 'Invalid part selection.']);
            return;
        }

        // Validate Compatibility
        // 1. Dial fits Case?
        if (!$dial->isCompatibleWith($case)) {
            echo json_encode(['valid' => false, 'message' => "Dial '{$dial->getName()}' does not fit Case '{$case->getName()}'."]);
            return;
        }

        // 2. Movement fits Case?
        if (!$case->isCompatibleWith($mvmt)) {
            echo json_encode(['valid' => false, 'message' => "Case '{$case->getName()}' is not compatible with Movement '{$mvmt->getName()}'."]);
            return;
        }

        echo json_encode(['valid' => true, 'message' => 'Great build! All parts are compatible.']);
    }
}
