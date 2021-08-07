$(document).ready(function() {
    $(document).on("click", "a", function(event) {
        localStorage.setItem('unit', $(this).attr('id'));
    });
});