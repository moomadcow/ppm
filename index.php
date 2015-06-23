<?php get_header(); ?>
<section id="featured_articles" class="featured-articles">
  <div class="content-container clearfix"><?php query_posts( array('posts_per_page' => 4));
if ( have_posts() ) while ( have_posts() ) : the_post();

	get_template_part( 'featured', get_post_format() );

endwhile;
wp_reset_query();
 ?>
  </div>
</section>
<section id="articles">
  <div class="content-container">
    <div class="container clearfix">
      <!-- list of new articles-->
      <div id="ajax-load-content">
        <div class="articles-list"><?php $args = array(
	'posts_per_page' => 4
	);
$ids = array();
$products = new WP_Query($args);
if ( $products->have_posts() ) :
    while ( $products->have_posts() ) : $products->the_post();
       $ids[] = $post->ID;
    endwhile;
endif;

query_posts( array(
	'post__not_in' => $ids,
	'paged' => get_query_var( 'paged' )
	));

if ( have_posts() ) while ( have_posts() ) : the_post();

	get_template_part( 'article-list-items' );

endwhile;
 ?>
          <div class="page-nav"><?php previous_posts_link('previous'); ?>
            <div class="next"><?php next_posts_link('next', $wp_query->max_num_pages); ?>
            </div>
          </div><?php wp_reset_query(); ?>
        </div>
      </div>
    </div>
  </div>
</section><?php get_footer(); ?>