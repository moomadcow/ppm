<?php $thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'single-post-image', true);
$thumb_url = $thumb_url_array[0];
$postClass = join( ' ', get_post_class() );
 ?>
<article id="post-<?php the_ID(); ?>" style="background-image: url('<?php echo $thumb_url; ?>');" class="content-block <?php echo $postClass; ?>"><a href="<?php the_permalink(); ?>" class="overlay">
    <div class="heading">
      <h2 title="<?php the_title(); ?>"><?php the_title(); ?>
      </h2>
      <!--.excerpt-->
      <!--	- the_excerpt();-->
      <!--.post-date-->
      <!--	- the_time('F j, Y');-->
    </div></a>
  <div class="categories clearfix"><?php the_category(); ?>
  </div>
</article>