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
#transition-hover-content h3 {
    margin-bottom: 8px;
    margin-top: 40px;
    letter-spacing: 1px;
}
#transition-hover-content hr {
    margin-bottom: 0px;
}
</style>

      <div class="content-sidebar-wrap">

       <main role="main" itemprop="mainContentOfPage">

	   <div class="our-portfolio">

		<div class="wrap">

			<section id="text-4" class="widget widget_text mobiletop">

			   
                    
				<?php
                	
					$args = array( 'hide_empty=0' );
					$terms = get_terms( 'specialities', $args );
					
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
						$count = count( $terms );
						$i = 0;
						$term_list = '<div class="portfolio">';
						foreach ( $terms as $term ) {
							$i++;
						
						//Show Term If Portfolio Term IMAGE exists
						$image = get_field('portfolio_category_thumbnail', $term);
						if( !empty($image) ):
							
						$term_list .= '<div class="one-third" id="transition-hover">'; //li Starts
						
							$term_list .= '<div class="border">';
								
								$term_list .= '<img src="'. $image['url'] .'" alt="'. $image['alt'] .'" />';
                        	
							$term_list .= '</div>';
                            
                            $term_list .= '<div id="transition-hover-content">';
								
								$term_list .= '<h3><a href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all portfolio added under %s', 'my_localization_domain' ), $term->name ) ) . '">';
								
									$term_list .=  $term->name;
								
								$term_list .= '</a></h3>';
							
									$term_list .= '<hr/>';
								
								$term_list .= '<a class="learnmore" href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all portfolio added under %s', 'my_localization_domain' ), $term->name ) ) . '">View Project Details</a>';
                            
                            $term_list .= '</div>';
								
						 $term_list .= '</div>'; //li ends
						 
						 endif; //End portfolio image checking  
						
						}// for loop ends
						
						$term_list .= '</div>';
						echo $term_list;
					}
                
                ?>

				

			</section>

    	</div>

	</div>

	<!--sub-section-2  ENDS HERE--> 
    <br /><br />

         </main>

         </div>



<?php get_footer(); ?>