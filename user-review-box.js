// add jquery script

jQuery(document).ready(function($) {
    $('.submit-review').click(function(e) {
        e.preventDefault();

        // get rating
        var rating = $('#rating').val();
        console.log(rating);

        // get email
        var email = $('#email').val();
        console.log(email);
    });
});