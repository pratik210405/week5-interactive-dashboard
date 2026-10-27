<?php
// Update these values to match your local MySQL setup.
$host = 'localhost';
$dbname = 'week5_dashboard';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    http_response_code(500);
    die('Database connection failed. Import database.sql in phpMyAdmin and check db.php settings.');
}
?>
