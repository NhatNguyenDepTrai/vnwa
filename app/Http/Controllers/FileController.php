<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class FileController extends Controller
{
    public function ckediterUploadsImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads/images/editer', 'public');
            $path = 'storage/' . $path;
            return response()->json(['url' => url($path)]);
        }
        return response()->json(['error' => 'No file provided'], 400);
    }
}
