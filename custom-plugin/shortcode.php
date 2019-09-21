<?php
// [book] Shortcode
function short_code($atts)
{
    $atts = shortcode_atts(array(
        'id' => '1',
        'author_name' => 'Tapan',
        'category' => 'Drama',
        'tag' => 'chetan',
        'publisher' => 'harper collins'
    ), $atts, 'book');
    return " <b>PostID:</b> {$atts['id']}<br><b>Author Name</b>: {$atts['author_name']}<br><b>Category:</b> {$atts['category']}<br><b>Tags:</b> {$atts['tag']}<br><b>Publisher:</b> {$atts['publisher']}";
}
add_shortcode('book', 'short_code');