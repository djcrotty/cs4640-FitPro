<?php
class Database {
  private $dbConnection;

  public function __construct() {
      // Database connection setup as previously shown
      $this->dbConnection = pg_connect("host=" . Config::$db['host'] . " port=" . Config::$db['port'] . " dbname=" . Config::$db['database'] . " user=" . Config::$db['user'] . " password=" . Config::$db['password']);
      if (!$this->dbConnection) {
          die("Connection failed: " . pg_last_error());
      }
  }

  public function insertUser($name, $email, $passwordHash) {
      // Prepare the INSERT statement to avoid SQL injection
      $stmtName = "insert_user";
      $query = "INSERT INTO users (name, email, password_hash) VALUES ($1, $2, $3)";

      // Prepare the query
      $prepareResult = pg_prepare($this->dbConnection, $stmtName, $query);

      // Check if preparation was successful
      if ($prepareResult === false) {
          echo "Error preparing the INSERT statement: " . pg_last_error($this->dbConnection);
          return false;
      }

      // Execute the prepared statement with the user data
      $executeResult = pg_execute($this->dbConnection, $stmtName, array($name, $email, $passwordHash));

      // Check execution success
      if ($executeResult === false) {
          echo "Error executing the INSERT statement: " . pg_last_error($this->dbConnection);
          return false;
      }

      return true; // Successful insertion
  }

  public function getConnection() {
    return $this->dbConnection;
  }

  public function authenticateUser($email, $password) {
    $result = pg_prepare($this->dbConnection, "fetch_user", "SELECT * FROM users WHERE email = $1 LIMIT 1");
    $result = pg_execute($this->dbConnection, "fetch_user", array($email));

    if ($result && pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            return true;
        }
    }
    return false;
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