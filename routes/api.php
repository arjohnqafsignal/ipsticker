<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\UploadController;
Route::post('/uploadscan', [UploadController::class, 'uploadscan'])
->name('uploadscan');
