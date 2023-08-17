<?php

namespace jCube\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use jCube\Http\Controllers\Controller;
use jCube\Rules\FileTypeValidate;

class ImagesController extends Controller
{
    public function editor(Request $request)
    {

        $fullpath = null;
        $request->validate([
            'file' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        if ($request->hasFile('file')) {
            try {
                $path = getFilePath('editor');
                if (! file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $fullpath = getPublicPath('editor').fileUploader($request->file, $path);

            } catch (\Exception $exp) {
                $notify = ['error', 'Couldn\'t upload the file'];

                return Response::json($notify, 200);
            } finally {
                return Response::json([
                    'location' => $fullpath,
                ], 200);
            }
        }
    }
}
