<?php
session_start();
require_once 'Config.php';
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'logout') {
        // Log out
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
        exit;
    } elseif ($action === 'delete' && isset($_SESSION['user_email'])) {
        // Delete account
        $db = new Database();
        $email = $_SESSION['user_email'];
        if($db->deleteUser($email)) {
            echo "Account successfully deleted.";
        } else {
            echo "Failed to delete account.";
        }
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
   <head>
      <meta name="contributions" content="Howard - index and leaderboard, Dylan - profile and workouts">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Dylan Crotty, Howard Bell">
      <meta name="description" content="Logout page for FitPro">
      <meta name="keywords" content="Dylan Crotty Howard Bell Logout FitPro Gym Compete">
      <meta property="og:title" content="page">
      <meta property="og:type" content="website">
      <meta property="og:image" content="">
      <meta property="og:url" content="https://cs4640.cs.virginia.edu/vpv4ds/cs4640-FitPro/login.html">
      <meta property="og:description" content="Logout Page - FitPro">
      <meta property="og:site_name" content="FitPro - Logout">
      <title>FitPro - Logout</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="styles/signin.css">
   </head>
   <body>
    <header>
      <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
          <div class="p-4">
           <nav>
              <a href="index.html" class="nav-item">Home</a>
              <a href="leaderboards.html" class="nav-item">Leaderboard</a>
              <a href="profile.html" class="nav-item">Profile</a>
              <a href="workouts.html" class="nav-item">Workouts</a>
          </nav>
          </div>
        </div>
        <nav class="navbar">
           <img src="flex.png" alt="FitPro Logo" style="height: 40px; width: auto;">
           <p class="top-title">FitPro</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
      </div>
    </header>
    <h1 class="top-title">Would you like to Logout or Delete your Account?</h1>
    <form action="logout.php" method="post">
      <input type="hidden" name="action" value="logout">
      <button type="submit" class="sign-in">Sign Out</button>
    </form>
    <form action="logout.php" method="post">
    <input type="hidden" name="action" value="delete">
      <button type="submit" class="sign-in">Delete Account</button>
    </form>
    <a href="register.php" style="text-decoration: underline; display: block;">Still Need to Register? Go Here</a>
    <footer>
      <nav>
         <a href="index.html" class="nav-item">Home</a>
         <a href="leaderboards.html" class="nav-item">Leaderboard</a>
         <a href="profile.html" class="nav-item">Profile</a>
         <a href="workouts.html" class="nav-item">Workouts</a>
     </nav>
     <p>&copy; 2024 FitPro. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

