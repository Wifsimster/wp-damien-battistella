<?php get_header(); ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="timeline"></div>
	<div class="buble left">
		<div class="theme">
			<i class="icon-minus-sign icon-white"></i>
		</div>
		<div class="modal-header">
			<h1>Erreur 404</h1>
		</div>
		<div class="modal-body">
			<p>Oups, ceci est une erreur dite 404 ! En termes simples, la page ne peut être trouvée... Je vous invite dès à présent à utiliser les outils de recherche et / ou de navigation pour parvenir au contenu souhaité.</p>
			 <h2>Top 10 des articles</h2>
			 <ul>
			 <?php query_posts("orderby=comment_count&showposts=10&caller_get_posts=1");
			 while (have_posts()) : the_post(); ?>
			 <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','eVid'), get_the_title()) ?>">
			 <?php the_title() ?>
			 </a></li>
			 <?php endwhile; wp_reset_query(); ?>
			 </ul>
			</div>
	</div>
</section>

 <?php get_footer(); ?>
