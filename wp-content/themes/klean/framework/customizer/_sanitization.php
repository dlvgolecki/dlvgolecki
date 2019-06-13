<?php
//All sanitize Functions are declared here
function klean_sanitize_checkbox( $i ) {
    if ( $i == 1 ) {
        return 1;
    }
    else {
        return '';
    }
}

function klean_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}