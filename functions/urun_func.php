<?php

function getProduct( $Cat = null ) {

	global $db;

	if ( $Cat == null ) {
		$Products = $db->from( 'product' )->all();
	} elseif ( is_array( $Cat ) ) {
		$Products = $db->from( 'product' )->in( 'cat', $Cat )->all();
	} else {
		$Products = $db->from( 'product' )->where( 'cat', $Cat )->all();
	}
	$return = array();
	$i      = 0;
	foreach ( $Products as $Product ) {
		$return[ $i ] = $Product;
		$Metas        = getProductMeta( $Product['id'] );
		foreach ( $Metas as $meta ) {
			$return[ $i ][ $meta['meta'] ] = $meta['value'];
		}
		$Currency                      = currencyMeta( $Product['currency'] );
		$return[ $i ]['priceWithIcon'] = $Product['price'] . ' ' . $Currency['icon'];
		$return[ $i ]['priceWithName'] = $Product['price'] . ' ' . $Currency['name'];
		$return[ $i ]['priceWithName'] = $Product['price'] . ' ' . $Currency['name'];
		$i ++;
	}

	return $return;
}

function getProductMeta( $ProductID ) {
	global $db;
	$Products = $db->from( 'productMeta' )->where( 'product', $ProductID )->all();

	return $Products;
}

function getProductCatMeta( $ProductCatID, $meta = null ) {
	global $db;
	if ( $meta == null ) {
		$return   = array();
		$Products = $db->from( 'productCatMeta' )->where( 'productCat', $ProductCatID )->all();

		foreach ( $Products as $product ) {
			$return[ $product['meta'] ] = $product['value'];
		}

		return $return;
	} else {
		$Products = $db->from( 'productCatMeta' )->where( 'productCat', $ProductCatID )->where( 'meta', $meta )->first();

		return $Products['value'];
	}


}

function currencyMeta( $CurrencyID ) {
	global $db;

	return $db->from( 'currency' )->where( 'id', $CurrencyID )->first();


}
