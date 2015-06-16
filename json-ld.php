<?php
// JSON-LD for Wordpress Home Articles and Author Pages written by Pete Wailes and Richard Baxter
function get_post_data() {
  global $post;
  return $post;
}
 
// stuff for any page
$payload["@context"] = "http://schema.org/";

// this has all the data of the post/page etc
$post_data = get_post_data();
 
// stuff for any page, if it exists
$category = get_the_category();
 
// stuff for specific pages
if (is_single()) {
  // this gets the data for the user who wrote that particular item
  $author_data = get_userdata($post_data->post_author);
  $post_url = get_permalink();
  $post_thumb = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
 
  $payload["@type"] = "Article";
  $payload["url"] = $post_url;
  //$payload["author"] = array(
  //    "@type" => "Person",
  //    "name" => $author_data->display_name,
  //    );
  $payload["headline"] = $post_data->post_title;
  $payload["datePublished"] = $post_data->post_date;
  $payload["dateModified"] = $post_data->post_modified;
  $payload["image"] = $post_thumb;
  $payload["articleSection"] = $category[0]->cat_name;
  $payload["publisher"] = array(
    "@type" => "Organization",
    "name" => "Rally Health",
    "logo" => "https://www.rallyhealth.com/wordpress/wp-content/themes/rally-health-corp-1.5/images/rally-logo-500x500.png",
    "url" => "https://www.rallyhealth.com",
    "sameAs" => array(
      "https://www.facebook.com/RallyHealth",
      "https://www.twitter.com/rally_health",
      "http://www.linkedin.com/company/rally-health",
      "https://plus.google.com/+RallyHealth",
      "https://vimeo.com/rallyhealth",
      "https://instagram.com/rallyhealth",
      "https://www.pinterest.com/RallyHealth/",
      "https://www.youtube.com/rallyhealth"
    ),
    "brand" => array(
      "@type" => "Brand",
      "name" => "Rally",
      "description" => "Rally is a digital health experience that helps you make simple changes in your everyday routine, set goals for yourself, and track your results online.",
      "logo" => "https://www.rallyhealth.com/wordpress/wp-content/themes/rally-health-corp-1.5/images/rally-logo-500x500.png",
      "url" => "https://www.rallyhealth.com"
    ),
    "description" => "Rally Health makes it easy for people to make positive choices, track their fitness goals, and navigate their health benefits."
  );
  $payload["copyrightYear"] = "2015";
  $payload["inLanguage"] = "en_US";
}

// schema for categories
if (is_category()) {
  $cat = get_category( get_query_var( 'cat' ) );
  $cat_id = $cat->cat_ID;
  $cat_url = get_category_link( $cat_id );
  $meta = get_option( 'wpseo_taxonomy_meta' );
  $title = $meta['category'][$cat_id]['wpseo_title'];
  
  $payload["@type"] = "WebPage";
  $payload["url"] = $cat_url;
  $payload["headline"] = $title;
  $payload["publisher"] = array(
    "@type" => "Organization",
    "name" => "Rally Health",
    "logo" => "https://www.rallyhealth.com/wordpress/wp-content/themes/rally-health-corp-1.5/images/rally-logo-500x500.png",
    "url" => "https://www.rallyhealth.com",
    "sameAs" => array(
      "https://www.facebook.com/RallyHealth",
      "https://www.twitter.com/rally_health",
      "http://www.linkedin.com/company/rally-health",
      "https://plus.google.com/+RallyHealth",
      "https://vimeo.com/rallyhealth",
      "https://instagram.com/rallyhealth",
      "https://www.pinterest.com/RallyHealth/",
      "https://www.youtube.com/rallyhealth"
    ),
    "brand" => array(
      "@type" => "Brand",
      "name" => "Rally",
      "description" => "Rally is a digital health experience that helps you make simple changes in your everyday routine, set goals for yourself, and track your results online.",
      "logo" => "https://www.rallyhealth.com/wordpress/wp-content/themes/rally-health-corp-1.5/images/rally-logo-500x500.png",
      "url" => "https://www.rallyhealth.com"
    ),
    "description" => "Rally Health makes it easy for people to make positive choices, track their fitness goals, and navigate their health benefits."
  );
  $payload["copyrightYear"] = "2015";
  $payload["inLanguage"] = "en_US";
}


// stuff for specific pages

