<?php

namespace jCube\Http\Controllers;

class SiteController extends Controller
{
	public function placeholderImage($size = '100x100', $bg = null, $color = null, $text = null)
	{
		try {
			$arr = [$size, $bg, $color];
			$url = "https://placehold.co/" . implode('/', array_filter($arr));
			if (!empty($text)) $url .= '?text=' . $text;
			return file_get_contents($url);
		} catch (\Exception $e) {
			return file_get_contents("https://placehold.co/" . $size);
		}
	}
}
