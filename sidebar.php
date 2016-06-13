<aside id="sidebar">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) :
		dynamic_sidebar( 'sidebar-1' );
	else : ?>
		<div class="widget">
			<h2>ウィジェットなし</h2>
			<p>サイドバーにウィジェットを追加できます。</p>
		</div>
	<?php endif; ?>
</aside>