<?php
// Function to add text shortcode to posts and pages
function text_shortcode()
{
    return 'This is a simple text shortcode. Enjoy!';
}

add_shortcode('text', 'text_shortcode');