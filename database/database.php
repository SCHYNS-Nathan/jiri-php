<?php

function getPDO(): PDO
{
    define('CONFIG_PATH', '.env.local.ini');

    if (file_exists(CONFIG_PATH)) {
        $config = parse_ini_file(CONFIG_PATH, true);

        $driver = $config['DATABASE']['DB_DRIVER'];
        $host = $config['DATABASE']['DB_HOST'];
        $port = $config['DATABASE']['DB_PORT'];
        $dbname = $config['DATABASE']['DB_NAME'];
        $charset = $config['DATABASE']['DB_CHARSET'];
    }
    else {
        die('Un problème est survenue lors de l‘initiation de l‘application, veuillez contactez l‘administrateur.');
    }

    $dsn = sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s', $driver, $host, $port, $dbname, $charset);
    $username = 'root';
    $password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ];

    try {
        $db = new PDO($dsn, $username, $password, $options);
    }
    catch (PDOException $exception) {
        die('Un problème de connexion avec la base de donnée est survenue, veuillez contactez l‘administrateur.');
    }

    return $db;
}