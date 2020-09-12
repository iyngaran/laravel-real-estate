<?php


namespace Iyngaran\RealEstate\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageUploadController
{
    public function upload(Request $request)
    {
        try {
            $file = $request->file('file');
            $file_name = trim(str_replace(" ", "_", $file->getClientOriginalName()));
            Storage::disk('post-images')->put($file_name, File::get($file));
        } catch (\Exception $e) {
            return response(['errors' => ['message' => $e->getMessage()]], 404);
        }
        return response()->json(
            [
                'path' => $file_name,
                'message' => 'Successfully updated event media!'
            ],
            200
        );
    }
}