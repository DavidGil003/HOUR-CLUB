<?php ob_start(); ?>

<div style="margin-top: 2rem;">
    <a href="<?= \HorologyHub\Core\View::url('/catalog') ?>" class="btn"
        style="background: var(--text-primary); color: var(--bg-primary);">&larr; Back to Catalog</a>
</div>

<div class="grid"
    style="margin-top: 3rem; gap: 4rem; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); align-items: start;">
    <div style="background: #F8FAFC; padding: 2rem;">
        <img src="<?= htmlspecialchars($watch->getImageUrl()) ?>" alt="<?= htmlspecialchars($watch->getModel()) ?>"
            style="width: 100%; object-fit: contain; mix-blend-mode: multiply;">
    </div>
    <div>
        <h1 style="font-size: 2.5rem; text-transform: uppercase; letter-spacing: -0.02em; margin-bottom: 0.5rem;">
            <?= htmlspecialchars($watch->getBrand()) ?></h1>
        <h2 style="font-size: 1.5rem; font-weight: 300; color: var(--text-secondary); margin-bottom: 2rem;">
            <?= htmlspecialchars($watch->getModel()) ?></h2>

        <div
            style="border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 2rem 0; margin-bottom: 2rem;">
            <p style="margin-bottom: 1rem;"><strong
                    style="text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em; display: block; margin-bottom: 0.25rem;">Reference</strong>
                <?= htmlspecialchars($watch->getReferenceNumber()) ?></p>
            <p style="margin-bottom: 1rem;"><strong
                    style="text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em; display: block; margin-bottom: 0.25rem;">Movement</strong>
                <?= htmlspecialchars($watch->getMovementType()) ?></p>
            <p style="margin-bottom: 1rem;"><strong
                    style="text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em; display: block; margin-bottom: 0.25rem;">Material</strong>
                <?= htmlspecialchars($watch->getCaseMaterial()) ?></p>
        </div>

        <button class="btn" style="width: 100%; text-align: center; font-size: 1rem; padding: 1rem;">Add to
            Collection</button>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>