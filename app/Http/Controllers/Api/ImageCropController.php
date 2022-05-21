<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CropImageRequest;
use App\Services\CropImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

/**
 * Class ImageCropController
 * @package App\Http\Controllers\Api
 */
class ImageCropController extends Controller
{
    /**
     * @param CropImageRequest $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function __invoke(CropImageRequest $request)
    {
        $cropImageService = new CropImageService();
        $fileName = $cropImageService->crop($request->file('image'));
        $file = Storage::disk('public')->path($fileName);
        return response()->download($file);
    }
}
