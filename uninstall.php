<?php

// check that code was called from WordPress with 
// uninstallation constant declared

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// check if options exist and delete them if present
if (!get_options('user_review_box_options')) {
    delete_option('user_review_box_options');
}
