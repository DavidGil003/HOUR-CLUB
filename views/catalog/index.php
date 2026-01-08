<?php ob_start(); ?>

<h1>Watch Catalog</h1>

<div class="seamless-grid">
    <?php foreach ($watches as $watch): ?>
        <a href="<?= \HorologyHub\Core\View::url('/watch?id=' . $watch->getId()) ?>" class="watch-card">
            <span class="price-badge">€12,450</span> <!-- Mock Dynamic Price -->
            <div style="height: 220px; overflow: hidden; margin-bottom: 1.5rem;">
                <img src="<?= htmlspecialchars($watch->getImageUrl()) ?>" alt="<?= htmlspecialchars($watch->getModel()) ?>"
                    style="width: 100%; height: 100%; object-fit: contain; mix-blend-mode: multiply;">
            </div>
            <h2>
                <?= htmlspecialchars($watch->getBrand()) ?>
                <br>
                <span
                    style="color: var(--text-primary); font-weight: 300;"><?= htmlspecialchars($watch->getModel()) ?></span>
            </h2>
            <p class="ref">REF: <?= htmlspecialchars($watch->getReferenceNumber()) ?></p>
        </a>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>