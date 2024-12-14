<?php
/**
 * This file adds the Home Page to the Parallax Pro Theme.
 *
 * @author StudioPress
 * @package Parallax
 * @subpackage Customizations
 */

//* Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Add parallax-home body class
add_filter( 'body_class', 'parallax_body_class' );
function parallax_body_class( $classes ) {

	$classes[] = 'home';
	return $classes;
	
}
 
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'custom_homepage' );
 
function custom_homepage() { 
global $blogurl;
?>
<!--Home-Top  ENDS HERE-->
<style>
.site-inner {
  max-width: 100%;
  margin-top: 0px;
}
.full-width-content .content {
  width: 100%;
  padding:0px;
}
.portfolio .wrap{ width:1000px;}
.slick-slide {
  width: 298px;
  margin-left: 18px;
  margin-right: 18px;
}
.slick-slide span{
	font-size:16px;
	text-transform:uppercase;
	font-weight:700;
	color:#FFF;
	display: block;
	text-align: center;
	margin-top: 16px;
	font-family: 'Oswald', sans-serif;
	letter-spacing: 0.5px;
	text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.50);
}
.slick-slide img{
	border:6px solid #fff;
	-webkit-box-shadow: 0px 2px 10px 5px rgba(0,0,0,0.15);
	-moz-box-shadow: 0px 2px 10px 5px rgba(0,0,0,0.15);
	box-shadow: 0px 2px 10px 5px rgba(0,0,0,0.15);
	width:300px;
	height:272px;
}
</style>

	<div class="startfree-container" id="free" data-original="<?php echo get_stylesheet_directory_uri() ?>/images/Startfree-bg.jpg" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/images/Startfree-bg.jpg);">
    <div class="wrap">
     <div>
        <div class="two-thirds first">
        <header><img src="<?php echo get_stylesheet_directory_uri() ?>/images/letus-design.png" alt="let-us"/></header>
        
        <?php the_field("start_free_design"); ?>
        
        <!--<p>Before you sign a contract or spend any money elsewhere talk to the construction experts at Nationwide Construction. Our in-house team will arm you with the information you need to make wise decisions BEFORE you spend. Each up-front no-cost/no-obligation planning package includes:</p>
        <ul>
        	<li>SITE PLAN</li>
            <li>MASTER PLAN</li>
            <li>CUSTOM FLOOR PLAN</li>
            <li>ELEVATION DRAWINGS</li>
            <li>3D RENDERING</li>
            <li>LINE BY LINE STIPULATED HARD BID</li>
        </ul>
        <a class="startfree-btn" href="#">START FREE DESIGN</a>-->
        </div>
     </div>
    </div>
    </div>
    <!--Start Free Design ends here-->
    
     <div class="portfolio-container" id="portfolio" data-original="<?php echo get_stylesheet_directory_uri() ?>/images/portfolio-bg.jpg" style="background-image:url(<?php echo get_stylesheet_directory_uri() ?>/images/portfolio-bg.jpg); display:block;">
	 <div class="wrap">
     	<div>
        <header><h2>Our Portfolio</h2></header>
        <p>Please take a look at some of our most recent construction accomplishments.</p>
        <div class="portfolio">
        <div class="wrap">
           <div class="portfolio-items" data-slick='{"slidesToShow": 9, "slidesToScroll": 9}'>
          
         			 <?php 
					  $temp = $wp_query; 
					  $wp_query = null; 
					  $wp_query = new WP_Query(); 
					  $wp_query->query('showposts=9&post_type=Portfolio'.'&paged='.$paged); 
					
					  while ($wp_query->have_posts()) : $wp_query->the_post(); 
					?>
          
              <div class="transition-hover">
              	<?php the_post_thumbnail( 'Portfolio-Thumbnail' ); ?>
                <span><?php the_title(); ?></span>
                <div class="transition-hover-content">
                	<a href="<?php the_permalink(); ?>" class="learnmore">View Project Details</a>
                </div>
              </div>
              
              
             <?php endwhile; ?> 
              
              
              
            </div>
        </div>
        </div>
     </div>
     </div>
     </div>
     <!--Portfolio ends here-->
    
    <div class="testimonial-container" id="testimonial" data-original="<?php echo get_stylesheet_directory_uri() ?>/images/testimonials-bg.jpg" style="background-image:url(<?php echo get_stylesheet_directory_uri() ?>/images/testimonials-bg.jpg); display:block;">
	 <div class="wrap">
		 <div>
			<div class="one-half first testimonial-box">
            	<h3>TESTIMONIALS</h3>
                
                	
                     <?php echo do_shortcode("[show-testimonials orderby='menu_order' order='ASC' limit='0' layout='slider' options='transition:vertical,controls:controls,pause:6000,auto:on,columns:1,theme:none,info-position:info-below,text-alignment:center,charlimitextra: (...),image-size:ttshowcase_small,image-shape:circle,image-effect:none,image-link:on']"); ?>
                    
                
                
                
                
                
                <a href="/why-nationwide/testimonials/">View All &raquo;</a>
                
            </div>
            <div class="one-half latest-news" style="position:relative;">
            	<div class="b1">
                	<div class="b2">
                    	<div class="b3">
                        	<div class="b4">
                            	<div class="b5">
                                 <h3>Latest Posts</h3>
                                 
                                 <?php dynamic_sidebar('genesis-featured-posts'); ?>
                                 
                                 <a href="/blog/" class="viewall">View All &raquo;</a>
                                 
                				</div>
                			</div>
                		</div>
                	</div>
                </div>
            </div>
		 </div>
	 </div>
	</div>
    <!--Testimonial and News section ends here-->
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
 <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/slick.js"></script>    
     <script>
$('.portfolio-items').slick({
  dots: true,
  infinite: true,
  speed: 1000,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
</script>


<?php }
 
//* Run the Genesis loop
genesis();
