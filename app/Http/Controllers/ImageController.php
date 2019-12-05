<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        return view('image');
    }

    public function store(Request $request)
    {
        $image = $request->file('file');
        $fileName = mb_strtolower(str_replace(' ', '-', $image->getClientOriginalName()));
        $image->move(public_path('storage/images'), $fileName);

        $imageUpload = new Image();
        $imageUpload->filename = 'storage/images/' . $fileName;
        $imageUpload->save();
        return response()->json(['success' => $fileName]);
    }

    public function destroy(Request $request) {
        $id = $request->get('id');
        if (!isset($id)) {
            return false;
        }

        $fileNameDb = 'storage/images/' . $id;
        if (!DB::table('images')->where('filename', $fileNameDb)->delete()) {
            return false;
        }

        Storage::disk('public')->delete('/images/' . $id);

        return response()->json([
            'success' => 'файл ' . $fileNameDb . ' удален'
        ]);
    }
}
