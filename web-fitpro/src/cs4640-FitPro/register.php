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
      <meta property="og:url" content="https://cs4640.cs.virginia.edu/vpv4ds/cs4640-FitPro/register.php">
      <meta property="og:description" content="Registration Page for FitPro">
      <meta property="og:site_name" content="Register - FitPro">
      <title>Register - FitPro</title>
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
           <img src="flex.png" alt="FitPro Logo" style="height: 40px; width: auto;">
           <p class="top-title">FitPro</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
      </div>
    </header>
    <h1 class="top-title">Sign-in to FitPro</h1>
    <form action="?command=register" method="post">
      <label for="name">Name:</label>
      <input type="name" id="name" name="name" required>
      <br><br>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" pattern="^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{9,14}$" title="9-14 Characters w/ a capital letter & number." required>
      <br><br>
      <button type="submit" id="sign-in">Register</button>
    <a href="?command=signin" style="text-decoration: underline; display: block;">Already Registered? Sign-in</a>
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
