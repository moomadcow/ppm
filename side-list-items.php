<?php $postClass = join( ' ', get_post_class() ); ?>
<article id="post-<?php the_ID(); ?>" class="<?php echo $postClass; ?>"><a href="<?php the_permalink(); ?>">
    <h4 title="<?php the_title(); ?>"><?php the_title(); ?>
    </h4>
    <div class="desc">By <?php if ( get_post_meta($post->ID, 'by_line', true) ) {
	echo get_post_meta($post->ID, "by_line", $single = true);
} else  {
	the_author_link();
} ?> | <?php the_time('F'); ?>&nbsp;<?php the_time('j'); ?>, <?php the_time('Y'); ?><?php if ( get_post_meta($post->ID, 'article_source', true) ) { ?>	 | <?php echo get_post_meta($post->ID, "article_source", $single = true); ?><?php } ?>
    </div></a></article>