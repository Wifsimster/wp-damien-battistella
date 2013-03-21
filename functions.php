<?php
/**
 * Wifsimster functions and definitions
 *
 * @package WordPress
 * @subpackage Wifsimster
 * @since Wifsimster 0.1
 */
?>

<?php 
// Enable thumbnails
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(1050, auto, true);

/******************************************************
*					Comments style
******************************************************/

function the_bootstrap_comment_reply() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'the_bootstrap_comment_reply' );

function the_bootstrap_comments_closed() {
	if ( ! is_page() AND post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'the-bootstrap' ); ?></p>
	<?php endif;
}
add_action( 'comment_form_comments_closed', 'the_bootstrap_comments_closed' );

function the_bootstrap_comment_form_defaults( $defaults ) {
	return wp_parse_args( array(
		'comment_field'			=>	'<div class="comment-form-comment control-group"><label class="control-label" for="comment">' . _x( 'Comment', 'noun', 'the-bootstrap' ) . '</label><div class="controls"><textarea class="span7" id="comment" name="comment" rows="8" aria-required="true"></textarea></div></div>',
		'comment_notes_before'	=>	'',
		'comment_notes_after'	=>	'<div class="form-allowed-tags control-group"><label class="control-label">' . sprintf( __( 'Tags <abbr title="HyperText Markup Language">HTML</abbr> utilisables %s', 'the-bootstrap' ), '</label><div class="controls"><pre>' . allowed_tags() . '</pre></div>' ) . '</div>
									 <div class="form-actions">',
		'title_reply'			=>	'<legend>' . __( 'Ajouter un commentaire', 'the-bootstrap' ) . '</legend>',
		'title_reply_to'		=>	'<legend>' . __( 'Répondre à %s', 'the-bootstrap' ). '</legend>',
		'must_log_in'			=>	'<div class="must-log-in control-group controls">' . sprintf( __( 'Vous devez être <a href="%s">connecté</a> pour ajouter un commentaire.', 'the-bootstrap' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</div>',
		'logged_in_as'			=>	'<div class="logged-in-as control-group controls">' . sprintf( __( 'Connecté en tant que <a href="%1$s">%2$s</a>. <a href="%3$s" title="Se déconnecter" class="btn btn-small">Se déconnecter</a>', 'the-bootstrap' ), admin_url( 'profile.php' ), wp_get_current_user()->display_name, wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</div>',
	), $defaults );
}
add_filter( 'comment_form_defaults', 'the_bootstrap_comment_form_defaults' );

if ( ! function_exists( 'the_bootstrap_comment' ) ) :
function the_bootstrap_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if ( 'pingback' == $comment->comment_type OR 'trackback' == $comment->comment_type ) : ?>
	
		<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<p class="row">
				<strong class="ping-label span1"><?php _e( 'Pingback:', 'the-bootstrap' ); ?></strong>
				<span class="span7"><?php comment_author_link(); edit_comment_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?></span>
			</p>
	
	<?php else:
		$offset	=	$depth - 1;
		$span	=	7 - $offset; ?>
		
		<li  id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="comment row">
				<div class="comment-author-avatar span1<?php if ($offset) echo " offset{$offset}"; ?>">
					<?php echo get_avatar( $comment, 70 ); ?>
				</div>
				<footer class="comment-meta span<?php echo $span; ?>">
					<p class="comment-author vcard">
						<?php
							/* translators: 1: comment author, 2: date and time */
							printf( __( '%1$s <span class="says">said</span> on %2$s:', 'the-bootstrap' ),
								sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
								sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( __( '%1$s at %2$s', 'the-bootstrap' ), get_comment_date(), get_comment_time() )
								)
							);
							edit_comment_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?>
					</p><!-- .comment-author .vcard -->
	
					<?php if ( ! $comment->comment_approved ) : ?>
					<div class="comment-awaiting-moderation alert alert-info"><em><?php _e( 'Your comment is awaiting moderation.', 'the-bootstrap' ); ?></em></div>
					<?php endif; ?>
	
				</footer><!-- .comment-meta -->
	
				<div class="comment-content span<?php echo $span; ?>">
					<?php
					comment_text();
					comment_reply_link( array_merge( $args, array(
						'reply_text'	=>	__( 'Reply <span>&darr;</span>', 'the-bootstrap' ),
						'depth'			=>	$depth,
						'max_depth'		=>	$args['max_depth']
					) ) ); ?>
				</div><!-- .comment-content -->
			</article><!-- #comment-<?php comment_ID(); ?> .comment -->
			
	<?php endif; // comment_type
}
endif; // ends check for the_bootstrap_comment()

function the_bootstrap_comment_form_top() {
	echo '<div class="form-horizontal">';
}
add_action( 'comment_form_top', 'the_bootstrap_comment_form_top' );

function the_bootstrap_comment_form() {
	echo '</div></div>';
}
add_action( 'comment_form', 'the_bootstrap_comment_form' );

function the_bootstrap_comment_form_field_author( $html ) {
	$commenter	=	wp_get_current_commenter();
	$req		=	get_option( 'require_name_email' );
	$aria_req	=	( $req ? " aria-required='true'" : '' );
	
	return	'<div class="comment-form-author control-group">
				<label for="author" class="control-label">' . __( 'Name', 'the-bootstrap' ) . '</label>
				<div class="controls">
					<input id="author" name="author" type="text" value="' . esc_attr(  $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
					' . ( $req ? '<p class="help-inline"><span class="required">' . __('required', 'the-bootstrap') . '</span></p>' : '' ) . '
				</div>
			</div>';
}
add_filter( 'comment_form_field_author', 'the_bootstrap_comment_form_field_author');

function the_bootstrap_comment_form_field_email( $html ) {
	$commenter	=	wp_get_current_commenter();
	$req		=	get_option( 'require_name_email' );
	$aria_req	=	( $req ? " aria-required='true'" : '' );
	
	return	'<div class="comment-form-email control-group">
				<label for="email" class="control-label">' . __( 'Email', 'the-bootstrap' ) . '</label>
				<div class="controls">
					<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
					<p class="help-inline">' . ( $req ? '<span class="required">' . __('required', 'the-bootstrap') . '</span>, ' : '' ) . __( 'will not be published', 'the-bootstrap' ) . '</p>
				</div>
			</div>';
}
add_filter( 'comment_form_field_email', 'the_bootstrap_comment_form_field_email');

function the_bootstrap_comment_form_field_url( $html ) {
	$commenter	=	wp_get_current_commenter();
	
	return	'<div class="comment-form-url control-group">
				<label for="url" class="control-label">' . __( 'Website', 'the-bootstrap' ) . '</label>
				<div class="controls">
					<input id="url" name="url" type="url" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" />
				</div>
			</div>';
}
add_filter( 'comment_form_field_url', 'the_bootstrap_comment_form_field_url');

?>