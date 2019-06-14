<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class XforWC_Product_Filters_Get_Theme {

	public static function ___get_compatibles() {
		return array(
			'shopkit', 'storefront', 'twentytwelve', 'twentythirteen', 'twentyfourteen', 'twentyfifteen', 'twentysixteen', 'twentyseventeen', 'twentynineteen', 'rehub', 'avada', 'atelier', 'Divi', 'salient', 'porto', 'astra', 'impreza', 'thegem', 'camelia'
		);
	}

	public static function get_theme_ajax() {

		$ajax = self::___options_default();

		$ajax['name'] = wp_get_theme()->get( 'Name' );
		$ajax['template'] = sanitize_title( strtolower( get_template() ) );

		if ( in_array( $ajax['template'], self::___get_compatibles() ) ) {
			$ajax['recognized'] = true;
			return $ajax;
		}

		if ( method_exists( 'XforWC_Product_Filters_Get_Theme', '__options_for_' . $ajax['template'] ) ) {
			$themeAjax = call_user_func( 'XforWC_Product_Filters_Get_Theme::__options_for_' . $ajax['template'] );
			if ( !empty( $themeAjax ) ) {
				$ajax = array_merge( $ajax, $themeAjax );
				$themeAjax['recognized'] = true;
			}
		}

		return $ajax;
	}

	public static function __options_for_enfold() {
		return array(
			'pagination' => '.pagination',
			'pagination_function' => 'avia_pagination',
		);
	}

	public static function __options_for_flatsome() {
		return array(
			'pagination' => '.products + .container',
		);
	}

	public static function __options_for_shopkeeper() {
		return array(
			'product' => 'li',
		);
	}

	public static function __options_for_betheme() {
		return array(
			'wrapper' => '.products_wrapper',
			'pagination' => '.pager_wrapper',
		);
	}

	public static function __options_for_legenda() {
		return array(
			'wrapper' => '.product-loop',
		);
	}

	public static function __options_for_x() {
		return array(
			'pagination' => '.pagination',
		);
	}

	public static function __options_for_kallyas() {
		return array(
			'pagination' => '.pagination--light',
			'pagination_function' => 'zn_woocommerce_pagination',
		);
	}

	public static function __options_for_mediacenter() {
		return array(
			'js' => 'function setConformingHeight(a,b){a.data("originalHeight",void 0==a.data("originalHeight")?a.height():a.data("originalHeight")),a.height(b)}function getOriginalHeight(a){return void 0==a.data("originalHeight")?a.height():a.data("originalHeight")}function columnConform(){$(".products > .product").each(function(){var a=$(this);if(a.is(":visible")){var b=a.position().top;if(currentRowStart!=b){for(var c=0;c<rowDivs.length;c++)setConformingHeight(rowDivs[c],currentTallest);rowDivs.length=0,currentRowStart=b,currentTallest=getOriginalHeight(a),rowDivs.push(a)}else rowDivs.push(a),currentTallest=currentTallest<getOriginalHeight(a)?getOriginalHeight(a):currentTallest;for(var c=0;c<rowDivs.length;c++)setConformingHeight(rowDivs[c],currentTallest)}})}var currentTallest=0,currentRowStart=0,rowDivs=new Array;columnConform();',
		);
	}

	public static function __options_for_jupiter() {
		return array(
			'js' => '$("section.products article .product-loop-thumb img").each( function(){$(this).attr("src", $.parseJSON($(this).attr("data-mk-image-src-set")).default);});',
		);
	}

	public static function __options_for_royal() {
		return array(
			'wrapper' => '.products-loop',
			'product' => '.product',
		);
	}

	public static function ___options_default() {
		return array(
			'wrapper' => '.products',
			'category' => '.product-category',
			'product' => '.type-product',
			'result_count' => '.woocommerce-result-count',
			'order_by' => '.woocommerce-ordering',
			'pagination' => '.woocommerce-pagination',
		);
	}

}