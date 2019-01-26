<?php 

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sina_get_portfolio_cat( $portfolio ) {
	$category_in = [];

	foreach ( $portfolio as $item ) {
		if ( $item['category'] ) {
			$cat_explode = explode( ',', $item['category'] );

			foreach ( $cat_explode as $name ) {
				$category = strtolower( str_replace( ' ', '_', $name ) );

				if ( !in_array($category, $category_in) ) {
					$category_in[] = $category;
				}
			}
		}
	}

	return $category_in;
}

function sina_get_user_roles() {
	$users = count_users();

	$roles = [];
	if ( ! empty( $users ) ){
		foreach ( $users['avail_roles'] as $key => $user ) {
			$roles[ $key ] = $key;
		}
	}

	return $roles;
}

function sina_get_categories(){
	$terms = get_terms( [ 
		'taxonomy' => 'category',
		'hide_empty' => true,
	] );

	$options = [];
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		foreach ( $terms as $term ) {
			$options[ $term->term_id ] = $term->name;
		}
	}

	return $options;
}

function sina_get_page_templates(){
	$page_templates = get_posts( [
		'post_type'         => 'elementor_library',
		'posts_per_page'    => -1
	] );

	$options = [];

	if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
		foreach ( $page_templates as $template ) {
			$options[ $template->ID ] = $template->post_title;
		}
	}
	return $options;
}