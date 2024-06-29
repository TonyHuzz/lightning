<?php

use App\Http\Controllers\Upload\UploadController;
use Illuminate\Support\Facades\Route;

Route::post('upload/mavon-editor-image', [UploadController::class, 'mavonEditorImage']);
