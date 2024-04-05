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
        $query = "INSERT INTO users (name, email, password_hash) VALUES ($1, $2, $3)";

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
        return $this->query("SELECT name,id FROM users WHERE email = $email;");
    }

    public function insertWeight($userId, $exerciseId, $weight) {
        $query = "INSERT INTO user_exercises (user_id, exercise_id, weight, date_performed) VALUES ($1, $2, $3, CURRENT_DATE) ON CONFLICT (user_id, exercise_id) DO UPDATE SET weight = EXCLUDED.weight";
    
        $result = pg_prepare($this->dbConnection, "insert_weight", $query);
    
        $result = pg_execute($this->dbConnection, "insert_weight", array($userId, $exerciseId, $weight));
        if (!$result) {
            echo "Execute failed: " . pg_last_error($this->dbConnection);
            return false;
        }
    
        return true;
    }
    


}
?>