<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadFileRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(UploadFileRequest $request)
    {
        $file = $request->file('file');
        $filename = hash_file('sha256', $file->path());
        $ext = $file->extension();

        $filename .= '.'.$ext;
        Storage::disk('public')->put('uploads/'.$filename, $file->getContent());

        if($request->get('res', 'json') === 'json') {
            return response()->json([
                'url' => Storage::url('public/uploads/'.$filename)
            ]);
        }
    }
}
