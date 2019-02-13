<?php

namespace App\Services;

interface UploaderInterface
{
    /**
     * Upload file to server
     *
     * @param $request
     * @return string Uploaded file path
     */
    public function storeFile($request):string;
}