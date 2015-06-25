<?php get_header(); ?><?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
<article class="single-post-content"><?php $thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'single-post-image', true);
$thumb_url = $thumb_url_array[0];
 ?>
  <div class="content-container heading">
    <div class="container">
      <h1 title="<?php the_title(); ?>"><?php the_title(); ?>
      </h1><?php if ( get_post_meta($post->ID, 'subtitle', true) ) { ?>
      <h2><?php echo get_post_meta($post->ID, "subtitle", $single = true); ?>
      </h2><?php } ?>
    </div>
  </div>
  <div class="featured-image"><?php the_post_thumbnail( 'single-post-image' ); ?>
  </div>
  <div class="content-container article-body">
    <div class="container clearfix">
      <!-- sidebar-->
      <div class="side-bar">
        <div class="date"><?php the_time('F j, Y'); ?>
        </div>
        <div class="author">
          <h4>Posted By:</h4><?php if ( get_post_meta($post->ID, 'by_line', true) ) {
	echo get_post_meta($post->ID, "by_line", $single = true);
} else {
	the_author_link();
} ?>
        </div>
        <div class="categories">
          <h4>Categories</h4><?php the_category(); ?>
        </div>
      </div>
      <!-- main content-->
      <div class="main"><?php the_content(); ?><?php if ( get_post_meta($post->ID, 'external_link', true) ) { ?>
        <nav class="link-external"><span class="link-icon"></span>Read more: <a href="&lt;?php echo get_post_meta($post-&gt;ID, 'external_link', $single = true); ?&gt;" target="_blank"><?php echo get_post_meta($post->ID, "external_link_name", $single = true); ?></a></nav><?php } ?>
      </div>
    </div>
  </div>
</article>
<div class="content-container article-footer">
  <div class="container">
    <div class="content-block">
      <nav class="articles-list">
        <div class="section-header">
          <h4>Done with this article? Read more</h4>
        </div><?php $category = get_the_category($post->ID);
query_posts ( array(
	'posts_per_page' => 4,
	'post__not_in' => array($post->ID),
	'category__in' => array(
			$category[0]->cat_ID,
			$category[1]->cat_ID,
			$category[2]->cat_ID
		)
	));
if ( have_posts() ) while ( have_posts() ) : the_post();
	get_template_part( 'article-list-items' );
endwhile;

wp_reset_query();

 ?>
      </nav>
    </div>
  </div>
</div><?php endwhile; ?><?php else : ?>
<h1>Not found</h1>
<p>Content missing</p><?php endif; ?><?php get_footer(); ?>