// schema for pages
if (is_page()) {
  $post_url = get_permalink();

  $payload["@type"] = "WebPage";
  $payload["datePublished"] = $post_data->post_date;
  $payload["dateModified"] = $post_data->post_modified;
  $payload["url"] = $post_url;
  $payload["headline"] = get_post_meta($post->ID, '_yoast_wpseo_title', true);
  $payload["publisher"] = array(
    "@type" => "Organization",
    "name" => "Rally Health",
    "logo" => "https://www.rallyhealth.com/wordpress/wp-content/themes/rally-health-corp-1.5/images/rally-logo-500x500.png",
    "url" => "https://www.rallyhealth.com",
    "sameAs" => array(
      "https://www.facebook.com/RallyHealth",
      "https://www.twitter.com/rally_health",
      "http://www.linkedin.com/company/rally-health",
      "https://plus.google.com/+RallyHealth",
      "https://vimeo.com/rallyhealth",
      "https://instagram.com/rallyhealth",
      "https://www.pinterest.com/RallyHealth/",
      "https://www.youtube.com/rallyhealth"
    ),
    "brand" => array(
      "@type" => "Brand",
      "name" => "Rally",
      "description" => "Rally is a digital health experience that helps you make simple changes in your everyday routine, set goals for yourself, and track your results online.",
      "logo" => "https://www.rallyhealth.com/wordpress/wp-content/themes/rally-health-corp-1.5/images/rally-logo-500x500.png",
      "url" => "https://www.rallyhealth.com"
    ),
    "description" => "Rally Health makes it easy for people to make positive choices, track their fitness goals, and navigate their health benefits."
  );
  $payload["copyrightYear"] = "2015";
  $payload["inLanguage"] = "en_US";
}

 
// we do all this separately so we keep the right things for organization together
 
if (is_front_page()) {
  $payload["@type"] = "Organization";
  $payload["name"] = "Rally Health";
  $payload["logo"] = "https://www.rallyhealth.com/wordpress/wp-content/themes/rally-health-corp-1.5/images/rally-logo-500x500.png";
  $payload["url"] = "https://www.rallyhealth.com";
  $payload["sameAs"] = array(
    "https://www.facebook.com/RallyHealth",
    "https://www.twitter.com/rally_health",
    "http://www.linkedin.com/company/rally-health",
    "https://plus.google.com/+RallyHealth",
    "https://vimeo.com/rallyhealth",
    "https://instagram.com/rallyhealth",
    "https://www.pinterest.com/RallyHealth/",
    "https://www.youtube.com/rallyhealth"
  );
  $payload["brand"] = array(
    "@type" => "Brand",
    "name" => "Rally",
    "description" => "Rally is a digital health experience that helps you make simple changes in your everyday routine, set goals for yourself, and track your results online.",
    "logo" => "https://www.rallyhealth.com/wordpress/wp-content/themes/rally-health-corp-1.5/images/rally-logo-500x500.png",
    "url" => "https://www.rallyhealth.com"
  );
  $payload["legalName"] = "Rally Health Inc.";
  $payload["description"] = "Rally Health makes it easy for people to make positive choices, track their fitness goals, and navigate their health benefits.";
  $payload["email"] = "info@rallyhealth.com";
  $payload["foundingDate"] = "2010";
}
 
if (is_author()) {
  // this gets the data for the user who wrote that particular item
  $author_data = get_userdata($post_data->post_author);
 
  // some of you may not have all of these data points in your user profiles - delete as appropriate
  // fetch twitter from author meta and concatenate with full twitter URL
  $twitter_url =  " https://twitter.com/";
  $twitterHandle = get_the_author_meta('twitter');
  $twitterHandleURL = $twitter_url . $twitterHandle;
 
  $websiteHandle = get_the_author_meta('url');
 
  $facebookHandle = get_the_author_meta('facebook');
 
  $gplusHandle = get_the_author_meta('googleplus');
 
  $linkedinHandle = get_the_author_meta('linkedin');
 
  $slideshareHandle = get_the_author_meta('slideshare');
 
  $payload["@type"] = "Person";
  $payload["name"] = $author_data->display_name;
  $payload["email"] = $author_data->user_email;
  $payload["sameAs"] =  array(
    $twitterHandleURL, $websiteHandle, $facebookHandle, $gplusHandle, $linkedinHandle, $slideshareHandle
 
      );
  
}
?>
 