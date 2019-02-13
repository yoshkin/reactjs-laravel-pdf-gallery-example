<?php

namespace App\Services;

interface ImageGeneratorInterface
{
    /**
     * Generate image from uploaded file
     * @param $uploadedFilePath
     * @return string Generated image file path
     */
    public function generateImage($uploadedFilePath):string;
}