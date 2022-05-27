<?php
/**
 * Created by PhpStorm.
 * User: stasi
 * Date: 07.05.2022
 * Time: 15:04
 */

namespace App\Services;


use App\Services\Interfaces\CropImageServiceInterface;

/**
 * Class CropImageService
 * @package App\Services
 */
class CropImageService implements CropImageServiceInterface
{
    /**
     * CropImageService constructor.
     */
    public function __construct($api_key)
    {
        \Tinify\setKey($api_key);
    }

    /**
     * @param $image
     * @return string
     */
    public function crop($image)
    {
        $source = \Tinify\fromFile($image);
        $resized = $source->resize(array(
            "method" => "fit",
            "width" => config('images.crop.width'),
            "height" => config('images.crop.height')
        ));
        $fileName = md5(time() . rand(0,25)).'.jpg';
        $path = 'storage/'.$fileName;
        $resized->toFile($path);
        return $fileName;
    }
}
