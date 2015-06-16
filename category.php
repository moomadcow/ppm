<?php get_header(); ?>
<div class="page-header">
  <div class="content-container">
    <div class="content-container">
      <div class="container">
        <h1><?php if (is_category()) {
	$cat = get_query_var('cat');
	$yourcat = get_category($cat);
	echo $yourcat->slug . ' articles';
	}
 ?>
        </h1>
      </div>
    </div>
  </div>
</div>
<section id="featured_articles" class="featured-articles">
  <div class="content-container clearfix"><?php query_posts(array(
	'cat' => get_query_var('cat'),
	'tag' => 'featured',
	'posts_per_age' => 3
	));
if (have_posts()) while (have_posts()) : the_post();
	get_template_part('featured');
	endwhile;
wp_reset_query();
 ?>
  </div>
</section>
<section id="articles">
  <div class="content-container">
    <div class="container clearfix">
      <div id="ajax-load-content">
        <div class="articles-list">
          <h1 class="title-latest"><strong>Featured articles</strong></h1><?php $args = array(
	'cat' => get_query_var('cat'),
	'tag' => 'featured',
	'posts_per_page' => 3
	);
$ids = array();
$products = new WP_Query($args);
if ($products->have_posts()) :
	while ($products->have_posts()) : $products->the_post();
		$ids[] = $post->ID;
	endwhile;
endif;

$exclude_ID1 = get_category_id('rally news');
$exclude_tag1 = get_tag_id('featured');
query_posts( array(
	//'tag__not_in' => $exclude_tag1,
	'category__not_in' => $exclude_ID1,
	'post__not_in' => $ids,
	'cat' => get_query_var('cat'),
	'paged' => get_query_var( 'paged' ),
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
      <div class="news-list">
        <h3 class="title-side-list"><strong>Rally News</strong></h3><?php query_posts( array('category_name' => 'news', 'posts_per_page' => 5));
if ( have_posts() ) while ( have_posts() ) : the_post();

	get_template_part( 'side-list-items');

endwhile;
wp_reset_query(); ?><a href="/topics/news/" class="read-more">More News</a>
      </div>
    </div>
  </div>
</section><?php get_footer(); ?>