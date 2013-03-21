<div class="frame-background">
	<div id="slider" class="nivoSlider">
		<?php 
			//$arrayNews = News::findByCriteria(array(), "updateTime", "DESC", 0, 8);	
		
			/*foreach ($arrayNews as $news)
			{
				echo '<img src="resources/media/covers/'.$news->get('cover').'" alt="'.$news->get('permalink').'">';
			}*/
		?>

		<?php
			foreach (get_posts() as $post) {
				echo get_the_post_thumbnail($post->ID, '1980');
			}
		?>
	</div>
</div>

<script>
	$(window).load(function() {
		$('#slider').nivoSlider({
			effect : 'random', // Specify sets like: 'fold,fade,sliceDown'
			slices : 15, // For slice animations
			boxCols : 8, // For box animations
			boxRows : 4, // For box animations
			animSpeed : 500, // Slide transition speed
			pauseTime : 3000, // How long each slide will show *3000
			startSlide : 0, // Set starting Slide (0 index)
			controlNav : true, // 1,2,3... navigation
			controlNavThumbs : false, // Use thumbnails for Control Nav
			controlNavThumbsFromRel : false, // Use image rel for thumbs
			directionNav: false,
			keyboardNav : true, // Use left & right arrows
			pauseOnHover : true, // Stop animation while hovering
			manualAdvance : false, // Force manual transitions
			captionOpacity : 0, // Universal caption opacity
			randomStart : false, // Start on a random slide
			beforeChange : function() {
			}, // Triggers before a slide transition
			afterChange : function() {
			}, // Triggers after a slide transition
			slideshowEnd : function() {
			}, // Triggers after all slides have been shown
			lastSlide : function() {
			}, // Triggers when last slide is shown
			afterLoad : function() {
			} // Triggers when slider has loaded
		});
	});
</script>