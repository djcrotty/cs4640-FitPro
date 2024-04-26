//eventlistener for when user edits description
function edit_description(event) {
    event.preventDefault();
    let $text = $("#text_description");
    let text = $text.val();
    $text.prop('value', '')
    let $user_description = $("#user_description");
    $user_description.text(text);

    //send ajax to update profile database
    $.ajax({
        type: "POST",
        url: "?command=edit_profile",
        data: {description: text},
        success: function() {
            console.log("success");
        },
        dataType: "json"
    });
};

$(document).ready(function() {
    let $form_button = $("#description_button");
    $form_button.on("click", edit_description);
});
