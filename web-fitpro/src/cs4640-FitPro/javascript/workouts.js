console.log("workouts");

let $schedule_selectors = $("#schedule-list li select");
$schedule_selectors.on("change", (event) => { //event listener and arrow function
    console.log("changed workout");
    let $selector = $(event.target);
    let workout_name = $selector.val();
    let $schedule_display = $selector.parent().find("p");
    $schedule_display.text($selector.prop("name") + " - " + workout_name);
    console.log(workout_name);
    console.log({ schedule: $selector.prop("id") + "_id", workout: workout_name});

    $.post(
        "?command=edit_profile",
        { schedule: $selector.prop("id") + "_id", workout: workout_name}
    )
});


console.log($schedule_selectors);