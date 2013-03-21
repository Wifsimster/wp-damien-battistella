<?php
/**
 * @package WordPress
 * @subpackage Wifsimster
 * @since Wifsimster 0.1
 */

get_header();
?>

<?php if ( have_posts() ) : ?>
	<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="timeline"></div>
		<div class="buble left" style="max-width: 1050px;">
			<div class="theme">
				<i class="icon-search icon-white"></i>
			</div>
			<div class="modal-header">
				<h2 class="page-title">
					<?php printf(__('Résultats de votre recherche : %s'), '<span>' . get_search_query() . '</span>'); ?>
				</h2>
			</div>
			<div class="modal-img">
				<?php
					global $wp_query;
					$total_results = $wp_query->found_posts;					
					echo '<div style="background-color:#E6E6E6; padding: 8px 20px; margin: 0 0 10px 0; font-size: 16px;"><strong>' . $total_results .'</strong> résultat(s) trouvé(s)</div>';
				?>
			</div>
		</div>
	</section>
		<?php while(have_posts()) : the_post(); ?>
		<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="timeline"></div>
			<div class="buble left">
				<div class="theme">
					<?php 
					/* Get category post */						
					foreach((get_the_category()) as $category) { 
						echo '<a href="'.get_home_url().'/?cat='.$category->cat_ID.'"><i class="icon-'.$category->cat_name.' icon-white"></i></a>'; 
					} 
					?>
				</div>
				<div class="modal-header">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Lien permanent vers "%s"'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
						<?php edit_post_link('<i class="icon-edit"></i>', '<span class="pull-right">', '</span>'); ?>
					</h2>						
					<small>
						Par <?php echo get_the_author(); ?>
						- Le <?php echo the_time(get_option('date_format')); ?>
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
							the_post_thumbnail(array('1050', 'auto'));
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
					<?php the_excerpt(); ?>
				</div><!-- #modal-body -->
				<div class="modal-footer">
					<div class="nbComments">
						<?php comments_number('Aucun commentaire', '1 commentaire', '% commentaires');	?>
					</div>
					<a href="<?php echo get_home_url(); ?>/?p=<?php the_ID(); ?>" class="btn pull-right">Lire la suite</a>
				</div><!-- #modal-footer -->
			</div><!-- #bubble-left -->
		</section><!-- #post-## -->

	<?php comments_template( '', true ); ?>
<?php endwhile; // End the loop. Whew. ?>
<?php else : ?>
	<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="timeline"></div>
		<div class="buble left" style="max-width: 1050px;">
			<div class="theme">
				<i class="icon-search icon-white"></i>
			</div>
			<div class="modal-header">
				<h2 class="entry-title"><?php _e('Aucun résultat !'); ?></h2>
			</div>			
			<div class="modal-body">
				<p><?php _e('Désolé, aucun résultat trouvé pour votre recherche !'); ?></p>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>
