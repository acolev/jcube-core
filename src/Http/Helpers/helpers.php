<?php

use Illuminate\Support\Facades\Cache;
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