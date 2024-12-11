<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([

            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $uuid = Str::uuid()->toString();
            $extension = $file->getClientOriginalExtension();
            $filename = $uuid.'.'. $extension;
            $path = $file->storeAs('uploads', $filename, 'public');

            return response()->json([ 'path' => asset('storage/'.$path), ], 200);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
