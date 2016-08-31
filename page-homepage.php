<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
	<?php if ( is_active_sidebar( 'searchfilter' ) ) : ?>

	<?php dynamic_sidebar( 'searchfilter' ); ?>

<?php endif; ?>		
<!--- Home One-->		
<div class="home-one"><div class="container"><div class="inner-blocklarg"><?php //if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home1') ) : endif; ?>
<h1 class="tittle-h1">Top Products</h1>			
<div class="row products-rowblock">			
<?php
$args = array(
'post_type' => 'product',
'posts_per_page' => 9,
'meta_key' => '_wc_average_rating',
'orderby' => 'meta_value_num',
);
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) {
while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php //woocommerce_get_template_part( 'content', 'product' ); ?>
<div class="col-sm-4 products-thirdhalf">    
<div class="productsimg">
<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="65px" height="115px" />'; ?>


<div class="hover-producspopup">
<div class="innerhover-producspopup">
<div class="inlineinner-block">
<ul class="link-ulproducts">
<li class="add-cart-li">
<a id="id-<?php the_id(); ?>" class="button add_to_cart_button" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Add to cart</a>
<?php //woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?></li>
<li><a href="#myModal" class="poplink-block btnlink-lightbox" data-toggle="modal" data-target="#myModal-<?php the_id(); ?>"><i aria-hidden="true" class="fa fa-eye"></i></a></li>
<li><a class="poplink-block link-hearticon" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a></li>
</ul>
<div class="bottom-hoverpop">
<a id="id-<?php the_id(); ?>" class="view-productsbtn" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">View</a>
</div>
<div class="woocommerce product-rating">
<div class="innerproduct-rating">
<?php if ( $rating_html = $product->get_rating_html() ) { ?>
	<?php echo $rating_html; ?>
<?php } else {
echo '<div class="star-rating" title="Rated 5.00 out of 5"></div>' ;
}?>
	</div></div>
</div>
</div>
</div>

</div>
<a id="id-<?php the_id(); ?>" class="tittle-price" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
<h3><?php the_title(); ?></h3>

<span class="price"><?php echo $product->get_price_html(); ?></span>
</a>

<!--POP UP-->
<div class="modal fade" id="myModal-<?php the_id(); ?>" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<button type="button" class="close popup-close" data-dismiss="modal"><i aria-hidden="true" class="fa fa-close"></i></button>
<div class="modal-body">
<?php global $post, $woocommerce, $product; ?>
<div id="wpb_wl_quick_view_<?php echo get_the_id(); ?>" class="mfp-hide mfp-with-anim wpb_wl_quick_view_content wpb_wl_clearfix">
		<div class="wpb_wl_images">
			<?php
				if ( has_post_thumbnail() ) {

				$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
				$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title' => $image_title
					) );

				$attachment_count = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

				} else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce-lightbox' ) ), $post->ID );

				}
			?>
		</div>
		<div class="wpb_wl_summary">
			<!-- Product Title -->
			<h2 class="wpb_wl_product_title"><?php the_title();?></h2>

			<!-- Product Price -->
			<?php if ( $price_html = $product->get_price_html() ) : ?>
				<span class="price wpb_wl_product_price"><?php echo $price_html; ?></span>
			<?php endif; ?>

			<!-- Product short description -->
			<?php woocommerce_template_single_excerpt();?>

			<!-- Product cart link -->
			<?php woocommerce_template_single_add_to_cart();?>

		</div>
	</div>
</div>
</div>
</div>
</div>
<!--End POP UP-->


</div>
<?php 
endwhile;
} else {
echo __( 'No products found' );
}
wp_reset_query();
?> 
</div>		
			
</div></div></div>
<!--- End Home One-->
			
		
		
