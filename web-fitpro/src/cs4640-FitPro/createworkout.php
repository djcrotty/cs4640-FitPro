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
      <meta property="og:url" content="https://cs4640.cs.virginia.edu/vpv4ds/cs4640-FitPro/login.html">
      <meta property="og:description" content="CreateWorkout Page - FitPro">
      <meta property="og:site_name" content="FitPro - CreateWorkout">
      <title>FitPro - Create Workout</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="styles/signin.css">
   </head>
   <body>
    <header>
      <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
          <div class="p-4">
           <nav>
              <a href="?command=welcome" class="nav-item">Home</a>
              <a href="?command=leaderboards" class="nav-item">Leaderboard</a>
              <a href="?command=profile" class="nav-item">Profile</a>
              <a href="?command=workouts" class="nav-item">Workouts</a>
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
    <h1 class="top-title">Create A New Workout</h1>
    <form action="?command=executecreateworkout" method="post">
        <label for="workout_name">Workout Name:</label>
        <input type="text" id="workout_name" name="workout_name" required>
        <br><br>
        <label for="exercise1">Exercise 1:</label>
        <select id="exercise1" name="exercise1">
            <?php
            foreach ($exercises as $id=>$exercise) {
                echo "<option value=".$id.">".$exercise."</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="set1">Sets:</label>
        <input type="number" id="set1" name="set1" required>
        <br><br>
        <label for="rep1">Reps:</label>
        <input type="number" id="rep1" name="rep1" required>
        <br><br>
        <label for="rest1">Rest in Seconds:</label>
        <input type="number" id="rest1" name="rest1" required>
        <br><br>
        <label for="weight1">Weight in kg:</label>
        <input type="number" id="weight1" name="weight1" required>
        <br><br>

        <label for="exercise2">Exercise 2:</label>
        <select id="exercise2" name="exercise2">
            <?php
            foreach ($exercises as $id=>$exercise) {
                echo "<option value=".$id.">".$exercise."</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="set2">Sets:</label>
        <input type="number" id="set2" name="set2" required>
        <br><br>
        <label for="rep2">Reps:</label>
        <input type="number" id="rep2" name="rep2" required>
        <br><br><label for="rest2">Rest in Seconds:</label>
        <input type="number" id="rest2" name="rest2" required>
        <br><br>
        <label for="weight2">Weight in kg:</label>
        <input type="number" id="weight2" name="weight2" required>
        <br><br>

        <label for="exercise3">Exercise 3:</label>
        <select id="exercise3" name="exercise3">
            <?php
            foreach ($exercises as $id=>$exercise) {
                echo "<option value=".$id.">".$exercise."</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="set3">Sets:</label>
        <input type="number" id="set3" name="set3" required>
        <br><br>
        <label for="rep3">Reps:</label>
        <input type="number" id="rep3" name="rep3" required>
        <br><br><label for="rest3">Rest in Seconds:</label>
        <input type="number" id="rest3" name="rest3" required>
        <br><br>
        <label for="weight3">Weight in kg:</label>
        <input type="number" id="weight3" name="weight3" required>
        <br><br>

      <button type="submit" id="submit">Create Workout</button>
    </form>
    <footer>
      <nav>
      <a href="?command=welcome" class="nav-item">Home</a>
      <a href="?command=leaderboards" class="nav-item">Leaderboard</a>
      <a href="?command=profile" class="nav-item">Profile</a>
      <a href="?command=workouts" class="nav-item">Workouts</a>
     </nav>
     <p>&copy; 2024 FitPro. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
