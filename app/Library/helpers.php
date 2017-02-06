<?php 
namespace App\Library;

Class SelectImageHelper {

	public static function GenerateIcon($value, $id, $url, $type) {
		$generate = '<div class="generate_input">
			<input class="form-control" type="text" name="'.$type.'" value="'.$value.'" id="'.$id.'" readonly>
			<i class="fa fa-eye" aria-hidden="true" title="" id="preview_image" onmouseover="PreviewImage(\'preview_image\',\''.$id.'\')" ></i>
			<button type="button" class="btn btn-primary" onclick="BrowseServer(\''. $id.'\',\''. $url.' \')">Select</button>
			<span onclick="ResetValue(\''.$id.'\')" >x</span><img class="generate_img" src="" /></div>';
		return $generate;
	}
}