<div id="comment-area">
	<?php if(have_comments()): ?>
		<h3 id="comments">コメント</h3>
		<ol class="comments-list">
			<?php wp_list_comments('avatar_size=55'); ?>
		</ol>
	<?php endif; ?>
</div>
<?php paginate_comments_links(); ?>
<?php $args = array( 'title_reply' => 'コメントする', 'label_submit' => 'コメント送信' );
comment_form($args); ?>