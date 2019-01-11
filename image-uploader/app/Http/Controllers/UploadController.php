<?php

namespace App\Http\Controllers;

use App\Jobs\UploadImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request, ['image' => 'required|image|max:2000']);
        $file = $request->file('image');
        $filename = public_path('images').time().'.'.$file->extension();
        Image::make($file)
            ->save($filename);
//        $this->dispatch(new UploadImage($file));
    }
}
