<?php $postClass = join( ' ', get_post_class() ); ?>
<div id="post-<?php the_ID(); ?>" class="related-post <?php echo $postClass; ?>"><a href="<?php the_permalink(); ?>">
    <h2 title="<?php the_title(); ?>"><?php the_title(); ?>
    </h2>
    <div class="desc"><?php if ( get_post_meta($post->ID, 'by_line', true) ) {
	echo get_post_meta($post->ID, "by_line", $single = true);
} else {
	the_author_link();
} ?> | <?php the_time('F'); ?>&nbsp;<?php the_time('j'); ?>, <?php the_time('Y'); ?><?php if ( get_post_meta($post->ID, 'article_source', true) ) { ?> | <?php echo get_post_meta($post->ID, "article_source", $single = true);} ?>
    </div></a></div>