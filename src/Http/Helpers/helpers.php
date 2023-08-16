<?php

use Illuminate\Support\Facades\Cache;
use jCube\Lib\FileManager;
use jCube\Models\GeneralSetting;

function systemDetails()
{
	$def = [];
	if (function_exists('mySystemDetails')) $def = mySystemDetails();

	$system['name'] = 'core';
	$system['version'] = '2.1';
	$system['build_version'] = '1.0.5';

	return array_merge($system, $def);
}

function gs()
{
	try {
		$general = Cache::get('GeneralSetting');
		if (!$general) {
			$general = GeneralSetting::firstOrFail();
			Cache::put('GeneralSetting', $general);
		}
		return $general;
	} catch (Exception $e) {
		//
	}
}

function activeTemplate($asset = false)
{
	try {
		$general = gs();
		$template = $general->active_template;
		if ($asset) return 'assets/templates/' . $template . '/';
		return 'templates.' . $template . '.';
	} catch (Exception $e) {
		return 'templates.basic.';
	}
}

function slug($string)
{
	return Illuminate\Support\Str::slug($string);
}

function getMetaTitle($title){
	return $title;
}

function getImage($image, $size = '200x200')
{
	$clean = '';
	if (file_exists($image) && is_file($image)) {
		return asset($image) . $clean;
	}
	return route('placeholder.image', $size);
}

function getFilePath($key)
{
	$fileManager = new FileManager();
	return $fileManager->$key()->path;
}

function getFileSize($key)
{
	$fileManager = new FileManager();
	return $fileManager->$key()->size;
}

function placeholderImage()
{
	$args = func_get_args();
	if (!count($args)) $args[] = '300x250';
	return route('placeholder.image', $args);
}

function keyToTitle($text)
{
	return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}

function titleToKey($text)
{
	return strtolower(str_replace(' ', '_', $text));
}

function menuActive($routeName, $type = null, $param = null)
{
	if ($type == 3) $class = 'side-menu--open';
	elseif ($type == 2) $class = 'sidebar-submenu__open';
	elseif ($type == 4) $class = 'open';
	else $class = 'active';

	if (is_array($routeName)) {
		foreach ($routeName as $key => $value) {
			if (request()->routeIs($value)) return $class;
		}
	} elseif (request()->routeIs($routeName)) {
		if ($param) {
			$routeParam = array_values(@request()->route()->parameters ?? []);
			if (strtolower(@$routeParam[0]) == strtolower($param)) return $class;
			else return;
		}
		return $class;
	}
}
