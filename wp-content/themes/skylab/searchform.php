<?php
/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<span class="search-icon"></span>
		<input type="text" class="s field" name="s" placeholder="<?php esc_attr_e( 'Search', 'skylab' ) ?>" />
		<input type="submit" class="searchsubmit submit" name="submit" value="<?php esc_attr_e( 'Search', 'skylab' ); ?>" />
		<input type="hidden" name="post_type" value="post" />
	</form>
