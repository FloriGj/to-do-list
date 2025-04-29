<?php

function connect()
{

    $host = 'localhost';
    $dbname = 'todolist_db';
    $username = 'root';
    $password = '';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    try {

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

// Get a list of all tiers in the database
function getTiers()
{
    try {

        $db = connect();
        if (!$db) {
            throw new Exception("Database connection is null.");
        }
        $tiersQuery = "SELECT * FROM tiers";
        $stmt = $db->query($tiersQuery);
        $tiers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tiers;
    } catch (Exception $e) {
        // If an error occurs echo the error
        echo $e->getMessage();
    }
}
