<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CropImageRequest;
use App\Services\CropImageService;
use App\Services\Interfaces\CropImageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

/**
 * Class ImageCropController
 * @package App\Http\Controllers\Api
 */
class ImageCropController extends Controller
{
    protected CropImageServiceInterface $service;

    /**
     * ImageCropController constructor.
     * @param CropImageServiceInterface $service
     */
    public function __construct(CropImageServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param CropImageRequest $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function __invoke(CropImageRequest $request)
    {
        $fileName = $this->service->crop($request->file('image'));
        $file = Storage::disk('public')->path($fileName);
        return response()->download($file);
    }
}
