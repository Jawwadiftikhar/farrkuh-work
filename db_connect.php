<?php

$dbname = "farrukhwork";
$hostname = "localhost";
$username = "farrukhwork";
$password = "farrukhwork";

$dsn = "mysql:host=$hostname;dbname=$dbname";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
