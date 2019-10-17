<?php
/**
 * Create shortcode for CPT Book
 *
 * PHP Version 7
 *
 * @category Plugin
 * @package  Wpbook
 * @author   Tapan Chudasama <tapan9740@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/testsite/
 * Description: rtCamp Assignment Plugin
 * Version: 1.0
 * Text Domain: custom-plugin
 **/

/**
 * [book] Shortcode
 *
 * @param array $atts Attributes
 *
 * @return string
 */
function Short_code($atts)
{
    $atts = shortcode_atts(
        array(
        'id' => '1',
        'author_name' => 'Tapan',
        'category' => 'Drama',
        'tag' => 'chetan',
        'publisher' => 'harper collins'
        ),
        $atts,
        'book'
    );

    return " <b>PostID:</b> {$atts['id']}
    <br>
    <b>Author Name</b>: {$atts['author_name']}
    <br>
    <b>Category:</b> {$atts['category']}
    <br>
    <b>Tags:</b> {$atts['tag']}
    <br>
    <b>Publisher:</b> {$atts['publisher']}";
}
add_shortcode('book', 'Short_code');
