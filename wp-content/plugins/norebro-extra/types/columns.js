!function($){

	function norebroColumnsSerialize( $block ){
		var $hidden_input =  $block.find('.wpb_vc_param_value');
		var serialize_string = '';

		var large = $block.find('.nor-col-large').val();
		var medium = $block.find('.nor-col-medium').val();
		var small = $block.find('.nor-col-small').val();
		var extraSmall = $block.find('.nor-col-extra-small').val();
		
		serialize_string = large + '-' + medium + '-' + small + '-' + extraSmall;

		$hidden_input.val( serialize_string );
	}


	$(document).on( 'change', '.nor-col-large, .nor-col-medium, .nor-col-small, .nor-col-extra-small', function(){
		norebroColumnsSerialize( $(this).closest('.norebro_extra_columns_block') );
	});

}(window.jQuery);