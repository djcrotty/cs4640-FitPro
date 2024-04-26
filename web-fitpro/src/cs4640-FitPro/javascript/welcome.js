//changes the workout of the day
let filePath = "json/workouts.json";
$("#random-workout-button").on("click", function(){
    $.get(filePath, function(data){
        let workouts = data;
        let randomWorkout = workouts[Math.floor(Math.random() * 3)]
        $("#random-workout-name").text(randomWorkout.name);
        $("#random-workout-description").text(randomWorkout.description);
    });
});