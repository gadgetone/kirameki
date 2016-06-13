<footer id="footer">
	<?php if ( is_active_sidebar('footer-1') ) :
		dynamic_sidebar( 'footer-1' );
		else : ?>
	<div class="widget">
		<h2>ウィジェットなし</h2>
		<p>フッターにウィジェットを追加できます。</p>
	</div>
	<?php endif; ?>
	<div class="footer-copyright">
		<p><?php echo get_footer_copyright(); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>