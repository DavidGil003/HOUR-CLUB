<?php ob_start(); ?>

<h1>ModBuilder Configurator</h1>
<p>Select components to build your custom watch. The system will ensure compatibility.</p>

<div class="grid">
    <!-- Dials -->
    <div class="card">
        <h2>1. Select Dial</h2>
        <select id="dial-select" style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
            <option value="">-- Choose Dial --</option>
            <?php foreach ($parts['Dial'] as $part): ?>
                <option value="<?= $part->getId() ?>">
                    <?= htmlspecialchars($part->getName()) ?> - €
                    <?= $part->getPrice() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Calls -->
    <div class="card">
        <h2>2. Select Case</h2>
        <select id="case-select" style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
            <option value="">-- Choose Case --</option>
            <?php foreach ($parts['Case'] as $part): ?>
                <option value="<?= $part->getId() ?>">
                    <?= htmlspecialchars($part->getName()) ?> - €
                    <?= $part->getPrice() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Movements -->
    <div class="card">
        <h2>3. Select Movement</h2>
        <select id="mvmt-select" style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
            <option value="">-- Choose Movement --</option>
            <?php foreach ($parts['Movement'] as $part): ?>
                <option value="<?= $part->getId() ?>">
                    <?= htmlspecialchars($part->getName()) ?> - €
                    <?= $part->getPrice() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="card" style="margin-top: 2rem; text-align: center;">
    <button id="validate-btn" class="btn" style="font-size: 1.2rem;">Validate Build</button>
    <p id="validation-result" style="margin-top: 1rem; font-weight: bold;"></p>
</div>

<script>
    document.getElementById('validate-btn').addEventListener('click', async () => {
        const dialId = document.getElementById('dial-select').value;
        const caseId = document.getElementById('case-select').value;
        const mvmtId = document.getElementById('mvmt-select').value;

        if (!dialId || !caseId || !mvmtId) {
            alert('Please select all parts first.');
            return;
        }

        const res = await fetch('/builder/validate', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ dialId, caseId, mvmtId })
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