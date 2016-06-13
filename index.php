<?php get_header(); ?>
<div class="main-wrap">
	<div class="container flexbox">
		<main id="main" role="main">
			<?php if ( have_posts() ) :
				while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="posts-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="meta-top">
						<span class="meta-date"><?php the_time('Y年n月j日'); ?></span>
						<span class="category"><?php the_category(', '); ?></span>
						<?php if ( get_the_tags() ) { ?>
							<span class="tag"><?php the_tags( '',  ', ' ); ?></span>
						<?php } ?>
					</p>
					<a href="<?php the_permalink(); ?>"><?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'large' );
						} ?>
					</a>
					<?php the_content( '続きを読む' ); ?>
				</article>
				<?php endwhile;
			else : ?>
				<div class="post">
					<h2>記事がありません。</h2>
				</div>
			<?php endif; ?>
			<div class="pagenation">
				<?php
					global $wp_query;
					$big = 999999999;
					echo paginate_links( array( 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link($big) ) ), 'format' => '?paged=%#%', 'current' => max( 1, get_query_var('paged') ), 'total' => $wp_query->max_num_pages ) );
				?>
			</div>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
</body>
</html>
