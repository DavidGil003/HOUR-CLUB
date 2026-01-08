<?php ob_start(); ?>

<h1>Watch Catalog</h1>

<div class="grid">
    <?php foreach ($watches as $watch): ?>
        <div class="card">
            <h2>
                <?= htmlspecialchars($watch->getBrand()) ?>
                <?= htmlspecialchars($watch->getModel()) ?>
            </h2>
            <p><strong>Ref:</strong>
                <?= htmlspecialchars($watch->getReferenceNumber()) ?>
            </p>
            <p><strong>Movement:</strong>
                <?= htmlspecialchars($watch->getMovementType() ?? 'N/A') ?>
            </p>
            <div style="margin-top: 1rem;">
                <a href="/watch?id=<?= $watch->getId() ?>" class="btn">View Details</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>