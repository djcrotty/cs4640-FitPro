<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <meta name="author" content="Dylan Crotty, Howard Bell">
        <meta name="description" content="Workouts base page for FitPro, a way for gymgoers to track and compete">
        <meta name="keywords" content="Dylan Crotty Howard Bell Workouts FitPro Gym Compete">
        
        <meta property="og:title" content="page">
        <meta property="og:type" content="website">
        <meta property="og:image" content="">
        <meta property="og:url" content="https://cs4640.cs.virginia.edu/vpv4ds/cs4640-FitPro/index.html">
        <meta property="og:description" content="Workouts base page for FitPro, a way for gymgoers to track and compete">
        <meta property="og:site_name" content="FitPro - Workouts">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/workouts.css">
        <title>FitPro - Workouts</title>
    </head>  
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="?command=welcome">
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
                        <li class="nav-item"><a href="?command=logout" class="nav-link">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="outer-container">
            <div class="p-3 m-3 bg-secondary" id="new-workouts-container">
                <h1>Workouts</h1>
                <h2>Find workouts others have created</h2>
                <div>
                    <div class="d-flex justify-content-between" id="table-header">
                        <div>
                            <p>Sort by</p>
                            <div class="btn-group">
                                <button class="border btn btn-secondary">Popularity</button>
                                <button class="border btn btn-secondary">Friends</button>
                                <button class="border btn btn-secondary">Recent</button>
                            </div>
                        </div>
                        <button class="border btn btn-light h-25">Share your workout + </button>
                    </div>
                    <table class="table table-striped table-dark" id="new-workouts-container">
                        <tr>
                            <th scope="col">Stars</th>
                            <th scope="col">User</th>
                            <th scope="col">Workout</th>
                        </tr>
                        <?php foreach ($usernames as $name=>$workout) { ?>
                        <tr id="new-workout-1">
                            <td>100</td>
                            <td><?= $workout[2] ?></td>
                            <td><a href="?command=profile&id=<?= $workout[1]?>"> <?= $workout[0] ?></a></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="p-3 m-3 bg-secondary" id="workout-schedule-container">
                <h2 class="p-3">Workout Schedule</h2>
                <ul class="p-3 d-flex flex-column justify-content-evenly list-group list-group-flush" id="schedule-list">
                    <li><p>Monday - <?=$schedule["monday_id"]?></p>
                        <select name="Monday" id="monday">
                            <?php foreach($workout_names as $workout_name) { echo "<option value=\"".$workout_name."\">".$workout_name."</option>"; }?>
                        </select>
                    </li>
                    <li><p>Tuesday - <?=$schedule["tuesday_id"]?></p> 
                        <select name="Tuesday" id="tuesday">
                            <?php foreach($workout_names as $workout_name) { echo "<option value=\"".$workout_name."\">".$workout_name."</option>"; }?>
                        </select>
                    </li>
                    <li><p>Wednesday - <?=$schedule["wednesday_id"]?></p>
                        <select name="Wednesday" id="wednesday">
                            <?php foreach($workout_names as $workout_name) { echo "<option value=\"".$workout_name."\">".$workout_name."</option>"; }?>
                        </select>
                    </li>
                    <li><p>Thursday - <?=$schedule["thursday_id"]?></p>
                        <select name="Thursday" id="thursday">
                            <?php foreach($workout_names as $workout_name) { echo "<option value=\"".$workout_name."\">".$workout_name."</option>"; }?>
                        </select>
                    </li>
                    <li><p>Friday - <?=$schedule["friday_id"]?></p>
                        <select name="Friday" id="friday">
                            <?php foreach($workout_names as $workout_name) { echo "<option value=\"".$workout_name."\">".$workout_name."</option>"; }?>
                        </select>
                    </li>
                    <li><p>Saturday - <?=$schedule["saturday_id"]?></p>
                        <select name="Saturday" id="saturday">
                            <?php foreach($workout_names as $workout_name) { echo "<option value=\"".$workout_name."\">".$workout_name."</option>"; }?>
                        </select>
                    </li>
                    <li><p>Sunday - <?=$schedule["sunday_id"]?></p>
                        <select name="Sunday" id="sunday">
                            <?php foreach($workout_names as $workout_name) { echo "<option value=\"".$workout_name."\">".$workout_name."</option>"; }?>
                        </select>
                    </li>
                </ul>
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
                    <table class="table table-striped table-dark" id="<?=$key?>">
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
                            <td><input type="checkbox" value="Bench Press" aria-label="benchpress" id="workout-<?=$key?>-checkbox-0" exercise="<?=$workout[0]["exercise_id"]?>" workout="<?=$workout[0]["workout"]?>" <?php if($workout[0]["completed"] == 't') echo "checked=true";?>></td>
                            <td><?=$workout[0]["sets"] ?></td>
                            <td><?=$workout[0]["reps"] ?></td>
                            <td><?=$workout[0]["rest"] ?></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><?= $exercises[$workout[1]["exercise_id"]]?></td>
                            <td><input type="checkbox" value="Bench Press" aria-label="benchpress" id="workout-<?=$key?>-checkbox-1" exercise="<?=$workout[1]["exercise_id"]?>" workout="<?=$workout[1]["workout"]?>" <?php if($workout[1]["completed"] == 't') echo "checked=true";;?>></td>
                            <td><?=$workout[1]["sets"] ?></td>
                            <td><?=$workout[1]["reps"] ?></td>
                            <td><?=$workout[1]["rest"] ?></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><?= $exercises[$workout[2]["exercise_id"]]?></td>
                            <td><input type="checkbox" value="Bench Press" aria-label="benchpress" id="workout-<?=$key?>-checkbox-2" exercise="<?=$workout[2]["exercise_id"]?>" workout="<?=$workout[2]["workout"]?>" <?php if($workout[2]["completed"] == 't') echo "checked=true";?>></td>
                            <td><?=$workout[2]["sets"] ?></td>
                            <td><?=$workout[2]["reps"] ?></td>
                            <td><?=$workout[2]["rest"] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php } ?>
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
        <script><?php require_once($GLOBALS["src_path"]."/javascript/workouts.js");?></script>
        <script><?php require_once($GLOBALS["src_path"]."javascript/workout_table.js");?></script>
    </body>
</html>