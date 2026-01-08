<?php ob_start(); ?>

<div style="text-align: center; margin-top: 4rem;">
    <h1 style="font-size: 4rem; color: #f87171;">404</h1>
    <h2>Page Not Found</h2>
    <p>The page referenced does not exist.</p>
    <a href="<?= \HorologyHub\Core\View::url('/') ?>" class="btn" style="margin-top: 2rem; display: inline-block;">Go
        Home</a>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>