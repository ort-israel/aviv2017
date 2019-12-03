// Use on the question category select in the question bank screen
$(document).ready(function () {
    var $eventSelect = $("#id_selectacategory"); // question category select
    // Make the question-category select be searchable
    if ($eventSelect.length > 0 && $.fn.select2) {
        $eventSelect.select2(); // this runs the script that adds the search
     }

    /* Listen for the change event and submit the form
       in order to trigger the page refresh with the selected category */
    $eventSelect.on('change', function (e) {
        $("#displayoptions").submit();
    });

});