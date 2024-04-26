<?php
require_once "/opt/src/cs4640-FitPro/Config.php";
require_once "/opt/src/cs4640-FitPro/Database.php";
// require_once '/students/vpv4ds/students/vpv4ds/opt/src/cs4640-FitPro/Config.php';
// require_once '/students/vpv4ds/students/vpv4ds/opt/src/cs4640-FitPro/Database.php';

$db = new Database();

pg_query($db->getConnection(), "CREATE SEQUENCE IF NOT EXISTS user_seq;");
pg_query($db->getConnection(), "CREATE SEQUENCE IF NOT EXISTS exercise_seq;");
pg_query(
    $db->getConnection(),
    "CREATE SEQUENCE IF NOT EXISTS user_exercise_seq;"
);
pg_query(
    $db->getConnection(),
    "CREATE SEQUENCE IF NOT EXISTS user_workouts_seq;"
);

pg_query($db->getConnection(), "DROP TABLE users CASCADE;");
pg_query($db->getConnection(), "DROP TABLE exercises CASCADE;");
pg_query($db->getConnection(), "DROP TABLE user_exercises CASCADE;");
pg_query($db->getConnection(), "DROP TABLE user_workouts CASCADE;");

// users table
$createUsersTableSQL = <<<SQL
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY DEFAULT nextval('user_seq'),
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    workouts INT,
    user_description VARCHAR(255)
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
$exerciseNames = ['Squat', 'Bench Press', 'Deadlift', 'Bicep Curls', 'Leg Extensions', 'Push-ups'];
foreach ($exerciseNames as $name) {
    $insertExerciseSQL =
        "INSERT INTO exercises (name) VALUES ($1) ON CONFLICT (name) DO NOTHING;";
    pg_prepare($db->getConnection(), "", $insertExerciseSQL);
    pg_execute($db->getConnection(), "", [$name]);
}

// user exercises - tracks the reps, sets, and weight
$createUserExercisesTableSQL = <<<SQL
CREATE TABLE IF NOT EXISTS user_exercises (
    id INT PRIMARY KEY DEFAULT nextval('user_exercise_seq'),
    user_id INT,
    exercise_id INT,
    sets INT,
    reps INT,
    rest INT,
    total_reps INT,
    weight INT,
    date_performed DATE,
    workout INT,
    completed BOOLEAN DEFAULT FALSE,
    workout_name VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (exercise_id) REFERENCES exercises(id)
);
SQL;
pg_query($db->getConnection(), $createUserExercisesTableSQL);

// create the workouts table
$createWorkoutsTableSQL = <<<SQL
CREATE TABLE IF NOT EXISTS user_workouts (
    id INT PRIMARY KEY DEFAULT nextval('user_workouts_seq'),
    monday_id INT,
    tuesday_id INT,
    wednesday_id INT,
    thursday_id INT,
    friday_id INT,
    saturday_id INT,
    sunday_id INT
);
SQL;
pg_query($db->getConnection(), $createWorkoutsTableSQL);

$createLeaderboardsTableSQL = <<<SQL
CREATE TABLE IF NOT EXISTS leaderboards (
    id INT PRIMARY KEY DEFAULT nextval('user_exercise_seq'),  
    exercise_id INT,
    username VARCHAR(255) NOT NULL,
    weight INT,
    FOREIGN KEY (exercise_id) REFERENCES exercises(id)
);
SQL;
pg_query($db->getConnection(), $createLeaderboardsTableSQL);

$fauxValues = [
    ["exercise_id" => 1, "username" => "JohnDoe", "weight" => 300], // Squats
    ["exercise_id" => 1, "username" => "JaneDoe", "weight" => 250],
    ["exercise_id" => 2, "username" => "JohnDoe", "weight" => 200], // Bench Press
    ["exercise_id" => 2, "username" => "JaneDoe", "weight" => 180],
    ["exercise_id" => 3, "username" => "JohnDoe", "weight" => 400], // Deadlift
    ["exercise_id" => 3, "username" => "JaneDoe", "weight" => 350],
];

foreach ($fauxValues as $entry) {
    $insertSQL =
        "INSERT INTO leaderboards (exercise_id, username, weight) VALUES ($1, $2, $3);";
    pg_prepare($db->getConnection(), "", $insertSQL);
    pg_execute($db->getConnection(), "", [
        $entry["exercise_id"],
        $entry["username"],
        $entry["weight"],
    ]);
}

echo "Database tables initialized successfully.";

$query =
    "SELECT exercise_id, username, weight FROM leaderboards ORDER BY exercise_id, weight DESC";
$result = pg_query($db->getConnection(), $query);

if (!$result) {
    echo "An error occurred.\n";
    exit();
}

echo "<table border='1'>";
echo "<tr><th>Exercise ID</th><th>Username</th><th>Weight</th></tr>";

while ($row = pg_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["exercise_id"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["weight"]) . "</td>";
    echo "</tr>";
}

echo "</table>";

pg_free_result($result);
?>
