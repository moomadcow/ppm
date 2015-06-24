<?php $thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'article-list-image', true);
$thumb_url = $thumb_url_array[0];
$postClass = join( ' ', get_post_class() );
 ?>
<article id="post-<?php the_ID(); ?>" class="clearfix <?php echo $postClass; ?>"><a href="<?php the_permalink(); ?>" style="background-image: url('<?php echo $thumb_url; ?>');" class="thumbnail">
    <div class="overlay"></div></a>
  <div class="post-info"><a href="?php the_permalink(); ?>">
      <h2 title="<?php the_title(); ?>"><?php the_title(); ?>
      </h2></a>
    <div class="excerpt"><?php the_excerpt(); ?>
    </div>
    <div class="post-detail"><?php the_time('F j, Y'); ?>&nbsp;/&nbsp;By <?php if ( get_post_meta($post->ID, 'by_line', true) ) {
	echo get_post_meta($post->ID, "by_line", $single = true);
} else {
	the_author_link();
} ?>&nbsp;/&nbsp;<?php the_category(', '); ?>
    </div>
  </div>
</article>