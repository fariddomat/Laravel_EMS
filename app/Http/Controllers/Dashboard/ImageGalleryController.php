<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class ImageGalleryController extends Controller
{

    public function browser(Request $request)
    {
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $files = Storage::disk('local')->allFiles('photos/gallery');
        return view('dashboard.filebrowse.browser', compact('CKEditorFuncNum', 'files'));
    }

    public function uploader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upload' => 'required|file|image',
        ]);
        if ($validator->fails()) {
            $response['uploaded'] = 0;
            $response['error']['message'] = 'Please upload a valid image.';
            return response()->json($response);
        }
        $name = $request->file('upload')->store('photos/gallery', 'local');
        $response['uploaded'] = 1;
        $response['fileName'] = $name;
        $response['url'] = asset($name);
        return response()->json($response);
    }
}
