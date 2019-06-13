<?php
/**
 * The social icon template of the theme.
 *
 * @package klean
 */
?>
<?php if ( get_theme_mod( 'social' ) == true ) { ?>

    <div id="social-icons" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">


        <?php for ($i = 1; $i < 8; $i++) :
            $social = esc_html(get_theme_mod('klean_social_'.$i));
            if ( ($social != 'none') && ($social != '') ) : ?>
                <a target="_blank" href="<?php echo get_theme_mod('klean_social_url'.$i); ?>">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-<?php echo $social; ?> fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
            <?php endif;
        endfor;
        ?>

    </div>

<?php } ?>
