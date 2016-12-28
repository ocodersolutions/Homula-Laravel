<?php 
namespace App\Library;

Class SelectImageHelper {

	public static function GenerateIcon($value, $id, $url) {
		$generate = '<div class="generate_input" style="position: relative;">
			<input class="form-control" type="text" name="thumbnail" value="'.$value.'" id="'.$id.'" style="padding: 0 122px 0 45px;">
			<i class="fa fa-eye" aria-hidden="true" title="" id="preview_image" onmouseover="PreviewImage(\'preview_image\',\''.$id.'\')" style="position: absolute;top: 0;font-size: 20px;line-height: 32px;padding: 0 10px;background: #eeeeee; border: 1px solid #cccccc; cursor: pointer;"></i>
			<button type="button" class="btn btn-primary" onclick="BrowseServer(\''. $id.'\',\''. $url.' \')" style="position: absolute; top: 0; right: 55px; border-radius: 0; background: #f2f2f2; border: 1px solid #cccccc; color: black;">Select</button>
			<span onclick="ResetValue(\''.$id.'\')" style="display: inline-block; position: absolute; top: 0; right: 0; line-height: 32px; font-size: 25px; font-weight: bold; padding: 0px 20px; cursor: pointer; background: #f2f2f2;    border: 1px solid #cccccc; color: #000;">x</span></div>';
		return $generate;
	}
}