<?php 
namespace App\Library;

Class SelectImageHelper {

	public static function GenerateIcon($value, $id, $url) {
		$generate = '<div class="generate_input">
			<input class="form-control" type="text" name="thumbnail" value="'.$value.'" id="'.$id.'" >
			<i class="fa fa-eye" aria-hidden="true" title="" id="preview_image" onmouseover="PreviewImage(\'preview_image\',\''.$id.'\')" ></i>
			<button type="button" class="btn btn-primary" onclick="BrowseServer(\''. $id.'\',\''. $url.' \')">Select</button>
			<span onclick="ResetValue(\''.$id.'\')" >x</span></div>';
		return $generate;
	}
}