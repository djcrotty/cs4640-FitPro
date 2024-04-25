function edit_description(event) {
    event.preventDefault();
    let $text = $("#text_description");
    let text = $text.val();
    $text.prop('value', '')
    let $user_description = $("#user_description");
    $user_description.text(text);

    $.ajax({
        type: "POST",
        url: "?command=edit_profile",
        data: {description: text},
        success: function() {
            console.log("success");
        },
        dataType: "json"
    });
}

let $form_button = $("#description_button");
$form_button.on("click", edit_description);

//javascript object that holds table information needed for each workout
function Table(name, checkboxes, num_exercises, table, progress_bar) {
    this.name = name;
    this.$checkboxes = checkboxes;
    this.num_exercises = num_exercises;
    this.$table = table;
    this.num_checked = 0;
    this.$progress_bar = progress_bar;

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

let tables = [];
$("table").each(function() {
    let $checkboxes = $(this).find("input");
    let newTable = new Table($(this).prop("id"), $checkboxes, 3, $(this), $("#progress-bar-" + $(this).prop("id")));
    tables.push(newTable);

    $checkboxes.on("click", function(event) {
        console.log("clicked");
        newTable.onCheck($(event.target));
    });
    console.log($checkboxes);
});