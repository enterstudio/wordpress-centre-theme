<?php

/**
 * @package uncode
 */

global $wp_query;
$vars = $wp_query->query_vars; 

//get category info
$category = get_the_category();
$category_name = $category[0]->cat_name;
$category_class = strtolower(str_replace(' ','',$category_name));

//get post id
$post_id = get_the_ID();

// if ( has_post_thumbnail() ) {
// 	$featured_image = get_the_post_thumbnail();
// }

//get link based on post format
$custom_post = uncode_custom_just_post( $post_id );
$post_format = get_post_format( $post_id );
$the_link = ($post_format==='link') ? get_url_in_content( $custom_post ) : get_the_permalink();

//get first image in post
$item_media = catch_that_image($post_id);

//format post media
$post_media = ($category_name==='Video' || $category_name==='Slideshow') ? $custom_post : '<div class="img-container"><img src="' . $item_media . '" /></div>';

//get author
$author = get_the_author();
?>

<div class='col-lg-4 content-block'>
	<div class='content-block--inner <?= $category_class ?>'>
		<div class='category-tag'><?= $category_name ?></div>
		<a href='<?= $the_link ?>'><?= $post_media ?></a>
	</div>
	<div class='content-block--content dark'>
		<h6><?= $category_name ?></h6>
		<?php if ($category_name!=='Video') { ?>
			<a href='<?= $the_link ?>' class='<?= $category_class ?>-title'>
		<?php } ?>
			<p><span class='label'><?= the_title(); ?></span></p>
		<?php if ($category_name!=='Video') { ?>
			</a>
		<?php } ?>
		<span class='source'>by <?= $author ?></span>
	</div>
</div>