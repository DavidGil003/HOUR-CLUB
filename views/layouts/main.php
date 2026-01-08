<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?? 'HorologyHub' ?>
    </title>
    <link rel="stylesheet" href="<?= \HorologyHub\Core\View::url('/style.css') ?>?v=<?= time() ?>">
</head>

<body>
    <nav>
        <div class="container">
            <a href="<?= \HorologyHub\Core\View::url('/') ?>" class="brand">HorologyHub</a>
            <div class="nav-links">
                <a href="<?= \HorologyHub\Core\View::url('/catalog') ?>">Catalog</a>
                <a href="<?= \HorologyHub\Core\View::url('/builder') ?>">ModBuilder</a>
                <a href="<?= \HorologyHub\Core\View::url('/investment') ?>">Investment</a>
            </div>
        </div>
    </nav>
    <main class="container">
        <?= $content ?? '' ?>
    </main>
</body>

</html>