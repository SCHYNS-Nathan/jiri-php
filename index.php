<?php

require_once './database/database.php';

$db = getPDO();

$statement_finished_jiris = $db->query('SELECT * FROM jiris WHERE starting_at < CURRENT_TIMESTAMP');
$statement_upcoming_jiris = $db->query('SELECT * FROM jiris WHERE starting_at > CURRENT_TIMESTAMP');

$finished_jiris = $statement_finished_jiris->fetchAll();
$upcoming_jiris = $statement_upcoming_jiris->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jiri</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <a class="sr-only" href="#main-menu">
        Aller au menu principal
    </a>
    <div class="flex flex-col-reverse gap-5">
        <main class="flex flex-col gap-5 container mx-auto">
            <h1 class="text-xl font-bold">
                Jiris
            </h1>
            <section>
                <h2 class="font-bold">
                    Jiris à venir
                </h2>
                <?php if (count($upcoming_jiris) > 0): ?>
                    <ol>
                        <?php foreach ($upcoming_jiris as $jiri): ?>
                            <li>
                                <a href="/jiris/<?= $jiri->id ?>" class="text-blue-500 underline hover:text-blue-300"><?= $jiri->name ?></a>
                            </li>
                        <?php endforeach ?>
                    </ol>
                <?php else: ?>
                    <p>
                        Il n'y a pas de jiri à venir !
                    </p>
                <?php endif ?>
            </section>
            <section>
                <h2 class="font-bold">
                    Jiris terminés
                </h2>
                <?php if (count($finished_jiris) > 0): ?>
                    <ol>
                        <?php foreach ($finished_jiris as $jiri): ?>
                            <li>
                                <a href="/jiris/<?= $jiri->id ?>" class="text-blue-500 underline hover:text-blue-300"><?= $jiri->name ?></a>
                            </li>
                        <?php endforeach ?>
                    </ol>
                <?php else: ?>
                    <p>
                        Il n'y a pas de jiri terminé !
                    </p>
                <?php endif ?>
            </section>
        </main>
        <nav id="main-menu" class="bg-gray-300">
            <h2 class="sr-only">
                Menu principal
            </h2>
            <ul class="flex gap-4">
                <li>
                    <a href="/jiris">Jiris</a>
                </li>
                <li>
                    <a href="/contacts">Contacts</a>
                </li>
                <li>
                    <a href="/projects">Projects</a>
                </li>
            </ul>
        </nav>
    </div>
</body>
</html>