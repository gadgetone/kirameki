<?php get_header(); ?>
<div class="container flexbox">
	<main id="main" role="main">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="post-title"><?php the_title(); ?></h1>
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'large' );
				} ?>
				<?php the_content(); ?>
			</article>
			<?php endwhile;
		else : ?>
			<div class="post">
				<h2>記事がありません。</h2>
			</div>
		<?php endif; ?>
	</main>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
</body>
</html>