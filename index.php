<?php get_header(); ?>
<section id="featured_articles" class="featured-articles">
  <div class="content-container clearfix"><?php query_posts( array( 'tag' => 'featured', 'posts_per_page' => 3));
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
        <div class="articles-list">
          <h1 class="title-latest"><strong>Featured Articles</strong></h1><?php $exclude_ID1 = get_category_id('news');
$exclude_tag1 = get_tag_id('featured');
query_posts( array(
	'posts_per_page' => 5,
	'tag__not_in' => $exclude_tag1,
	'category__not_in' => $exclude_ID1,
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
      <!-- list of recent news-->
      <div class="news-list">
        <h3 class="title-side-list"><strong>Rally News</strong></h3><?php query_posts( array('category_name' => 'news', 'posts_per_page' => 6));
if ( have_posts() ) while ( have_posts() ) : the_post();

	get_template_part( 'side-list-items', get_post_format() );

endwhile;
wp_reset_query();
 ?><a href="/topics/news/" class="read-more">More News</a>
      </div>
    </div>
  </div>
</section><?php get_footer(); ?>