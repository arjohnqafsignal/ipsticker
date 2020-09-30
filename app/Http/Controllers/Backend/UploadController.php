<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadscan(Request $request)
    {
        $request->file('RemoteFile')->storeAs('uploads', $request->file('RemoteFile')->getClientOriginalName(), 'public');
    }
}
