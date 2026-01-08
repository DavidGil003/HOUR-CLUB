<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?? 'HorologyHub' ?>
    </title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a;
            color: #f8fafc;
            margin: 0;
        }

        nav {
            background: #1e293b;
            padding: 1rem;
            border-bottom: 1px solid #334155;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 1.5rem;
            font-weight: 500;
        }

        nav a:hover {
            color: #38bdf8;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        h1,
        h2 {
            color: #38bdf8;
        }

        .btn {
            background: #38bdf8;
            color: #0f172a;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <nav>
        <div class="container" style="padding: 0; display: flex; align-items: center;">
            <a href="/" style="font-size: 1.5rem; font-weight: bold;">HorologyHub</a>
            <a href="/catalog">Catalog</a>
            <a href="/builder">ModBuilder</a>
            <a href="/investment">Investment</a>
        </div>
    </nav>
    <main class="container">
        <?= $content ?? '' ?>
    </main>
</body>

</html>