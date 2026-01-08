<?php ob_start(); ?>

<div style="margin-top: 2rem;">
    <a href="<?= \HorologyHub\Core\View::url('/catalog') ?>" class="btn" style="background: #334155;">&larr; Back to
        Catalog</a>
</div>

<div class="card" style="margin-top: 2rem; display: flex; gap: 2rem; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 300px;">
        <img src="<?= htmlspecialchars($watch->getImageUrl()) ?>" alt="<?= htmlspecialchars($watch->getModel()) ?>"
            style="width: 100%; border-radius: 0.5rem; object-fit: cover;">
    </div>
    <div style="flex: 1; min-width: 300px;">
        <h1 style="margin-top: 0;">
            <?= htmlspecialchars($watch->getBrand()) ?>
            <?= htmlspecialchars($watch->getModel()) ?>
        </h1>
        <h3 style="color: #94a3b8;">
            <?= htmlspecialchars($watch->getReferenceNumber()) ?>
        </h3>

        <div style="margin-top: 2rem;">
            <p><strong>Movement:</strong>
                <?= htmlspecialchars($watch->getMovementType()) ?>
            </p>
            <p><strong>Case Material:</strong>
                <?= htmlspecialchars($watch->getCaseMaterial()) ?>
            </p>
            <p><strong>Release:</strong>
                <?= htmlspecialchars($watch->getCreatedAt() ?? 'N/A') ?>
            </p>
        </div>

        <div style="margin-top: 3rem;">
            <button class="btn" style="width: 100%; text-align: center; font-size: 1.2rem;">Add to Collection</button>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>