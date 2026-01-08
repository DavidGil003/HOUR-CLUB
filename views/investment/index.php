<?php ob_start(); ?>

<h1>Market Value Analysis</h1>
<p>Compare value retention between "Full Set" and "Naked" watches.</p>

<div class="card">
    <canvas id="priceChart"></canvas>
</div>

<!-- Load Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('priceChart');
    const data = <?= json_encode($chartData) ?>;

    new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: { color: 'white' }
                },
                title: {
                    display: true,
                    text: 'Rolex Submariner Price Evolution',
                    color: 'white'
                }
            },
            scales: {
                y: {
                    ticks: { color: '#94a3b8' },
                    grid: { color: '#334155' }
                },
                x: {
                    ticks: { color: '#94a3b8' },
                    grid: { color: '#334155' }
                }
            }
        }
    });
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>