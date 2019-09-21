<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="slider">
                <div class="slider-text"><p>Gearing up the ideas</p></div>
                <div class="slider-arrow1">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/slider-arrows-e1569039346737.png" alt="">
                </div>
                <div class="slider-arrow2">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/slider-arrows-1-e1569039369975.png" alt="">
                </div>
                <div class="slider-text2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium eaque et iusto natus nostrum omnis quia quo.</div>
            </div>
            <div class="feature-strip1">
                <div class="feature-strip">
                    <div style="float:left; width:10%; margin-top:25px; padding-left:30px;">
                        <img src="http://localhost/testsite/wp-content/uploads/2019/09/feature-icons-e1568384808540.png">
                    </div>
                    <div style="float:left; width: 20%">
                        <p class="heading2">Advertising</p>
                        <p class="paragraph">
                            Lorem ipsum dolor sit amet. Modi. qui...
                        </p>
                    </div>

                    <div style="float:left; width:10%; margin-top:25px;padding-left:30px;">
                        <img src="http://localhost/testsite/wp-content/uploads/2019/09/feature-icons-1-e1568386007173.png">
                    </div>
                    <div style="float:left; width:20%">
                        <p class="heading2">Multimedia</p>
                        <p class="paragraph">
                            Lorem ipsum dolor sit amet. Modi. qui...
                        </p>
                    </div>

                    <div style="float:left; width:10%; margin-top:25px;padding-left:30px;">
                        <img src="http://localhost/testsite/wp-content/uploads/2019/09/feature-icons-2-e1568386156700.png">
                    </div>
                    <div style="float:left; width:20%;">
                        <p class="heading2">Photography</p>
                        <p class="paragraph">
                            Lorem ipsum dolor sit amet. Modi. qui...
                        </p>
                    </div>

                </div>
            </div>

            <div class="container">
                <div>
                    <p class="headliner-text">D'SIGN IS THE SOUL</p>
                    <button class="headliner-button">view more</button>
                </div>
                <hr style="border: 1px solid #62585f">
                <div class="grid-container">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/image-1.png">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/image-2.png">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/image-3.png">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/image-4.png">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/image-5.png">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/image-6.png">
                </div>
                <hr style="border: 1px solid #62585f; margin-top: 20px">
                <div class="welcome-text">
                    <div>
                        <p class="headliner-text" style="font-size: 25px;">Welcome to D'SIGN<em>fly</em></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio doloribus ducimus esse et expedita facere illo illum inventore ipsa ipsam, minus natus neque, quaerat quas quasi repellendus sapiente ullam voluptatum.</p>
                        <a href="#">Read More</a>
                    </div>
                    <div style="width: 100%">
                        <p class="headliner-text" style="font-size: 25px;">Contact Us</p>
                        <p>Street 21 Planet, A-11, dapibus tristique 123511<br>
                        Tel:123 456 7890 Fax:123 456789<br>
                            Email: <a href="mailto:contactus@dsignfly.com">contactus@dsignfly.com</a></p>
                        <img src="http://localhost/testsite/wp-content/uploads/2019/09/social-e1569043310326.png" alt="social-media-links">
                    </div>
                </div>

            </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
