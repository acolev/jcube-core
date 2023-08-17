<?php

namespace jCube\Http\Controllers;

class SiteController extends Controller
{
    public function placeholderImage($size = '100x100', $bg = null, $color = null, $text = null)
    {
        try {
            $arr = [$size, $bg, $color];
            $url = 'https://placehold.co/'.implode('/', array_filter($arr));
            if (! empty($text)) {
                $url .= '?text='.$text;
            }

            return response(file_get_contents($url), 200)->header('Content-Type', 'image/svg+xml');
        } catch (\Exception $e) {
            return response(file_get_contents('https://placehold.co/'.$size), 200)->header('Content-Type', 'image/svg+xml');
        }
    }
}
