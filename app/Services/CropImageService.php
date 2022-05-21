<?php
/**
 * Created by PhpStorm.
 * User: stasi
 * Date: 07.05.2022
 * Time: 15:04
 */

namespace App\Services;


/**
 * Class CropImageService
 * @package App\Services
 */
class CropImageService
{
    /**
     * CropImageService constructor.
     */
    public function __construct()
    {
        \Tinify\setKey(config('tinify.api_key'));
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
            "width" => 70,
            "height" => 70
        ));
        $fileName = md5(time() . rand(0,25)).'.jpg';
        $path = 'storage/'.$fileName;
        $resized->toFile($path);
        return $fileName;
    }
}
