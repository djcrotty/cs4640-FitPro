<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Dylan Crotty, Howard Bell">
      <meta name="description" content="Leaderboards base page for FitPro, a way for gymgoers to track and compete">
      <meta name="keywords" content="Dylan Crotty Howard Bell Leaderboards FitPro Gym Compete">
      <meta property="og:title" content="page">
      <meta property="og:type" content="website">
      <meta property="og:image" content="">
      <meta property="og:url" content="https://cs4640.cs.virginia.edu/vpv4ds/cs4640-FitPro/index.html">
      <meta property="og:description" content="Leaderboards page for FitPro, a way for gymgoers to track and compete">
      <meta property="og:site_name" content="FitPro - Leaderboards">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="styles/leaderboards.css">
      <title>FitPro - Leaderboards</title>
   </head>
   <body>
      <header class="section coral">
         <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
              <div class="p-4">
               <nav>
               <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                <!-- User is logged in -->
                <a href="index.php" class="nav-item">Home</a>
                <a href="leaderboards.php" class="nav-item">Leaderboard</a>
                <a href="profile.html" class="nav-item">Profile</a>
                <a href="workouts.html" class="nav-item">Workouts</a>
                <a href="logout.php" class="nav-item">Logout</a>
            <?php else: ?>
                <!-- User is not logged in -->
                <a href="signin.php" class="nav-item">Sign-in</a>
            <?php endif; ?>
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
   

      <div>
         <h1>Leaderboard</h1>
         <p>Who's your strongest friend? Compare your progress and see where you stand.</p>
      </div>
      <label for="workout-dropdown">Workouts:</label>
      <select id="workout-dropdown" name="workouts">
         <option value="squats">Squats</option>
         <option value="benchpress">Bench Press</option>
         <option value="deadlift">Deadlift</option>
      </select>
      <label for="filter-dropdown">Compare:</label>
      <select id="filter-dropdown" name="filter">
         <option value="everyone">Everyone</option>
         <option value="friends">Friends Only</option>
         <option value="you">Only You</option>
      </select>
      <table>
         <thead>
            <tr>
               <th>Username</th>
               <th>Weight</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>User1</td>
               <td>280lbs</td>
            </tr>
            <tr>
               <td>User2</td>
               <td>200lbs</td>
            </tr>
            <tr>
               <td>User3</td>
               <td>180lbs</td>
            </tr>
            <tr>
               <td>User4</td>
               <td>160lbs</td>
            </tr>
            <tr>
               <td>User5</td>
               <td>105lbs</td>
            </tr>
         </tbody>
      </table>
      <form>
         <label for="new-workout-dropdown">Select Workout:</label>
         <select id="new-workout-dropdown" name="newWorkouts">
            <option value="squats">Squats</option>
            <option value="benchpress">Bench Press</option>
            <option value="deadlift">Deadlift</option>
         </select>
         <label for="weight-input">Enter Weight:</label>
         <input type="number" id="weight-input" name="weight" placeholder="Weight (lbs)" min="0">
         <button type="submit" id="submit">Submit</button>
      </form>
      <footer>
         <nav>
         <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                <!-- User is logged in -->
                <a href="index.php" class="nav-item">Home</a>
                <a href="leaderboards.php" class="nav-item">Leaderboard</a>
                <a href="profile.html" class="nav-item">Profile</a>
                <a href="workouts.html" class="nav-item">Workouts</a>
                <a href="logout.php" class="nav-item">Logout</a>
            <?php else: ?>
                <!-- User is not logged in -->
                <a href="signin.php" class="nav-item">Sign-in</a>
            <?php endif; ?>
        </nav>
        <p>&copy; 2024 FitPro. All rights reserved.</p>
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
</html>