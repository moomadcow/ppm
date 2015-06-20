<?php get_header(); ?><?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
<article class="single-post-content"><?php if (has_post_thumbnail( $post->ID)) :
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'single-post-image', true);
	$thumb_url = $thumb_url_array[0]; ?>
  <div class="content-container heading">
    <div class="container">
      <h1 title="<?php the_title(); ?>"><?php the_title(); ?>
      </h1><?php if ( get_post_meta($post->ID, 'subtitle', true) ) { ?>
      <h2><?php echo get_post_meta($post->ID, "subtitle", $single = true); ?>
      </h2><?php } ?>
      <div class="desc">By <?php if ( get_post_meta($post->ID, 'by_line', true) ) {
	echo get_post_meta($post->ID, "by_line", $single = true);
} else {
	the_author_link();
} ?> | <?php the_time('F'); ?>&nbsp;<?php the_time('j'); ?>, <?php the_time('Y'); ?><?php if ( get_post_meta($post->ID, 'article_source', true) ) { ?> | <?php echo get_post_meta($post->ID, "article_source", $single = true); ?><?php } ?>
      </div>
    </div>
  </div>
  <div class="featured-image"><?php the_post_thumbnail( 'single-post-image' ); ?>
  </div><?php else : ?>
  <div class="content-container simple-heading">
    <div class="container">
      <h1 title="<?php the_title(); ?>"><?php the_title(); ?>
      </h1><?php if ( get_post_meta($post->ID, 'subtitle', true) ) { ?>
      <h2><?php echo get_post_meta($post->ID, "subtitle", $single = true); ?>
      </h2><?php } ?>
      <div class="desc">By <?php if ( get_post_meta($post->ID, 'by_line', true) ) {
	echo get_post_meta($post->ID, "by_line", $single = true);
} else {
	the_author_link();
} ?> | <?php the_time('F'); ?>&nbsp;<?php the_time('j'); ?>, <?php the_time('Y'); ?><?php if ( get_post_meta($post->ID, 'article_source', true) ) { ?> | <?php echo get_post_meta($post->ID, "article_source", $single = true); ?><?php } ?>
      </div>
    </div>
  </div><?php endif; ?>
  <div class="content-container">
    <div class="container clearfix">
      <!-- sidebar-->
      <div class="side-bar">
        <div class="social-share">
          <div class="heading">Share</div><span displayText="Facebook" class="st_facebook_custom icon facebook"><i class="fa fa-facebook"></i></span><span displayText="Tweet" class="st_twitter_custom icon twitter"><i class="fa fa-twitter"></i></span><span displayText="LinkedIn" class="st_linkedin_custom icon linkedin"><i class="fa fa-linkedin"></i></span><span displayText="Reddit" class="st_reddit_custom icon reddit"><i class="fa fa-reddit"></i></span>
        </div><?php get_template_part('promo-kh-module-side'); ?>
      </div>
      <!-- main content-->
      <div class="article-body"><?php the_content(); ?><?php if ( get_post_meta($post->ID, 'external_link', true) ) { ?>
        <nav class="link-external"><span class="link-icon"></span>Read more: <a href="&lt;?php echo get_post_meta($post-&gt;ID, 'external_link', $single = true); ?&gt;" target="_blank"><?php echo get_post_meta($post->ID, "external_link_name", $single = true); ?></a></nav><?php } ?>
      </div>
    </div>
  </div>
</article>
<div class="content-container article-footer">
  <div class="container">
    <div class="content-block">
      <nav class="related-articles">
        <div class="heading">Done with this article? Read more</div><?php $category = get_the_category($post->ID);
query_posts ( array(
	'posts_per_page' => 5,
	'post__not_in' => array($post->ID),
	'category__in' => array(
			$category[0]->cat_ID,
			$category[1]->cat_ID,
			$category[2]->cat_ID
		)
	));
if ( have_posts() ) while ( have_posts() ) : the_post();
	get_template_part( 'article-list-related' );
endwhile;

wp_reset_query();
 ?>
      </nav>
      <!-- bottom promo modules--><?php get_template_part('promo-kh-module-bottom'); ?>
      <div id="linked_in_subscribe_box" class="subscribe"><?php if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 8 ); } ?>
      </div>
    </div>
  </div>
</div>
<!-- modal for kevin hart-->
<div id="kh_modal" class="modal small promo-modal-kh"><a data-action="close" data-category="promo kevin hart modal" data-label="close modal" class="close ga-events"><i class="fa fa-close"></i></a>
  <div class="container">
    <div class="content"><?php get_template_part('promo-kh-module-modal'); ?>
    </div>
  </div>
</div>
<!-- modal for linkedin email signup-->
<div id="linkedin_modal" class="modal small email-sign-up"><a data-action="close" data-category="promo linkedin modal" data-label="close modal" class="close ga-events"><i class="fa fa-close"></i></a>
  <div class="container">
    <div class="content"><?php if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 10 ); } ?>
    </div>
  </div>
</div><?php endwhile; ?><?php else : ?>
<h1>Not found</h1>
<p>Content missing</p><?php endif; ?><?php get_footer(); ?>