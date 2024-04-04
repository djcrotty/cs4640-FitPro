<?php
require_once 'Config.php';
require_once 'Database.php';

$db = new Database();

// user ID sequence
pg_query($db->getConnection(), "CREATE SEQUENCE IF NOT EXISTS user_seq;");

// users table
$createTableSQL = "CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY DEFAULT nextval('user_seq'),
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);";

$result = pg_query($db->getConnection(), $createTableSQL);
if ($result) {
    echo "Database initialized successfully.";
} else {
    echo "Error initializing database: " . pg_last_error($db->getConnection());
}
?>