<!--- NEW Products-->		
<div class="new-products"><div class="container"><div class="inner-blocklarg"><?php //if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home1') ) : endif; ?>
<h1 class="tittle-h1">New Products</h1>			
<div class="row products-rowblock">			
<?php
/* $args = array(
'post_type' => 'product',
'posts_per_page' => 9,
'meta_key' => '_wc_average_rating',
'orderby' => 'meta_value_num',
); */
$args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 9, 'orderby' =>'date','order' => 'DESC' );
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) {
while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php //woocommerce_get_template_part( 'content', 'product' ); ?>
<div class="col-sm-4 products-thirdhalf">    
<div class="productsimg">
<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="65px" height="115px" />'; ?>


<div class="hover-producspopup">
<div class="innerhover-producspopup">
<div class="inlineinner-block">
<ul class="link-ulproducts">
<li class="add-cart-li">
<a id="id-<?php the_id(); ?>" class="button add_to_cart_button" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Add to cart</a>
<?php //woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?></li>
<li><a href="#myModal" class="poplink-block btnlink-lightbox" data-toggle="modal" data-target="#myModal-<?php the_id(); ?>"><i aria-hidden="true" class="fa fa-eye"></i></a></li>
<li><a class="poplink-block link-hearticon" href="#"><i aria-hidden="true" class="fa fa-heart"></i></a></li>
</ul>
<div class="bottom-hoverpop">
<a id="id-<?php the_id(); ?>" class="view-productsbtn" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">View</a>
</div>
<div class="woocommerce product-rating">
<div class="innerproduct-rating">
<?php if ( $rating_html = $product->get_rating_html() ) { ?>
	<?php echo $rating_html; ?>
<?php } else {
echo '<div class="star-rating" title="Rated 5.00 out of 5"></div>' ;
}?>
	</div></div>
</div>
</div>
</div>

</div>
<a id="id-<?php the_id(); ?>" class="tittle-price" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
<h3><?php the_title(); ?></h3>

<span class="price"><?php echo $product->get_price_html(); ?></span>
</a>

<!--POP UP-->
<div class="modal fade" id="myModal-<?php the_id(); ?>" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<button type="button" class="close popup-close" data-dismiss="modal"><i aria-hidden="true" class="fa fa-close"></i></button>
<div class="modal-body">
<?php global $post, $woocommerce, $product; ?>
<div id="wpb_wl_quick_view_<?php echo get_the_id(); ?>" class="mfp-hide mfp-with-anim wpb_wl_quick_view_content wpb_wl_clearfix">
		<div class="wpb_wl_images">
			<?php
				if ( has_post_thumbnail() ) {

				$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
				$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title' => $image_title
					) );

				$attachment_count = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

				} else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce-lightbox' ) ), $post->ID );

				}
			?>
		</div>
		<div class="wpb_wl_summary">
			<!-- Product Title -->
			<h2 class="wpb_wl_product_title"><?php the_title();?></h2>

			<!-- Product Price -->
			<?php if ( $price_html = $product->get_price_html() ) : ?>
				<span class="price wpb_wl_product_price"><?php echo $price_html; ?></span>
			<?php endif; ?>

			<!-- Product short description -->
			<?php woocommerce_template_single_excerpt();?>

			<!-- Product cart link -->
			<?php woocommerce_template_single_add_to_cart();?>

		</div>
	</div>
</div>
</div>
</div>
</div>
<!--End POP UP-->


</div>
<?php 
endwhile;
} else {
echo __( 'No products found' );
}
wp_reset_query();
?> 
</div>		
			
</div></div></div>
<!--- End NEW Products-->
			
			<!--- Home Two-->
			<div class="home-two"><div class="container"><div class="inner-blocklarg"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home2') ) : endif; ?></div></div></div>
			<!--- End Home Two-->
		<div class="container">
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<section class="row post_content">
						
							<div class="col-lg-12">
						
								<?php the_content(); ?>
								
							</div>
							
							<?php //get_sidebar('sidebar2'); // sidebar 2 ?>
													
						</section> <!-- end article header -->
						
						<footer>
			
							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","wpbootstrap") . ': ', ', ', '</span>'); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php 
						// No comments on homepage
						//comments_template();
					?>
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->
			</div> <!-- end #container -->

<?php get_footer(); ?>