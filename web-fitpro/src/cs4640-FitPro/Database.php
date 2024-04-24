<?php
class Database {
    private $dbConnection;

    public function __construct() {
        // Database connection
        $this->dbConnection = pg_connect("host=" . Config::$db['host'] . " port=" . Config::$db['port'] . " dbname=" . Config::$db['database'] . " user=" . Config::$db['user'] . " password=" . Config::$db['password']);
        if (!$this->dbConnection) {
            die("Connection failed: " . pg_last_error());
        }
    }

    public function query($query, ...$params) {
        $res = pg_query_params($this->dbConnection, $query, $params);

        if ($res === false) {
            echo pg_last_error($this->dbConnection);
            return false;
        }

        return pg_fetch_all($res);
    }

    public function insertUser($name, $email, $passwordHash) {
        $stmtName = "insert_user";
        $query = "INSERT INTO users (name, email, password_hash, workouts) VALUES ($1, $2, $3, 0)";

        $prepareResult = pg_prepare($this->dbConnection, $stmtName, $query);

        if ($prepareResult === false) {
            echo "Error preparing the INSERT statement: " . pg_last_error($this->dbConnection);
            return false;
        }

        $executeResult = pg_execute($this->dbConnection, $stmtName, array($name, $email, $passwordHash));

        if ($executeResult === false) {
            echo "Error executing the INSERT statement: " . pg_last_error($this->dbConnection);
            return false;
        }

        return true; 
    }

    public function getConnection() {
    return $this->dbConnection;
    }

    public function authenticateUser($email, $password) {
    $result = pg_prepare($this->dbConnection, "fetch_user", "SELECT * FROM users WHERE email = $1 LIMIT 1");
    $result = pg_execute($this->dbConnection, "fetch_user", array($email));

    if ($result && pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
        if (password_verify($password, $user['password_hash'])) {
            return true;
        }
    }
    return false;
    }

    public function getUserInfo($email) {
        $result = pg_prepare($this->dbConnection, "fetch_user", "SELECT name, id, workouts FROM users WHERE email = $1 LIMIT 1");
        $result = pg_execute($this->dbConnection, "fetch_user", array($email));
        return pg_fetch_all($result)[0];
    }

    public function getUserNameEmail($id) {
        $result = $this->query("SELECT name, email FROM users WHERE id = $id LIMIT 1");
        return $result;
    }

    public function getExercises() {
        $result = $this->query("SELECT * FROM exercises");
        $res = [];
        foreach ($result as $exercise){
            $res[$exercise["id"]] = $exercise["name"];
        }
        return $res;
    }
    public function insertExercise($user_id, $exercise_id, $sets, $reps, $rest, $weight, $workout_num, $workout_name) {
        $res = $this->query("UPDATE users SET workouts = $workout_num WHERE id = $user_id");
        
        $res = pg_query_params($this->dbConnection, "INSERT INTO user_exercises (user_id, exercise_id, sets, reps, rest, total_reps, weight, date_performed, workout, workout_name) VALUES
        ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)", [$user_id, $exercise_id, $sets, $reps, $rest, 0, $weight, "2024-04-04", $workout_num, $workout_name]);
        
        if ($res === false) {
            echo pg_last_error($this->dbConnection);
            return false;
        }

        return pg_fetch_all($res);
    }

    public function getWorkout($user_id, $workout_num) {
        $result = $this->query("SELECT * FROM user_exercises WHERE user_id = $user_id AND workout = $workout_num");
        return $result;
    }

    public function insertWeight($user_id, $exerciseId, $weight) {
        $query = "UPDATE user_exercises SET weight = $weight WHERE user_id = $user_id AND exercise_id = $exerciseId";
    
        $result = $this->query($query);
        if (!$result) {
            echo "Execute failed: " . pg_last_error($this->dbConnection);
            return false;
        }
    
        return true;
    }

    public function deleteUser($email) {
        $stmtName = "delete_user";
        $query = "DELETE FROM users WHERE email = $1";
      
        $prepareResult = pg_prepare($this->dbConnection, $stmtName, $query);
      
        if ($prepareResult === false) {
            echo "Error preparing the DELETE statement: " . pg_last_error($this->dbConnection);
            return false;
        }
      
        $executeResult = pg_execute($this->dbConnection, $stmtName, array($email));
      
        if ($executeResult === false) {
            echo "Error executing the DELETE statement: " . pg_last_error($this->dbConnection);
            return false;
        }
      
        return true;
      }
}
?>