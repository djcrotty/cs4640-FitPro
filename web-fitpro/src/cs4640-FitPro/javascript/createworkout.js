//form validation
let $form = $("form");
$form.on("submit", function(e) {
    if($('input[type="number"]').is(function() {
        return $(this).val() < 0;
    })) {
        e.preventDefault();
        console.log("must be positive values");
        $form.append("<div class=\"alert alert-danger col-xs-12 d-inline-block\" id=\"message\">All Numbers Must Be Positive</div>");
        return false;
    }
});