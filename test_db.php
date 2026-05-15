php -d xdebug.mode=off test_db.php<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Testing database connection...\n";

try {
    // Try to connect without any timeout
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=laravel_db', 'root', '', [
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    echo "✓ Connected successfully!\n";
    
    // Check if sessions table exists
    $result = $pdo->query("SHOW TABLES");
    $tables = $result->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Tables in database:\n";
    foreach ($tables as $table) {
        echo "  - " . $table . "\n";
    }
    
    if (in_array('sessions', $tables)) {
        echo "✓ Sessions table exists\n";
    } else {
        echo "✗ Sessions table missing\n";
        
        // Try to create sessions table
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS sessions (
                id VARCHAR(255) PRIMARY KEY,
                user_id BIGINT UNSIGNED NULL,
                ip_address VARCHAR(45) NULL,
                user_agent TEXT NULL,
                payload LONGTEXT NOT NULL,
                last_activity INT NOT NULL,
                INDEX (user_id),
                INDEX (last_activity)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        echo "✓ Sessions table created\n";
    }
    
} catch (PDOException $e) {
    echo "✗ Connection failed: " . $e->getMessage() . "\n";
    echo "Check if MySQL is running on port 3306\n";
}
