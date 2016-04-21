<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Wifsimster
 * @since Wifsimster 0.1
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="timeline"></div>
  <div class="buble left">
    <div class="theme">
      <i class="glyphicon glyphicon-user"></i>
    </div>
    <div class="modal-header">
      <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Lien permanent vers "%s"'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
          <?php the_title(); ?>
        </a>
        <?php edit_post_link('<i class="glyphicon glyphicon-edit"></i>', '<span class="pull-right">', '</span>'); ?>
      </h2>						
      <small>
        Par <?php echo get_the_author(); ?>
        - Le <?php echo the_date( $format, $before, $after, $echo ); ?>
      </small>
    </div><!-- #modal-header -->
    <div class="modal-img">
      <?php
      if (has_post_thumbnail()) {
        the_post_thumbnail(array('1050', 'auto'));
      } 
      ?>
      <div class="tags">
        <?php 
        $tags = wp_get_post_tags($post->ID);
        foreach ($tags as $tag) {
          echo '<span><a href="./?tag='.$tag->name.'" class="transition" rel="tag">'.$tag->name.'</a></span>';
        }
        ?>
      </div><!-- #tags -->
    </div><!-- #modal-img -->
    <div class="modal-body">						
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
      <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
    </div><!-- #modal-body -->
    <div class="modal-footer">

    </div><!-- #modal-footer -->
  </div><!-- #bubble-left -->
</section><!-- #post-## -->

<?php get_template_part( 'content', 'single' ); ?>

<section>
  <div class="timeline"></div>
  <div class="buble left">
    <div class="theme">
      <i class="glyphicon glyphicon-comment"></i>
    </div>
    <?php comments_template( '', true ); ?>
  </div>
  </div>
</section>

<?php endwhile; // end of the loop. ?>
