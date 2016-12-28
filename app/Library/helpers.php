<?php 
namespace App\Library;

Class SelectImageHelper {

	public static function GenerateIcon($id, $url) {
		$generate = '<i class="fa fa-eye" aria-hidden="true" title="" id="preview_image" onmouseover="PreviewImage(\'preview_image\',\''.$id.'\')"></i>
		<button type="button" class="btn btn-primary" onclick="BrowseServer(\''. $id.'\',\''. $url.' \')">Select</button>
		<span onclick="ResetValue(\''.$id.'\')">x</span>';
		return $generate;
	}
}