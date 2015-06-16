<?php get_header(); ?>
<section class="news-content content-container">
  <div class="container clearfix">
    <div id="ajax-news-loader"><?php if( have_posts() ) :
while ( have_posts() ) : the_post();
	get_template_part( 'article-list-news');
endwhile; ?>
      <div class="page-nav"><?php previous_post_link('previous'); ?>
        <div class="next"><?php next_posts_link('next'); ?>
        </div>
      </div>
    </div>
  </div><?php else:
endif;
 ?>
</section><?php get_footer(); ?>