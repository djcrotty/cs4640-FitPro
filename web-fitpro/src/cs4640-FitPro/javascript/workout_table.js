//javascript object that holds table information needed for each workout
function Table(name, checkboxes, num_exercises, num_checked, table, progress_bar) {
    this.name = name;
    this.$checkboxes = checkboxes;
    this.num_exercises = num_exercises;
    this.$table = table;
    this.$progress_bar = progress_bar;
    this.num_checked = num_checked;
    this.$progress_bar.text(((this.num_checked/this.num_exercises)*100).toFixed(2) + "% complete");

    this.onCheck = function($checkbox) {
        console.log("checked");
        if($checkbox.prop("checked"))
            this.num_checked += 1;
        else
            this.num_checked -= 1;
        this.$progress_bar.text(((this.num_checked/this.num_exercises)*100).toFixed(2) + "% complete");
    };
};

$(document).ready(function() {
    //add event listeners to update table whenever checking an exercise
    let tables = [];
    $("table").each(function() {
        let $checkboxes = $(this).find("input");
        let num_checked = 0;
        $checkboxes.each(function(){
            if($(this).prop("checked")) num_checked +=1;
        });
        let newTable = new Table($(this).prop("id"), $checkboxes, 3, num_checked, $(this), $("#progress-bar-" + $(this).prop("id")));
        tables.push(newTable);

        $checkboxes.on("click", function(event) {
            newTable.onCheck($(event.target));
        });
    });

    //when leaving page save changes to database
    $(window).on("beforeunload", function() {
        let postParams = {workouts: [], exercises:[], checked: []};
        tables.forEach(table => {
            table.$checkboxes.each(function(){
                postParams.workouts.push($(this).attr("workout"));
                postParams.exercises.push($(this).attr("exercise"));
                postParams.checked.push($(this).prop("checked"));
            });
        });
        $.ajax({
            type: "POST",
            url: "?command=edit_profile",
            data: postParams,
            success: function() {
                // console.log("send request");
            },
            async: false
        });
    });
});