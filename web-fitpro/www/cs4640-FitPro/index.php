<?php
// DEBUGGING ONLY! Show all errors.
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Class autoloading by name.  All our classes will be in a directory
// that Apache does not serve publicly.  They will be in /opt/src/, which
// is our src/ directory in Docker.
spl_autoload_register(function ($classname) {
        include "/opt/src/cs4640-FitPro/$classname.php";
        //include "/students/vpv4ds/students/vpv4ds/opt/src/connections/$classname.php"; //change to this line when deploying
});


// Instantiate the front controller
$fitpro = new FitProController($_GET);

// Run the controller
$fitpro->run();