<?php

namespace App\Services;


use App\Http\Requests\API\UploadPdfFileAPIRequest;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class UploadPdfFile implements UploaderInterface
{
    /**
     * Upload file to server
     *
     * @param UploadPdfFileAPIRequest $request
     * @return string Uploaded file path
     * @throws FileNotFoundException
     */
    public function storeFile($request): string
    {
        if ($request->file('pdf')) {
            $file = $request->pdf;
            $filename = time() . '-' . md5($file->getClientOriginalName());
            $storedFile = $request->pdf->storeAs('pdf', $filename . '.pdf', 'public');
            if (!$storedFile) {
                throw new FileNotFoundException();
            }
            return $storedFile;
        } else {
            throw new FileNotFoundException('File not uploaded');
        }
    }
}