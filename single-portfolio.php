<?php 

get_header();



?>
<style>
.single-portfolio-header {
  margin-top: 0px;
}
.site-inner {
  clear: both;
  margin-top:0px !important;
}
.portfolio-category {
	margin-bottom:20px;
}
</style>


<div class="site-inner">
  <div class="content-sidebar-wrap portfoliocontent">
    <main class="content" role="main" itemprop="mainContentOfPage">
      <article class="post-18 page type-page status-publish entry" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
        <div class="entry-content" itemprop="text">
         <div class="portfolio-category">
         	<strong>Portfolio Category:</strong> 
			<?php 
				global $post;
				$terms = wp_get_post_terms( $post->ID, 'specialities');
				//print_r($terms); #displays the output 
				echo $terms[0]->name;				
			?>
         </div>
          <?php 
		  	
		  	if (have_posts()) : while (have_posts()) : the_post(); 
		  
		  ?>
          <?php the_content(); ?>
          <?php endwhile; endif; ?>
        </div>
      </article>
    </main>
    <aside class="sidebar sidebar-primary widget-area" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
      <aside class="widget-area">
      <?php if( get_field('add_video_embed_code_here') ): ?>
        <section id="video" class="widget widget_video">
          <div class="widget-wrap">
          	<?php the_field('add_video_embed_code_here'); ?>
          	<img style="display:none;" src="<?php echo get_stylesheet_directory_uri() ?>/images/video.jpg" />
          </div>
        </section>
        <?php endif; ?>
        <section id="download" class="widget widget_download">
          <div class="widget-wrap">
		  <?php if( have_rows('upload_project_files') ):	?>
            <h4 class="widget-title widgettitle">Project Files</h4>
            <ul>
            
            	

                	<?php while ( have_rows('upload_project_files') ) : the_row(); ?> 
                
                       <li class="download-hover">
                        <p><?php the_sub_field('file_name'); ?></p>
                        <div class="hide-button"><a href="<?php the_sub_field('upload_file'); ?>" target="_blank">DOWNLOAD</a></div>
                      </li>
                  
				<?php endwhile; ?>
            	
             
            </ul>
          </div>
          <?php else : endif; ?>
        </section>
      </aside>
    </aside>
  </div>
</div>
</div>

<?php if( get_field('project_testimonial') ): ?>
<div class="single-testimonial" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/images/port-testimonial-bg.jpg);">
  <div class="wrap">
    <h2>Project Testimonial</h2>
    
    <?php the_field('project_testimonial'); ?>
    
  </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>
