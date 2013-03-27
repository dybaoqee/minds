<?php
/**
 * Sidebar view
 */

$page = elgg_extract('page', $vars);
$image = elgg_extract('image', $vars);
if ($image && $page == 'view') {
	if (elgg_get_plugin_setting('exif', 'tidypics')) {
		echo elgg_view('photos/sidebar/exif', $vars);
	}
	/**
	 * Other photos from owner
	 */
	$owners_photos = elgg_get_entities(array('type'=>'object', 'subtype'=>'image', 'owner_guid'=>$image->owner_guid, 'limit'=>2));
	if (($key = array_search($image, $owners_photos)) !== false) {
	    unset($owners_photos[$key]);
	}
	if(count($owners_photos) > 0){
		$owners_photos = elgg_view_entity_list($owners_photos, array('full_view'=>false, 'sidebar'=>true));
		echo elgg_view_module('aside', elgg_echo('archive:morefromuser:title', array($image->getOwnerEntity()->name)), $owners_photos, array('class'=>'sidebar'));
	}
}

if ($page == 'upload') {
	if (elgg_get_plugin_setting('quota', 'tidypics')) {
		echo elgg_view('photos/sidebar/quota', $vars);
	}
}
echo elgg_view('minds/ads', array('type'=>'content-side'));

$featured = minds_get_featured('image', 3);
$content = elgg_view_entity_list($featured, array('full_view'=>false, 'sidebar'=>true));

echo elgg_view_module('aside', elgg_echo('archive:featured:title'), $content, array('class'=>'sidebar'));