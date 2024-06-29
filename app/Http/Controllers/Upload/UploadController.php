<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use App\Http\Requests\Upload\UploadMavonEditorImageRequest;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function mavonEditorImage(UploadMavonEditorImageRequest $request): string
    {
        return Storage::url($request->file('image')->store('images'));
    }
}
