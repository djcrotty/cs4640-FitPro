<?php
require_once '/opt/src/cs4640-FitPro/Config.php';
require_once '/opt/src/cs4640-FitPro/Database.php';

$db = new Database();

pg_query($db->getConnection(), "CREATE SEQUENCE IF NOT EXISTS user_seq;");
pg_query($db->getConnection(), "CREATE SEQUENCE IF NOT EXISTS exercise_seq;");
pg_query($db->getConnection(), "CREATE SEQUENCE IF NOT EXISTS user_exercise_seq;");

// users table
$createUsersTableSQL = <<<SQL
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY DEFAULT nextval('user_seq'),
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);
SQL;
pg_query($db->getConnection(), $createUsersTableSQL);

// create the exercise table
$createExercisesTableSQL = <<<SQL
CREATE TABLE IF NOT EXISTS exercises (
    id INT PRIMARY KEY DEFAULT nextval('exercise_seq'),
    name VARCHAR(255) NOT NULL UNIQUE
);
SQL;
pg_query($db->getConnection(), $createExercisesTableSQL);

// Only three exercises tracked right now, we'll add more later
$exerciseNames = ['Squat', 'Bench Press', 'Deadlift'];
foreach ($exerciseNames as $name) {
    $insertExerciseSQL = "INSERT INTO exercises (name) VALUES ($1) ON CONFLICT (name) DO NOTHING;";
    pg_prepare($db->getConnection(), "", $insertExerciseSQL);
    pg_execute($db->getConnection(), "", array($name));
}

// user exercises - tracks the reps, sets, and weight
$createUserExercisesTableSQL = <<<SQL
CREATE TABLE IF NOT EXISTS user_exercises (
    id INT PRIMARY KEY DEFAULT nextval('user_exercise_seq'),
    user_id INT,
    exercise_id INT,
    sets INT,
    reps INT,
    weight INT,
    date_performed DATE,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (exercise_id) REFERENCES exercises(id)
);
SQL;
pg_query($db->getConnection(), $createUserExercisesTableSQL);

echo "Database tables initialized successfully.";
?>
