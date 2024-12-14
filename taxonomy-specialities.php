<?php

/*

template name: Portfolio

*/

?>



<?php get_header(); ?>
<style>
section.portfolio-header#portfolio {
  margin-top: -46px;
}
.subpage-header {
    min-height: 74px;
    background-image: none !important;
}
.transparent-layer {
    background: rgba(0,0,0,.9);
}
</style>

      <div class="content-sidebar-wrap">

       <main role="main" itemprop="mainContentOfPage">

	   <div class="our-portfolio">

		<div class="wrap">

			<section id="text-4" class="widget widget_text mobiletop">

			   <div class="portfolio">
                    
                    <?php 
					  
					  // set up or arguments for our custom query
  					  $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
					  
					  // Get the current CPT category/term and pass in query below.
					  $term_slug = get_queried_object()->slug;
						  if ( !$term_slug )
						  return;
						  else  
						  $args = array(
							  'post_type'   => 'Portfolio',
							  'post_status' => 'publish',
							  'posts_per_page' => -1,
							  'tax_query' => array(
									   array(
										 'taxonomy' => 'specialities',
										 'field' => 'slug',
										 'terms' => $term_slug,
									   )
									 ),
							  //'orderby'=> 'title', 
							  'order' => 'DESC',
							  'paged' => $paged,
						  );
						  $projects = new WP_Query( $args );
					  
					  
					  //$wp_query->query('showposts=9&post_type=Portfolio'.'&paged='.$paged);
					  
					  if ( $projects->have_posts() ) : 
					
					  while ($projects->have_posts()) : $projects->the_post(); 
					?>

					<div class="one-third" id="transition-hover">

						<div class="border">
                        	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'Portfolio-Thumbnail' ); ?></a>
                        </div>

						<div id="transition-hover-content">

							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

							<p><?php the_subheading(); ?></p>
                            
                            <hr/>
                            
                            <a href="<?php the_permalink(); ?>" class="learnmore">View Project Details</a>

						</div>

					</div>

					<?php endwhile; endif; ?>

                    <?php //wp_pagenavi(); ?>
                   
				</div>

			</section>

    	</div>

	</div>

	<!--sub-section-2  ENDS HERE--> 
    <br /><br />

         </main>

         </div>



<?php get_footer(); ?>