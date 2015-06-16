<?php get_header(); ?>
<section id="home" class="home panel">
  <div class="home-promo"><a href="/kevinhart/" title="Learn More about Kevin Hart and Rally Health" alt="Rally Health + Kevin Hart What Now Sweepstakes" class="kh-banner"></a></div>
  <div class="content-container">
    <div class="main-image"><img src="<?php bloginfo('template_url'); ?>/images/solutions-all.png"/></div>
    <div class="main-content">
      <h1>Rally<sup>SM</sup></h1>
      <p>Managing your health just got a whole lot easier.</p><a href="/our-product/" class="button">Learn More</a>
    </div>
    <div class="link-more home"><a href="#articles" class="scroll">
        <div class="arrow"></div></a></div>
  </div>
</section>
<section id="articles">
  <div class="content-container">
    <div class="container clearfix">
      <!-- list of new articles-->
      <div class="articles-list">
        <h2 class="title-latest"><strong>Featured Articles</strong></h2><?php $exclude_ID1 = get_category_id('rally news');
query_posts("cat=-$exclude_ID1");

if(have_posts()) while (have_posts()) : the_post();
get_template_part('article-list-items');

endwhile;

wp_reset_query(); ?><a href="/articles/" class="read-more">More Articles</a>
      </div>
      <div class="news-list">
        <h3 class="title-side-list"><strong>Rally News</strong></h3><?php query_posts(array(
		'category_name' => 'news',
		'posts_per_page' => 6
	));

if(have_posts()) while (have_posts()) : the_post();
get_template_part('side-list-items');

endwhile;

wp_reset_query(); ?><a href="/topics/news/" class="read-more">More News</a>
      </div>
    </div>
  </div>
</section><?php get_footer(); ?>