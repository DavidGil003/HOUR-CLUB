<?php ob_start(); ?>

<h1>ModBuilder Configurator</h1>
<p>Select components to build your custom watch. The system will ensure compatibility.</p>

<div class="grid" style="gap: 1.5rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
    <!-- Dials -->
    <div class="card">
        <h2>1. Select Dial</h2>
        <div
            style="margin-bottom: 1rem; height: 200px; background: #F1F5F9; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <img id="dial-preview" src="https://placehold.co/400x300?text=Select+Dial"
                style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
        <select id="dial-select" class="part-select" data-type="dial">
            <option value="" data-img="https://placehold.co/400x300?text=Select+Dial">-- Choose Dial --</option>
            <?php foreach ($parts['Dial'] as $part): ?>
                <option value="<?= $part->getId() ?>" data-img="<?= htmlspecialchars($part->getImageUrl()) ?>">
                    <?= htmlspecialchars($part->getName()) ?> - €<?= $part->getPrice() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Cases -->
    <div class="card">
        <h2>2. Select Case</h2>
        <div
            style="margin-bottom: 1rem; height: 200px; background: #F1F5F9; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <img id="case-preview" src="https://placehold.co/400x300?text=Select+Case"
                style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
        <select id="case-select" class="part-select" data-type="case">
            <option value="" data-img="https://placehold.co/400x300?text=Select+Case">-- Choose Case --</option>
            <?php foreach ($parts['Case'] as $part): ?>
                <option value="<?= $part->getId() ?>" data-img="<?= htmlspecialchars($part->getImageUrl()) ?>">
                    <?= htmlspecialchars($part->getName()) ?> - €<?= $part->getPrice() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Movements -->
    <div class="card">
        <h2>3. Select Movement</h2>
        <div
            style="margin-bottom: 1rem; height: 200px; background: #F1F5F9; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <img id="mvmt-preview" src="https://placehold.co/400x300?text=Select+Movement"
                style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
        <select id="mvmt-select" class="part-select" data-type="mvmt">
            <option value="" data-img="https://placehold.co/400x300?text=Select+Movement">-- Choose Movement --</option>
            <?php foreach ($parts['Movement'] as $part): ?>
                <option value="<?= $part->getId() ?>" data-img="<?= htmlspecialchars($part->getImageUrl()) ?>">
                    <?= htmlspecialchars($part->getName()) ?> - €<?= $part->getPrice() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Hands -->
    <div class="card">
        <h2>4. Select Hands</h2>
        <div
            style="margin-bottom: 1rem; height: 200px; background: #F1F5F9; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <img id="hands-preview" src="https://placehold.co/400x300?text=Select+Hands"
                style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
        <select id="hands-select" class="part-select" data-type="hands">
            <option value="" data-img="https://placehold.co/400x300?text=Select+Hands">-- Choose Hands --</option>
            <?php foreach ($parts['Hands'] as $part): ?>
                <option value="<?= $part->getId() ?>" data-img="<?= htmlspecialchars($part->getImageUrl()) ?>">
                    <?= htmlspecialchars($part->getName()) ?> - €<?= $part->getPrice() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Strap -->
    <div class="card">
        <h2>5. Select Strap</h2>
        <div
            style="margin-bottom: 1rem; height: 200px; background: #F1F5F9; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <img id="strap-preview" src="https://placehold.co/400x300?text=Select+Strap"
                style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
        <select id="strap-select" class="part-select" data-type="strap">
            <option value="" data-img="https://placehold.co/400x300?text=Select+Strap">-- Choose Strap --</option>
            <?php foreach ($parts['Strap'] as $part): ?>
                <option value="<?= $part->getId() ?>" data-img="<?= htmlspecialchars($part->getImageUrl()) ?>">
                    <?= htmlspecialchars($part->getName()) ?> - €<?= $part->getPrice() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="card"
    style="margin-top: 2rem; text-align: center; border: none !important; background: transparent !important;">
    <button id="validate-btn" class="btn" style="font-size: 1.2rem; min-width: 200px;">Validate Build</button>
    <p id="validation-result" style="margin-top: 1rem; font-weight: bold;"></p>
</div>

<script>
    // Image Preview Logic
    document.querySelectorAll('.part-select').forEach(select => {
        select.addEventListener('change', (e) => {
            const type = e.target.dataset.type;
            const option = e.target.options[e.target.selectedIndex];
            const imgUrl = option.dataset.img;
            document.getElementById(`${type}-preview`).src = imgUrl;
        });
    });

    // Validation Logic
    document.getElementById('validate-btn').addEventListener('click', async () => {
        const dialId = document.getElementById('dial-select').value;
        const caseId = document.getElementById('case-select').value;
        const mvmtId = document.getElementById('mvmt-select').value;
        const handsId = document.getElementById('hands-select').value;
        const strapId = document.getElementById('strap-select').value;

        if (!dialId || !caseId || !mvmtId || !handsId || !strapId) {
            alert('Please select all parts first.');
            return;
        }

        const res = await fetch('<?= \HorologyHub\Core\View::url('/builder/validate') ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ dialId, caseId, mvmtId, handsId, strapId })
        });

        const data = await res.json();
        const resultEl = document.getElementById('validation-result');
        resultEl.innerText = data.message;
        resultEl.style.color = data.valid ? '#4ade80' : '#f87171';
    });
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>