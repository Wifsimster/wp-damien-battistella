<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Wifsimster
 * @since Wifsimster 0.1
 */
?>


<footer>
	<div id="footer-center">
		© Wifsimster 2012 - <?php echo date("Y"); ?>
	</div>
	<div id="horizontal-line"></div>
</footer>

	</div><!-- #pageContent -->
</div><!-- #container -->

<?php
	wp_footer();
?>
</body>
</html>
