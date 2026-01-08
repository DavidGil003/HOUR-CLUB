<?php

declare(strict_types=1);

namespace HorologyHub\Services;

use HorologyHub\Models\Entity\WatchPart;

class CompatibilityEngine
{
    /**
     * Validates if a set of parts can form a complete watch.
     * @param WatchPart[] $parts
     * @return bool
     */
    public function validateBuild(array $parts): bool
    {
        // Simple O(N^2) check for now, can be optimized.
        foreach ($parts as $partA) {
            foreach ($parts as $partB) {
                if ($partA === $partB) {
                    continue;
                }

                if (!$partA->isCompatibleWith($partB)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Specific check: Does Dial fit Case?
     * Logic: Dial diameter must be <= Case opening diameter (simplified).
     */
    public function checkDialFitsCase(float $dialDiameter, float $caseOpening): bool
    {
        // Allow a small tolerance margin e.g. 0.1mm
        return $dialDiameter <= ($caseOpening + 0.1);
    }

    /**
     * Specific check: Is Movement compatible with Case?
     * Logic: Case must be designed for specific movement calibers (e.g. NH35).
     */
    public function checkMovementFitsCase(string $movementCaliber, array $caseCompatibleMovements): bool
    {
        return in_array($movementCaliber, $caseCompatibleMovements, true);
    }
}
