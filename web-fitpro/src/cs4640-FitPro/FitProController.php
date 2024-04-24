<?php
spl_autoload_register(function ($classname) {
    include($GLOBALS["src_path"]."$classname.php");
});

class FitProController {

    // An error message to display on the welcome page
    private $errorMessage = "";

    /**
     * Constructor
     */
    public function __construct($input) {
        session_start(); // start a session!
        
        // Set input
        $this->input = $input;
    }

    /**
     * Run the server
     * 
     * Given the input (usually $_GET), then it will determine
     * which command to execute based on the given "command"
     * parameter.  Default is the welcome page.
     */
    public function run() {
        // Get the command
        $command = "welcome";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        // If the session doesn't have the key "name", AND they
        // are not trying to login (UPDATE!), then they
        // got here without going through the welcome page, so we
        // should send them back to the welcome page only.
        if (!isset($_SESSION["user_logged_in"]) && $command != "signin" && $command != "register" && $command != "showRegister")
            $command = "welcome";

        switch($command) {
            case "signin":
                $this->signIn();
                break;
            case "register":
                $this->register();
                break;
            case "leaderboards":
                $this->showLeaderboards();
                break;
            case "leaderboards-json":
                $this->leaderboardsjson();
                break;
            case "workouts":
                $this->showWorkouts();
                break;
            case "profile":
                $this->showProfile();
                break;
            case "executecreateworkout":
                $this->createWorkout();
                break;
            case "createworkout":
                $this->showcreateWorkout();
                break;
            case "logout":
                $this->logout();
                // no break; logout will also show the welcome page.
            default: //home page/welcome page
                $this->showWelcome();
                break;
        }
    }

    public function showWelcome() {
        include($GLOBALS["src_path"]."welcome.php");
    }

    public function signIn() {
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new Database();
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // checking that the email and password are correct
            if (!empty($email) && !empty($password) && $db->authenticateUser($email, $password)) {
                // Success
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_email'] = $email;
                $res = $db->getUserInfo($email);
                echo var_dump($res);
                $_SESSION["user_id"] = $res["id"];
                $_SESSION["user_name"] = $res["name"];

                header('Location: ?command=welcome');
                exit;
            } else {
                // Failure authentication
                $message = "<div class=\"alert alert-danger d-inline-block\" role=\"alert\">
                Invalid email or password.
                </div>";
            }
        }

        if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
            header('Location: ?command=welcome');
            exit;
        }
        include($GLOBALS["src_path"]."signin.php");
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $db = new Database();
        
            // Form data
            $name = filter_input(INPUT_POST, 'name');
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password');
        
            // PASSWORD HASHING
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
            // Add User into the database
            if ($db->insertUser($name, $email, $passwordHash)) {
                echo "<p>Registration successful!</p>";

                header("Location: ?command=signin");
                exit;
            }
        }
        else {
            include($GLOBALS["src_path"]."register.php");
        }
    }

    public function showLeaderboards() {
        if (isset($_POST['submit_weight'])) {
            $exerciseId = $_POST['exercise_id'];
            $weight = $_POST['weight']; 
            $userId = $_SESSION["user_id"]; 
            $db = new Database();
            $db->insertWeight($userId, $exerciseId, $weight);
         }
        include($GLOBALS["src_path"]."leaderboards.php");
    }
    
    public function showWorkouts() {
        $db = new Database();
        //get workout names
        $workouts = $db->query("SELECT DISTINCT workout_name, user_id, workout FROM user_exercises");
        //get user names from workouts
        $usernames = [];
        foreach ($workouts as $workout) {
            $res = $db->getUserNameEmail($workout["user_id"]);
            $usernames[$res[0]["name"]] = [$workout["workout_name"], $workout["user_id"]];
        }
        $email = $_SESSION["user_email"];
        $name = $_SESSION["user_name"];
        $user_id = $_SESSION["user_id"];
        $total_workouts = $db->getUserInfo($email)["workouts"];
        $workouts = []; //2D array of workouts with a list of exercises
        for ($i = 1; $i <= $total_workouts; $i++) {
            $workouts[] = $db->getWorkout($user_id, $i);
        }
        $exercises = $db->getExercises();
        include($GLOBALS["src_path"]."workouts.php");
    }

    public function showProfile() {
        $email = $_SESSION["user_email"];
        $name = $_SESSION["user_name"];
        $user_id = $_SESSION["user_id"];
        $current_user_id = $_SESSION["user_id"];

        $db = new Database();
        if (isset($_GET["id"]) && !empty($_GET["id"])) { //another user
            $res = $db->getUserNameEmail($_GET["id"]);
            $user_id = $_GET["id"];
            $name = $res[0]["name"];
            $email = $res[0]["email"];
        }
        $total_workouts = $db->getUserInfo($email)["workouts"];
        $workouts = []; //2D array of workouts with a list of exercises
        for ($i = 1; $i <= $total_workouts; $i++) {
            $workouts[] = $db->getWorkout($user_id, $i);
        }
        $exercises = $db->getExercises();
        include($GLOBALS["src_path"]."profile.php");
    }

    public function logout() {
        session_destroy();
        session_start();
    }

    public function showcreateWorkout() {
        $message = "";
        if (isset($_GET["message"])) {
            $message = $_GET["message"];
        }
        //get all the exercises
        $db = new Database();
        $exercises = $db->getExercises();
        include($GLOBALS["src_path"]."createworkout.php");
    }

    public function createWorkout() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //validate user input
            $matches = [];
            if(preg_match('/^([A-Za-z0-9_]+)$/', $_POST["workout_name"], $matches)) { 
                $db = new Database();
                $total_workouts = $db->getUserInfo($_SESSION["user_email"])["workouts"] + 1;
                $db->insertExercise($_SESSION["user_id"], $_POST["exercise1"], $_POST["set1"], $_POST["rep1"], $_POST["rest1"], $_POST["weight1"], $total_workouts, $_POST["workout_name"]);
                $db->insertExercise($_SESSION["user_id"], $_POST["exercise2"], $_POST["set2"], $_POST["rep2"], $_POST["rest2"], $_POST["weight2"], $total_workouts, $_POST["workout_name"]);
                $db->insertExercise($_SESSION["user_id"], $_POST["exercise3"], $_POST["set3"], $_POST["rep3"], $_POST["rest3"], $_POST["weight3"], $total_workouts, $_POST["workout_name"]);
            }
            else {
                header("Location: ?command=createworkout&message=Exercise names must be Alphanumeric or Numerical");
            }
        }
        header("Location: ?command=workouts");
    }

    public function leaderboardsjson() {
        $data = [];
        if (isset($_GET["exercise_id"]) && !empty($_GET["exercise_id"])){
            $db = new Database();
            $exercise_id = $_GET["exercise_id"];
            $data = $db->query("SELECT user_id, weight, date_performed from user_exercises WHERE exercise_id = $exercise_id ORDER BY weight ASC");
            
            header('Content-type: application/json');
            echo json_encode($data);
        }
        else {
            echo "Exercise ID required";
        }
    }
    
}