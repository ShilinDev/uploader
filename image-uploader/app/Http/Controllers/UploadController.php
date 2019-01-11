<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Imagick;



use App\Image;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request, ['image' => 'required|image|max:2000']);
        $file = $request->file('image');
        $filename = $file->getFilename().'.'.$file->extension();
        Storage::disk('images')->put($filename, File::get($file));
        Storage::disk('previews')->put($filename, Imagick::make($file)->resize(100,100)->save() );
        $image = new Image();
        $image->original_filename = $file->getClientOriginalName();
        $image->filename = $filename;
        $image->mime = $file->getClientMimeType();
        $image->save();
    }
}
