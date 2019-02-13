<?php

namespace App\Services;

use Spatie\PdfToImage\Pdf;

class PreviewImage implements ImageGeneratorInterface
{
    /**
     * Generate image from uploaded file
     * @param $uploadedFilePath
     * @return string Generated image file path
     * @throws \Exception
     */
    public function generateImage($uploadedFilePath): string
    {
        $filename = basename($uploadedFilePath, ".pdf");
        $previewFilePath = 'pdf/' . $filename . '.jpg';
        $pdfPreview = new Pdf(storage_path("app/public/") . $uploadedFilePath);
        $pdfPreview->setResolution(30);
        $imageSaved = $pdfPreview->saveImage(storage_path("app/public/") . $previewFilePath);
        if (!$imageSaved) {
            \Storage::disk('public')->delete($uploadedFilePath);
            throw new \Exception('Image preview not created, uploaded file deleted');
        }
        return $previewFilePath;
    }
}