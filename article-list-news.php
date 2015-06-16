<?php $postClass = join( ' ', get_post_class() ); ?>
<article id="post-<?php the_ID(); ?>" class="news-posts <?php echo $postClass; ?>"><?php $thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'tile-thumbnail', true);
$thumb_url = $thumb_url_array[0];
 ?><a href="<?php the_permalink(); ?>" style="background-image: url('<?php echo $thumb_url; ?>');" class="post-thumbnail"></a>
  <h1 title="<?php the_title(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
  <time><?php the_time('F'); ?><?php the_time('j'); ?>, <?php the_time('Y'); ?>
  </time>
  <div class="excerpt"><?php the_excerpt(); ?>
  </div>
</article>