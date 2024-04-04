<?php

$src_path = "/opt/src/cs4640-FitPro/";
//$src_path = "/students/vpv4ds/students/vpv4ds/opt/src/cs4640-FitPro/"; //change to this when deploying

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
        if (!isset($_SESSION["name"]) && $command != "login")
            $command = "welcome";

        switch($command) {
            case "signin":
                $this->signIn();
                break;
            case "showregister":
                $this->showRegister();
                break;
            case "register":
                $this->register();
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
        include($GLOBALS["src_path"]."signin.php");
    }

    public function showRegister() {
        include($GLOBALS["src_path"]."register.php");
    }

    public function register() {

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