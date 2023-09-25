<?php

namespace jCube\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use jCube\Http\Controllers\Controller;
use jCube\Rules\FileTypeValidate;

class ImagesController extends Controller
{
  public function upload($path, Request $request)
  {
    $request->validate([
      'file' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
    ]);
    if ($request->hasFile('file')) {
      try {
        $filePath = getFilePath($path);
        if (!file_exists($path)) {
          mkdir($path, 0755, true);
        }
        
        $filename = fileUploader($request->file, $filePath);
        $fullpath = implode('/',[getPublicFilePath($path), $filename]);
        
        return Response::json([
          'location' => $fullpath,
        ], 200);
      } catch (\Exception $exp) {
        $notify = ['error', 'Couldn\'t upload the file'];
        
        return Response::json($notify, 200);
      }
    }
  }
}
