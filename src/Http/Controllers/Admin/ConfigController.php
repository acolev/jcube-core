<?php

namespace jCube\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Image;
use jCube\Http\Controllers\Controller;
use jCube\Models\Config;
use jCube\Models\ConfigCategory;
use jCube\Models\History;
use jCube\Rules\FileTypeValidate;

class ConfigController extends Controller
{
  
  public function index(ConfigCategory $category)
  {
    $pageTitle = 'Configuration: ' . $category->getAttribute('title');
    
    $categories = ConfigCategory::orderBy('id')->get();
    $viewFile = 'admin::config.' . $category->slug;
    $viewFileAlt = 'admin.config.' . $category->slug;
    $configs = Config::where('category', $category->slug)->get();
    
    
    if (!view()->exists($viewFile)) {
      if (view()->exists($viewFileAlt)) {
        $viewFile = $viewFileAlt;
      } else {
        $viewFile = 'admin::config.default';
      }
    }
    
    return view($viewFile, compact(
      'pageTitle',
      'categories',
      'category',
      'configs',
    ));
  }
  
  public function update($category, Request $request)
  {
    try {
      $history_array = [];
      
      foreach ($request->all() as $k => $v) {
        if ($request->hasFile($k)) {
          $path = $request->$k->storeAs('public', 'config/'.implode('.', [$k, $request->file($k)->extension()]));
          $v = $path;
        }
        
        if ($k !== '_token') {
          $config = Config::where('category', $category)
            ->where('slug', $k)->first();
          if ($config->type === 'boolean' && $v === '1') {
            $v = true;
          } elseif ($config->type === 'boolean') {
            $v = false;
          } elseif (is_array($v)) {
            $v = json_encode($v);
          }
          if ($config->slug && $config->value !== $v) {
            $history_array[$config->slug] = ['old' => $config->value, 'new' => $v];
            $config->value = $v;
            $config->save();
          }
        }
      }
      
      Artisan::call('optimize:clear');
      $notify[] = ['success', 'Settings updated successfully'];
      return back()->with('notify', $notify);
    } catch (\Exception $exception) {
      return back()->withErrors($exception->getMessage());
    }
  }
}
