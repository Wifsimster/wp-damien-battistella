<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
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
					<?php 
					/* Get category post */						
					foreach((get_the_category()) as $category) { 
						echo '<a href="'.get_home_url().'/?cat='.$category->cat_ID.'"><i class="glyphicon glyphicon-'.$category->cat_name.'"></i></a>'; 
					} 
					?>
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
					<!-- Social block -->
					<div class="social hide">
						<span class="facebook">
							<div class="fb-like" data-href="<?php echo get_permalink(get_the_ID()); ?>" data-send="false" data-layout="button_count" 
								data-width="450" data-show-faces="true" data-action="recommend" data-font="arial"></div>
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=418064968229920";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
						</span>
						<span class="twitter">
							<a href="https://twitter.com/share" class="twitter-share-button" data-url=" data-url="<?php echo get_permalink(get_the_ID()); ?>"" data-text="<?php echo get_the_title(get_the_ID()); ?>" data-via="wifsimster" data-lang="fr">Tweeter</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						</span>
						<span class="gplus">
							<div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?php echo get_permalink(get_the_ID()); ?>"></div>
							<script type="text/javascript">
							  window.___gcfg = {lang: 'fr'};
							  (function() {
							    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
							    po.src = 'https://apis.google.com/js/plusone.js';
							    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							  })();
							</script>
						</span>
					</div>
				</div><!-- #modal-header -->
				<div class="modal-img">
					<?php
						if (has_post_thumbnail()) {
							the_post_thumbnail('large');
						} 
					?>
					<div class="tags">
						<?php 
							$tags = wp_get_post_tags($post->ID);
							foreach ($tags as $tag) {
								echo '<span><a href="./?tag='.$tag->name.'" rel="tag">'.$tag->name.'</a></span>';
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

	<?php if (function_exists('get_most_viewed_category') && false): ?>
		<section>
			<div class="timeline"></div>
				<div class="buble left">
					<div class="theme">
						<i class="glyphicon glyphicon-comment"></i>
					</div>
					<div class="modal-header">
						<h3>Articles les plus vus dans cette catégorie</h3>
					</div>
					<div class="modal-body">
					   <ul>
					      <?php get_most_viewed_category(); ?>
					   </ul>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

<?php endwhile; // end of the loop. ?>
