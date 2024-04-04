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
            case "workouts":
                $this->showWorkouts();
                break;
            case "profile":
                $this->showProfile();
                break;
            case "logout":
                $this->logout();
                // no break; logout will also show the welcome page.
            default: //home page / welcome page
                $this->showWelcome();
                break;
        }
    }

    public function showWelcome() {
        include($GLOBALS["src_path"]."welcome.php");
    }

    public function signIn() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new Database();
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // checking that the email and password are correct
            if (!empty($email) && !empty($password) && $db->authenticateUser($email, $password)) {
            // Success
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_email'] = $email;

            header('Location: ?command=welcome');
            exit;
            } else {
                // Failure authentication
                echo "<p>Invalid email or password.</p>";
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
        include($GLOBALS["src_path"]."leaderboards.php");
    }
    
    public function showWorkouts() {
        include($GLOBALS["src_path"]."workouts.php");
    }

    public function showProfile() {
        include($GLOBALS["src_path"]."profile.php");
    }

    public function logout() {
        session_destroy();
        session_start();
    }

}