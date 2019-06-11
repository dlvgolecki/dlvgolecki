<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" class="searchform" >
	<div class="input-group">
		<input type="text" name="s" id="s" placeholder="<?php esc_html_e('Search...', 'elston'); ?>" />
		<span class="input-group-btn">
			<input type="submit" id="searchsubmit" value="<?php esc_html_e('Search', 'elston'); ?>" />
		</span>
	</div><!-- /input-group -->
</form><?php
