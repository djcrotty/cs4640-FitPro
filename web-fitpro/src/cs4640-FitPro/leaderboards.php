<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["json"])) {
    require_once "Database.php"; // Adjust the path as necessary.
    header("Content-Type: application/json");
    $db = new Database();
    $workoutName = $_GET["workout"] ?? "Squat"; // Default to 'Squat' if not specified
    $leaderboards = $db->getTopPerformersForWorkouts();
    echo json_encode($leaderboards[$workoutName] ?? []);
    exit();
}

// USER SUBMISSION DO NOT MOVE THIS YOU WILL PROLLY BREAK THE FUNCTIONALITY
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit_weight"])) {
    $username = $_SESSION["user_name"];
    $weight = $_POST["weight"];
    $exerciseId = $_POST["exercise_id"];

    if (is_numeric($weight) && !empty($username) && is_numeric($exerciseId)) {
        $weight = intval($weight);
        $exerciseId = intval($exerciseId);

        $query =
            "INSERT INTO leaderboards (exercise_id, username, weight) VALUES ($1, $2, $3)";
        $result = pg_prepare($db->getConnection(), "insert_weight", $query);
        $result = pg_execute($db->getConnection(), "insert_weight", [
            $exerciseId,
            $username,
            $weight,
        ]);

        if ($result) {
            $feedback = "Weight submitted successfully!";
        } else {
            $feedback = "Failed to submit weight.";
        }
    } else {
        $feedback = "Invalid input data.";
    }
}

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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   </head>
   <body>
      <header class="section coral">
         <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
               <div class="p-4">
                  <nav>
                     <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                     <!-- User is logged in -->
                     <a href="?command=welcome" class="nav-item">Home</a>
                     <a href="?command=leaderboards" class="nav-item">Leaderboard</a>
                     <a href="?command=profile" class="nav-item">Profile</a>
                     <a href="?command=workouts" class="nav-item">Workouts</a>
                     <a href="?command=logout" class="nav-item">Logout</a>
                     <?php else: ?>
                     <!-- User is not logged in -->
                     <a href="?command=signin" class="nav-item">Sign-in</a>
                     <?php endif; ?>
                  </nav>
               </div>
            </div>
            <nav class="navbar">
               <img src="static/flex.png" alt="FitPro Logo" style="height: 40px; width: auto;">
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
      <pre id="dataDisplay"></pre>
      <label for="workout-dropdown">Workouts:</label>
      <select id="workout-dropdown" name="workouts">
         <option value="">Select an Exercise</option>
         <option value="Squats">Squats</option>
         <option value="Bench Press">Bench Press</option>
         <option value="Deadlift">Deadlift</option>
      </select>
      <table id="leaderboard-table">
         <thead>
            <tr>
               <th>Username</th>
               <th>Weight (lbs)</th>
            </tr>
         </thead>
         <tbody>
            <!-- Leaderboard rows will be inserted here dynamically -->
         </tbody>
      </table>
      <form action="?command=leaderboards" method="post">
         <select name="exercise_id">
            <option value="1">Squats</option>
            <option value="2">Bench Press</option>
            <option value="3">Deadlift</option>
         </select>
         <input type="number" name="weight" placeholder="Weight (lbs)" required>
         <input type="submit" name="submit_weight" value="Submit Weight">
      </form>
      <footer>
         <nav>
            <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
            <!-- User is logged in -->
            <a href="?command=welcome" class="nav-item">Home</a>
            <a href="?command=leaderboards" class="nav-item">Leaderboard</a>
            <a href="?command=profile" class="nav-item">Profile</a>
            <a href="?command=workouts" class="nav-item">Workouts</a>
            <a href="?command=logout" class="nav-item">Logout</a>
            <?php else: ?>
            <!-- User is not logged in -->
            <a href="?command=signin" class="nav-item">Sign-in</a>
            <?php endif; ?>
         </nav>
         <p>&copy; 2024 FitPro. All rights reserved.</p>
      </footer>
      <script>
         $(document).ready(function() {
             updateLeaderboard();  // Updates page when the page first loads
             $('#workout-dropdown').change(updateLeaderboard); 
         
             // DROPDOWN CHANGER
             function updateLeaderboard() {
                 var workoutName = $('#workout-dropdown').val();  // Get the current value of the dropdown
                 var exerciseIdMapping = {
                     "Squats": 1,
                     "Bench Press": 2,
                     "Deadlift": 3
                 };
                 var exerciseId = exerciseIdMapping[workoutName];  // Map the workout name to an exercise ID
         
                 console.log("Sending exercise_id:", exerciseId);  // Log the ID being sent
         
                 $.ajax({
                     url: 'index.php',
                     type: 'GET',
                     data: {
                         command: 'leaderboards-json',
                         exercise_id: exerciseId, 
                         json: true
                     },
                     dataType: 'json',
                     success: function(data) {
                         console.log("Data received:", data);  
                         var tbody = $('#leaderboard-table tbody');
                         tbody.empty(); 
         
                         if (data && data.length) {
                             // Sort data by weight in descending order 
                             data.sort((a, b) => b.weight - a.weight).slice(0, 5).forEach(function(item) {
                                 tbody.append(`<tr><td>${item.username}</td><td>${item.weight}</td></tr>`);
                             });
                         } else {
                             // TESTING
                             tbody.append('<tr><td colspan="2">No data available.</td></tr>');
                         }
                     },
                     error: function(jqXHR, textStatus, errorThrown) {
                         console.error("AJAX error: ", textStatus, errorThrown);  // Log any AJAX errors
                         $('#leaderboard-table tbody').html('<tr><td colspan="2">Failed to load data. Error: ' + textStatus + ' ' + errorThrown + '</td></tr>');
                     }
                 });
             }
         });
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
</html>