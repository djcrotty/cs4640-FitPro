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
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/profile.css">
        <title>FitPro - Profile</title>
    </head>  
    <body> 
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="flex.png" alt="FitPro Logo" style="height: 40px; width: auto;">
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
                            Example User
                        </h2>
                        <p>
                            description of user  
                        </p>
                        <h4> <!--Should change based on calendar-->
                            Todays workout is Chest
                        </h4>
                    </div>
                    <div id="calendar">
                        <img src="./static/calendar_placeholder.PNG" alt="Calendar Placeholder">
                    </div>
                </div>
                <div class="p-3 m-3 bg-secondary" id="workouts-container">
                    <div class="d-flex flex-row align-items-center justify-content-between" id="workouts-selector-progress">
                        <div>
                            <div>
                                <h4>
                                    Progress
                                </h4>
                                <div id="progress-bar">
                                    <p>
                                        75% Complete
                                    </p>
                                </div>
                            </div>
                            <div class="btn-group" role="group" id="workout-selector">
                                <button type="button" class="btn btn-light">Chest</button>
                                <button type="button" class="btn btn-light">Legs</button>
                                <button type="button" class="btn btn-light">Push</button>
                                <button type="button" class="btn btn-light">Pull</button>
                              </div>
                        </div>
                        <button formaction="workouts.html" class="border btn btn-light h-25">
                            Create New Workout +
                        </button>
                    </div>
                    <div id="table">
                        <table class="table table-striped table-dark">
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
                                <td>Bench Press</td>
                                <td><input type="checkbox" value="Bench Press" aria-label="benchpress"></td>
                                <td>3</td>
                                <td>8</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Bicep Curls</td>
                                <td><input type="checkbox" value="Bench Press" aria-label="benchpress"></td>
                                <td>3</td>
                                <td>20</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Push Ups</td>
                                <td><input type="checkbox" value="Bench Press" aria-label="benchpress"></td>
                                <td>3</td>
                                <td>20</td>
                                <td>30</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Shoulder Press</td>
                                <td><input type="checkbox" value="Bench Press" aria-label="benchpress"></td>
                                <td>2</td>
                                <td>12</td>
                                <td>45</td>
                            </tr>
                        </table>
                    </div>
                </div>
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>