<?php

namespace App\Services\Interfaces;

/**
 * Interface CropImageServiceInterface
 * @package App\Services\Interfaces
 */
interface CropImageServiceInterface
{
    /**
     * CropImageServiceInterface constructor.
     * @param $api_key
     */
    public function __construct($api_key);

    /**
     * @param $image
     * @return string
     */
    public function crop($image): string;
}
