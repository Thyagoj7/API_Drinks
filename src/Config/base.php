<?php

// Load configuration file
$config = parse_ini_file('database.php');

// Extract connection parameters
$dsn = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";
$username = $config['username'];
$password = $config['password'];

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Perform database operations using $pdo
