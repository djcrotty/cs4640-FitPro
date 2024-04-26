<?php

function displayRandomWorkout() {
    $jsonFilePath = 'json/workouts.json'; // Adjust the path as necessary
    
    // Check if the JSON file exists
    if (!file_exists($jsonFilePath)) {
        echo "Workout data not found.";
        return;
    }
  
    $jsonData = file_get_contents($jsonFilePath);
    $workouts = json_decode($jsonData, true);
  
    // SELECTS RANDOM
    $randomWorkout = $workouts[array_rand($workouts)];
  
    //displays in html
    echo "<div class='left-side'>";
    echo "<h5>Workout of the Day:</h5>";
    echo "<h6 id=random-workout-name>" . htmlspecialchars($randomWorkout['name']) . "</h6>";
    echo "<p id=random-workout-description>" . htmlspecialchars($randomWorkout['description']) . "</p>";
    echo "<button class=\"btn btn-light\" id=random-workout-button>New Workout</button>";
    echo "</div>";
  }
  ?>
  
  <!-- https://cs4640.cs.virginia.edu/vpv4ds/cs4640-FitPro/ -->
  <!DOCTYPE html>
  <html lang="en" data-bs-theme="light">
     <head>
        <meta name="contributions" content="Howard - index and leaderboard, Dylan - profile and workouts">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Dylan Crotty, Howard Bell">
        <meta name="description" content="Index base page for FitPro, a way for gymgoers to track and compete">
        <meta name="keywords" content="Dylan Crotty Howard Bell Index FitPro Gym Compete">
        <meta property="og:title" content="page">
        <meta property="og:type" content="website">
        <meta property="og:image" content="">
        <meta property="og:url" content="https://cs4640.cs.virginia.edu/vpv4ds/cs4640-FitPro/index.html">
        <meta property="og:description" content="Index base page for FitPro, a way for gymgoers to track and compete">
        <meta property="og:site_name" content="FitPro - Index">
        <title>FitPro - Index</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="styles/index.css">
     </head>
     <body>
      <div class="parent">
        <header class="section coral">
           <div class="pos-f-t">
              <div class="collapse" id="navbarToggleExternalContent">
                <div class="p-4">
                    <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                        <!-- Displays when user has logged in -->
                        <a href="?command=welcome" class="nav-item">Home</a>
                        <a href="?command=leaderboards" class="nav-item">Leaderboard</a>
                        <a href="?command=profile" class="nav-item">Profile</a>
                        <a href="?command=workouts" class="nav-item">Workouts</a>
                        <a href="?command=logout" class="nav-item">Logout</a>
                    <?php else: ?>
                        <!-- Displays when user isnt logged in -->
                        <a href="?command=signin" class="nav-item">Sign-in</a>
                    <?php endif; ?>
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
        <?php
        // Workout Function
        displayRandomWorkout();
        ?>
        <main class="section">
           <h3>Are You Ready to Elevate Your Workouts?</h3>
           <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="static/car1.webp" class="d-block w-100" alt="Person Lifting Weights">
                  <div class="carousel-caption d-none d-md-block">
                    <p>Get Cutting Edge Workout Plans</p>
                  </div>
                </div>
                <div class="carousel-item">
                  <img src="static/car2.avif" class="d-block w-100" alt="Interesting Data Visualization">
                  <div class="carousel-caption d-none d-md-block">
                    <p>Access Exciting Data About Your Fitness</p>
                  </div>
                </div>
                <div class="carousel-item">
                  <img src="static/car3.jpeg" class="d-block w-100" alt="People posing for a picture in the gym">
                  <div class="carousel-caption d-none d-md-block">
                    <p>Find a Community of Fitness Focused Friends</p>
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <?php if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] === false): ?>
              <a href="?command=signin">
                <button id="sign-in">Sign-in</button>
              </a>
            <?php endif; ?>
        </main>
        <div class="right-side">
           <h6>Real Testimonials:</h6>
           <p>"This clears MyFitnessPal"</p>
           <p>- Howard Bell</p>
           <p>"I was out of shape until finding FitPro"</p>
           <p>- Mickey Donalds</p>
           <p>"Cool I guess"</p>
           <p>- Sepiroth</p>
           <p>"I was paid for this testimonial"</p>
           <p>- Real Customer</p>
        </div>
        <footer class="section coral">
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
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script><?php require_once($GLOBALS["src_path"]."javascript/welcome.js");?></script>
    </body>
  </html>