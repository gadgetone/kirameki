<?php get_header(); ?>
<div class="main-wrap">
	<div class="container flexbox">
		<main id="main" role="main">
			<?php if ( have_posts() ) :
				while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
					<header>
						<h1 class="post-title" itemprop="headline"><?php the_title(); ?></h1>
						<p class="meta-top">
							<time class="meta-date" datetime="<?php the_time( 'Y-m-d' ); ?>T<?php the_time( 'H:i:sP' ); ?>" itemprop="datePublished"><?php the_time('Y年n月j日'); ?></time>
							<span class="category" itemprop="genre"><?php the_category(', '); ?></span>
							<?php if ( get_the_tags() ) { ?>
							<span class="tag" itemprop="keywords"><?php the_tags('', ', '); ?></span>
							<?php } ?>
						</p>
						<?php if( is_social_button_visible() ) { ?>
							<div class="social-button-head">
								<div class="sbh-tw">
									<div class="twitter-btn">
										<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
										<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
									</div>
									<div class="twitter-list-btn">
										<span><a href="https://twitter.com/search?q=<?php the_permalink(); ?>" target="_blank">リスト</a></span>
									</div>
								</div>
								<div class="sbh-fb">
									<div class="fb-share-button" data-layout="button_count"></div>
								</div>
								<div class="sbh-hb">
									<a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="standard-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>    
								</div>
							</div>
						<?php } ?>
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'large' );
						} ?>
					</header>
					<div itemprop="articleBody" class="content-main">
						<?php the_content(); ?>
					</div>
					<?php
					$paging_single = array(
						'before'           => '<p>' . ( 'ページ:' ),
						'after'            => '</p>',
						'link_before'      => '',
						'link_after'       => '',
						'next_or_number'   => 'number',
						'separator'        => ' ',
						'nextpagelink'     => ( '次のページ' ),
						'previouspagelink' => ( '前のページ' ),
						'pagelink'         => '%',
						'echo'             => 1
					);
					wp_link_pages($paging_single);
					?>
				</article>
				<div class="nav-previous-next">
					<div class="nav-next">
						<?php if (get_next_post()) : ?>
							<a href="<?php echo get_permalink(get_next_post()->ID); ?>"><p>次の記事<br><?php echo get_the_title(get_next_post()->ID); ?></p></a>
						<?php endif; ?>
					</div>
					<div class="nav-previous">
						<?php if (get_previous_post()) : ?>
							<a href="<?php echo get_permalink(get_previous_post()->ID); ?>"><p>前の記事<br><?php echo get_the_title(get_previous_post()->ID); ?></p></a>
						<?php endif; ?>
					</div>
				</div>
				<?php comments_template(); ?>
				<?php endwhile;
			else : ?>
				<div class="post">
					<h2>記事がありません。</h2>
				</div>
			<?php endif; ?>
		</main>
	<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
</body>
</html>