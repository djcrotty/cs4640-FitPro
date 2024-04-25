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

let $tables = $("table");
$tables.each(function() {
    let $checkboxes = $(this).find("input");
    $checkboxes.on("click", function() {
        console.log("clicked");
        
    });
    console.log($checkboxes);
});