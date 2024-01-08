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

class User_Review_Box
{
    public function __construct()
    {
        add_shortcode('user_review_box', array($this,  'user_review_box_form'));
        // add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts_styles'));
        register_activation_hook(__FILE__, array($this, 'set_default_options'));
        // register_deactivation_hook(__FILE__, array($this, 'delete_default_options'));
    }

    function set_default_options()
    {
        //     if (!get_option('user_review_box_options')) {
        //         $options = array(
        //             'active_campaign_api_url' => '',
        //             'active_campaign_api_key' => '',
        //             'active_campaign_list_id' => '',
        //             'convertkit_api_url' => '',
        //             'convertkit_api_key' => '',
        //             'convertkit_form_id' => '',
        //         );
        //         add_option('user_review_box_options', $options);
        //     }

        $options =  get_option('user_review_box_options', array());

        $new_options['ga_account_id'] = 'UA-123456789-1';
        $new_options['ga_domain'] = 'yourwebsite.com';

        $merged_options =  wp_parse_args($new_options, $options);

        $compare_options = array_diff_key($new_options, $options);

        if (!empty($options) || !empty($compare_options)) {
            update_option('user_review_box_options', $merged_options);
        }

        return $merged_options;
    }

    function delete_default_options()
    {
        delete_option('user_review_box_options');
    }

    function user_review_box_form()
    {
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
}

$my_user_review_box = new User_Review_Box();
