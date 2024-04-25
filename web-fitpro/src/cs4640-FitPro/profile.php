<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <meta name="author" content="Dylan Crotty, Howard Bell">
        <meta name="description" content="Profile base page for FitPro, a way for gymgoers to track and compete">
        <meta name="keywords" content="Dylan Crotty Howard Bell Profile FitPro Gym Compete">
        
        <meta property="og:title" content="page">
        <meta property="og:type" content="website">
        <meta property="og:image" content="">
        <meta property="og:url" content="https://cs4640.cs.virginia.edu/vpv4ds/cs4640-FitPro/index.html">
        <meta property="og:description" content="Profile base page for FitPro, a way for gymgoers to track and compete">
        <meta property="og:site_name" content="FitPro - Profile">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/calendar.css">
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/profile.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <title>FitPro - Profile</title>
    </head>  
    <body> 
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="static/flex.png" alt="FitPro Logo" style="height: 40px; width: auto;">
                </a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                    &#9776;
                </button>
                <div class="collapse navbar-collapse" id="exCollapsingNavbar">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a href="?command=welcome" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="?command=leaderboards" class="nav-link">Leaderboard</a></li>
                        <li class="nav-item"><a href="?command=profile" class="nav-link">Profile</a></li>
                        <li class="nav-item"><a href="?command=workouts" class="nav-link">Workouts</a></li>
                    </ul>
                    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                        <li class="nav-item order-2 order-md-1"><a href="#" class="nav-link" title="settings"><i class="fa fa-cog fa-fw fa-lg"></i></a></li>
                        <li class="dropdown order-1">
                            <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">Login <span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right mt-1">
                              <li class="p-3">
                                    <form class="form" role="form">
                                        <div class="form-group">
                                            <input id="emailInput" placeholder="Email" class="form-control form-control-sm" type="text" required="">
                                        </div>
                                        <div class="form-group">
                                            <input id="passwordInput" placeholder="Password" class="form-control form-control-sm" type="text" required="">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                        <div class="form-group text-xs-center">
                                            <small><a href="#">Forgot password?</a></small>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="outer-container">
            <div class="container" id="main-container">
                <div id="user-container">
                    <div id="user-description">
                        <h2>
                            <?=$name?>
                        </h2>
                        <p id="user_description">
                            <?=$description?>
                        </p>
                        <form id="description_form">
                                <label for="text_description">Enter A Description About Yourself:</label>
                                <input type="text" id="text_description" name="text_description" required>
                                <button class="button" id="description_button">Edit</button>
                        </form>
                        <h4> <!--Should change based on calendar-->
                            Todays workout is <?=$today_workout_name?>
                        </h4>
                    </div>
                </div>
                <div class="calendar-html">
                    <div class="calendar-container">
                        <header class="calendar-header">
                            <p class="calendar-current-date"></p>
                            <div class="calendar-navigation">
                                <span id="calendar-prev" class="material-symbols-rounded">
                                    chevron_left
                                </span>
                                <span id="calendar-next"
                                    class="material-symbols-rounded">
                                    chevron_right
                                </span>
                            </div>
                        </header>
                        <div class="calendar-body">
                            <ul class="calendar-weekdays">
                                <li>Sun</li>
                                <li>Mon</li>
                                <li>Tue</li>
                                <li>Wed</li>
                                <li>Thu</li>
                                <li>Fri</li>
                                <li>Sat</li>
                            </ul>
                            <ul class="calendar-dates"></ul>
                        </div>
                    </div>
                </div>
                <?php if (empty($workouts)) { ?>
                    <a href="?command=createworkout">
                    <button class="border btn btn-light">
                        Create New Workout +
                    </button>
                    </a>
                <?php }
                    foreach ($workouts as $key => $workout) { 
                ?>
                <div class="p-3 m-3 bg-secondary" id="workouts-container-<?=$key?>">
                    <div class="d-flex flex-row align-items-center justify-content-between" id="workouts-selector-progress">
                        <div>
                            <div>
                                <h4>
                                    Progress in <?=$workout[0]["workout_name"]?>
                                </h4>
                                <div>
                                    <p id="progress-bar-<?=$key?>">
                                        75% Complete
                                    </p>
                                </div>
                            </div>
                        </div>
                        <a href="?command=createworkout">
                        <button class="border btn btn-light h-25">
                            Create New Workout +
                        </button>
                        </a>
                    </div>
                    <div>
                        <table class="table table-striped table-dark" id="table-<?=$key?>">
                            <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Exercise</th>
                                <th scope="col">Completion</th>
                                <th scope="col">Sets</th>
                                <th scope="col">Reps</th>
                                <th scope="col">Rest(seconds)</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><?= $exercises[$workout[0]["exercise_id"]]?></td>
                                <td><input type="checkbox" value="Bench Press" aria-label="benchpress" id="workout-<?=$key?>-checkbox-1"></td>
                                <td><?=$workout[0]["sets"] ?></td>
                                <td><?=$workout[0]["reps"] ?></td>
                                <td><?=$workout[0]["rest"] ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><?= $exercises[$workout[1]["exercise_id"]]?></td>
                                <td><input type="checkbox" value="Bench Press" aria-label="benchpress" id="workout-<?=$key?>-checkbox-2"></td>
                                <td><?=$workout[1]["sets"] ?></td>
                                <td><?=$workout[1]["reps"] ?></td>
                                <td><?=$workout[1]["rest"] ?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><?= $exercises[$workout[2]["exercise_id"]]?></td>
                                <td><input type="checkbox" value="Bench Press" aria-label="benchpress" id="workout-<?=$key?>-checkbox-3"></td>
                                <td><?=$workout[2]["sets"] ?></td>
                                <td><?=$workout[2]["reps"] ?></td>
                                <td><?=$workout[2]["rest"] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="sidenav bg-secondary"id="friends-sidebar">
                <h2 class="m-3">Friends</h2>
                <ul>
                    <li id="friend-1">
                        <a href="?command=profile">Example Friend 1</a>
                        <button formaction="?command=profile" class="border btn btn-light">Profile</button>
                    </li>
                    <li id="friend-2">
                        <a href="?command=profile">Example Friend 2</a>
                        <button formaction="?command=profile" class="border btn btn-light">Profile</button>
                    </li>
                    <li id="friend-3">
                        <a href="?command=profile">Example Friend 3</a>
                        <button formaction="?command=profile" class="border btn btn-light">Profile</button>
                    </li>
                    <li id="friend-4">
                        <a href="?command=profile">Example Friend 4</a>
                        <button formaction="?command=profile" class="border btn btn-light">Profile</button>
                    </li>
                </ul>
            </div>
        </div>
        <footer>
            <nav>
                <ul style="list-style: none; padding: 0; text-align: center;">
                    <li style="display: inline; margin-right: 20px;"><a href="?command=welcome" style="text-decoration: none; color: white;">Home</a></li>
                    <li style="display: inline; margin-right: 20px;"><a href="?command=leaderboard" style="text-decoration: none; color: white;">Leaderboard</a></li>
                    <li style="display: inline; margin-right: 20px;"><a href="?command=profile" style="text-decoration: none; color: white;">Profile</a></li>
                    <li style="display: inline;"><a href="?command=workouts" style="text-decoration: none; color: white;">Workouts</a></li>
                </ul>
            </nav>
            <p>&copy; 2024 FitPro. All rights reserved.</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script>
            <?php require_once($GLOBALS["src_path"]."javascript/calendar.js");?>
        </script>
        <script>
            <?php require_once($GLOBALS["src_path"]."javascript/profile.js");?>
        </script>
    </body>
</html>