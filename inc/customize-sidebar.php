<?php
/**
 * The template for customizing sidebars
 *
 * @package WordPress
 * @link http://www.revuehistoriquedepondichery.org/demo/
 * @subpackage journal window
 * @since journal Window 1.0
 */

function journal_get_sidebar_slug() {
	global $journal_sidebar_slug;
	if( isset($journal_sidebar_slug) )
		return $journal_sidebar_slug;
}