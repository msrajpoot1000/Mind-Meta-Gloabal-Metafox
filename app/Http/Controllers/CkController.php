<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CkController extends Controller
{
    public function uploadCKEditorImage(Request $request)
{
    if ($request->hasFile('upload')) {
        $file = $request->file('upload');
           $fileName = time() . '.' . $file->getClientOriginalExtension();

        // Define destination path inside public
        $destinationPath = public_path('uploads/ck-editor');

        // Ensure the directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Move the file
        $file->move($destinationPath, $fileName);

        // Get the public URL
        $url = asset('uploads/ck-editor/' . $fileName);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');

        return response()->make(
            "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', 'Image uploaded successfully');</script>",
            200,
            ['Content-Type' => 'text/html']
        );
    }

    return response()->json(['uploaded' => false, 'error' => ['message' => 'No file uploaded.']], 400);
}



public function deleteCKEditorImage(Request $request)
{
    // dd($request);
     Log::info('Delete image request received', $request->all());
    $url = $request->input('url');

    if (!$url) {
        return response()->json(['success' => false, 'message' => 'No URL provided.'], 400);
    }

    $relativePath = parse_url($url, PHP_URL_PATH); // e.g., /uploads/ck-editor/image.jpg
    $path = public_path($relativePath);

    // Optional but important: check deletion is from CKEditor folder only
    if (!Str::startsWith($path, public_path('uploads/ck-editor'))) {
        return response()->json(['success' => false, 'message' => 'Unauthorized path.'], 403);
    }

    // Log path for debugging (optional)
    Log::info("Attempting to delete image at: $path");

    if (file_exists($path)) {
        unlink($path);
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'File not found.'], 404);
}


}
