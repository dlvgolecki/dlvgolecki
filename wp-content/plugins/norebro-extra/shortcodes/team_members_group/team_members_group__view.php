<?php

/**
* Visual Composer Norebro Team Members Group shortcode view
*/

?>
<div class="norebro-team-members-group-sc team-member cover <?php echo 'column-' . preg_match_all('/norebro_team_member_inner/i', $content, $matches); ?><?php echo $css_class; ?>" 
	data-norebro-cover-box="true"
	id="<?php echo $team_group_uniqid; ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

	<?php echo do_shortcode( $content ); ?>

</div>