<?php get_header(); ?><?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
<section class="single-news-post content-container">
  <div class="container">
    <article>
      <div class="link-back"><a href="/topics/news/">&lt;&nbsp;Back to News</a></div>
      <h1 title="<?php the_title(); ?>"><?php the_title(); ?>
      </h1><?php if ( get_post_meta($post->ID, 'subtitle', true) ) { ?>
      <h2><?php echo get_post_meta($post->ID, "subtitle", $single = true); ?>
      </h2><?php } ?>
      <div class="post-info">By&nbsp;<span class="author"><?php if ( get_post_meta($post->ID, 'by_line', true) ) {
	echo get_post_meta($post->ID, "by_line", $single = true);
} else {
	the_author_link();
} ?></span><span class="divider">|</span>
        <time><?php the_time('F'); ?>&nbsp;<?php the_time('j'); ?>, <?php the_time('Y'); ?>
        </time>
      </div><?php if (has_post_thumbnail( $post->ID)) : ?><?php $thumb_id = get_post_thumbnail_id(); ?><?php $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'post-thumbnail', true); ?><?php $thumb_url = $thumb_url_array[0]; ?>
      <div style="background-image: url('<?php echo $thumb_url; ?>');" class="featured-image"></div><?php endif; ?><?php the_content(); ?><?php if ( get_post_meta($post->ID, 'external_link', true) ) { ?>
      <nav class="link-external"><span class="link-icon"></span>Read more: <a href="<?php echo get_post_meta($post->ID, 'external_link', $single = true); ?>" target="_blank"><?php echo get_post_meta($post->ID, "external_link_name", $single = true); ?></a></nav><?php } ?><?php if ( get_post_meta($post->ID, 'legal_checkbox', true) ) { ?>
      <p class="legal">The entities and logos identified on this page may have trademarks and those trademarks are owned by the respective entity.</p><?php } ?>
    </article>
  </div>
</section><?php endwhile; ?><?php else : ?>
<h1>Not Found</h1>
<p>Missing content.</p><?php endif; ?><?php get_footer(); ?>