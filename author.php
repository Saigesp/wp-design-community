<?php get_header(); ?> 


<?php 
  $pagec = $_GET['pag'] == '' ? '1' : $_GET['pag'];
  $post_per_page = get_option( 'posts_per_page', '10' );
  $term_slug = get_query_var( 'author' );
  $user_info = get_userdata($term_slug);
?>

<?php
  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'author' => $term_slug,
  );
  $post_count_query = new wp_query( $args );
  $post_count = $post_count_query->found_posts;
  $total_post = $post_count ? count($post_count) : 1;
  $total_pages = 1;
  $offset = $post_per_page * ($pagec - 1);
  $total_pages = ceil($total_post / $post_per_page);
  $args = array( 
    'order' => 'DESC',
    'posts_per_page' => $post_per_page,
    'offset'    => $offset,
    'author' => $term_slug,
  );
  $wp_query = new wp_query( $args );
?>

<div class="contentauthorarticlefoot contentauthorauthor">
  <hr class="separatorauthor separatorauthorup">
  <figure class="authorimagefoot authorbuble" style="background-color: #666;">
    <img src="<?php echo get_wp_user_avatar_src($term_slug, 100, 'medium'); ?>"/>
  </figure>
  <p class="authorarticlefoot">
    <a href="<?php echo get_author_posts_url( $term_slug ); ?>">
      <?php the_author(); ?>
    </a>
    <br>
    <?php echo get_user_meta($term_slug,position,true);?>
    <br>
    <?php if(get_user_meta($term_slug,twitter,true) != '') { ?>
    <a href="<?php echo 'https://twitter.com/'.get_user_meta($term_slug,twitter,true);?>">
      <?php the_svg_icon('twitter');?>
    </a>
    <?php } ?>
    <?php if(get_user_meta($term_slug,googleplus,true) != '') { ?>
    <a rel="author" href="<?php echo get_user_meta($term_slug,googleplus,true);?>">
      <?php the_svg_icon('gplus');?>
    </a>
    <?php } ?>
    <?php if(get_user_meta($term_slug,linkedin,true) != '') { ?>
    <a href="<?php echo get_user_meta($term_slug,linkedin,true);?>">
      <?php the_svg_icon('linkedin');?>
    </a>
    <?php } ?>
  </p>
  <p class="description"><?php echo $user_info->description;?></p>
  <hr class="separatorauthor separatorauthordown">
</div>

<div id="divwrap" class="wraparch index iascontainer customtax">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php include( locate_template(  'loop-archive.php' )); ?>
    <?php endwhile; ?>
  <?php else : ?>
  <?php endif; ?>

  <div class="navigation">
    <?php
    $base = get_bloginfo( 'url' ). '%_%';
    echo paginate_links( array(
      'base' => $base,
      'total' => $wp_query->max_num_pages,
      'format'   => '?pag=%#%',
      'current'  => $pagec,
    ) );
    ?>
  </div>
</div>
<?php get_footer(); ?>