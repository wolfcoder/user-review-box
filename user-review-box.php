<?php
/**
 * Plugin Name: User Review Box
 * Plugin URI: https://www.yourwebsite.com/user-review-box
 * Description: A WordPress plugin that provides a frontend user review box that can be inserted into any post or page via a WordPress block, shortcode, and PHP snippet. The user can leave 1 of 5 stars and submit their email address. The email is submitted to either ActiveCampaign or ConvertKit via their respective APIs. The rating is logged into a database and averaged with other reviews.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://www.yourwebsite.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: user-review-box
 * Domain Path: /languages
 * WC requires at least: 3.0.0
 * WC tested up to: 5.0.0
 */


 function user_review_box_form() {
    ob_start(); // Start output buffering
    ?>
    <form id="user-review-box-form">
        <label for="rating">Rating:</label>
        <select id="rating" name="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button class="submit-review">Submit Review</button>
    </form>
    <?php
    return ob_get_clean(); // End output buffering and return the form HTML
}

add_shortcode('user_review_box', 'user_review_box_form');

function user_review_box_form_submission() {
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate the email address
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            echo "Invalid email address.";
            return;
        }

        // Submit the email to the chosen API
        // This is just a placeholder - you'll need to replace this with the actual API call
        $api_choice = get_option('user_review_box_api_choice');
        if ($api_choice == 'activecampaign') {
            // Submit to ActiveCampaign
        } else if ($api_choice == 'convertkit') {
            // Submit to ConvertKit
        }
    }

    // The rest of your function goes here...
}

// add javascript to footer
add_action('wp_footer', 'user_review_box_scripts');

// add script to footer
function user_review_box_scripts() {
    // enqueue the script
    wp_enqueue_script('user-review-box', plugin_dir_url(__FILE__) . 'user-review-box.js', array('jquery'), '1.0.0', true);
    
}

