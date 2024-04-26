//form validation
let $form = $("form");
$form.on("submit", function(e) {
    if($('input[type="number"]').is(function() {
        return $(this).val < 0;
    })) {
        e.preventDefault();
        console.log("wrong workout name");
        alert("alert");
        return false;
    }
});