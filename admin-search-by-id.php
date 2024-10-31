<?php
/*
Plugin Name: Admin Search by ID
Description: Allows search by id in admin by prefixing id with #.  For example, search for #123 returns post id 123.  Original idsearch function written by t31os on the experts-exchange.com forums.
Version: 1.0
Author: BenIrvin
*/

// What character to use to indicate a search by id
// TODO: make this property set in an admin page. since it's just one little thing, add it to "general"?
$ASID_PREFIX = '#';

// check searches for our prefix
function asid_idsearch( $wp ) {
    global $pagenow;
	global $ASID_PREFIX;
	
    // If it's not the post listing return
    if( 'edit.php' != $pagenow ) {
        return;
	}
    // If it's not a search return
    if( !isset( $wp->query_vars['s'] ) ) {
        return;
	}
	
	// If it's a search but there's no prefix, return
	if( $ASID_PREFIX != substr( $wp->query_vars['s'], 0, 1 ) )
		return;
		
	// Validate the numeric value
	$id = absint( substr( $wp->query_vars['s'], 1 ) );
		
	// Return if no ID, absint returns 0 for invalid values
	if( !$id ) {
		return; 
	}
	
	// If we reach here, all criteria is fulfilled, unset search and select by ID instead
	unset( $wp->query_vars['s'] );
	$wp->query_vars['p'] = $id;
}
add_action( 'parse_request', 'asid_idsearch' );


// Rewrite the search query so results page doesn't just display 'Search results for ""'
function asid_search_query($query) {
	global $pagenow;

    // If it's not the post listing return actual query
    if( 'edit.php' != $pagenow ) {
        return $query;
	}
	
	// if we haven't killed our 's', it's a normal search
	$s =  get_query_var( 's' );
	if($s) {
		return $query;
	}
	
	// but if we've made it here AND have a p, we know we're searching by id
	$p = get_query_var( 'p' );
	if($p) {
		global $wp;
		$post_type = get_post_type_object($wp->query_vars['post_type']);
		
		return sprintf(__("[%s with ID of %d]"), $post_type->labels->singular_name, $p);
	}
	
	return $query;
}
add_filter( 'get_search_query', 'asid_search_query' );