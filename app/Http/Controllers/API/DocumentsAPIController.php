<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDocumentsAPIRequest;
use App\Http\Requests\API\UpdateDocumentsAPIRequest;
use App\Http\Requests\API\UploadPdfFileAPIRequest;
use App\Models\Documents;
use App\Repositories\DocumentsRepository;
use App\Services\ImageGeneratorInterface;
use App\Services\UploaderInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DocumentsController
 * @package App\Http\Controllers\API
 */

class DocumentsAPIController extends AppBaseController
{
    /** @var  DocumentsRepository */
    private $documentsRepository;

    public function __construct(DocumentsRepository $documentsRepo)
    {
        $this->documentsRepository = $documentsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request)
    {
        $this->documentsRepository->pushCriteria(new RequestCriteria($request));
        $this->documentsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $documents = $this->documentsRepository->all();

        return $this->sendResponse($documents->toArray(), 'Documents retrieved successfully');
    }

    /**
     * @param UploadPdfFileAPIRequest $request
     * @param UploaderInterface $uploader
     * @param ImageGeneratorInterface $imageGenerator
     * @return Response
     */
    public function store(UploadPdfFileAPIRequest $request, UploaderInterface $uploader, ImageGeneratorInterface $imageGenerator)
    {
        try {
            $storeDocumentRequest = new CreateDocumentsAPIRequest([
                'attachment' => ($storedFile = $uploader->storeFile($request)),
                'preview' => $imageGenerator->generateImage($storedFile)
            ]);
            $documents = $this->documentsRepository->create($storeDocumentRequest->all());

            return $this->sendResponse($documents->toArray(), 'Documents saved successfully');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    /**
     * @param int $id
     * @param UpdateDocumentsAPIRequest $request
     * @return Response
     */
    public function update($id, UpdateDocumentsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Documents $documents */
        $documents = $this->documentsRepository->findWithoutFail($id);

        if (empty($documents)) {
            return $this->sendError('Documents not found');
        }

        $documents = $this->documentsRepository->update($input, $id);

        return $this->sendResponse($documents->toArray(), 'Documents updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Documents $documents */
        $documents = $this->documentsRepository->findWithoutFail($id);

        if (empty($documents)) {
            return $this->sendError('Documents not found');
        }

        $documents->delete();

        return $this->sendResponse($id, 'Documents deleted successfully');
    }
}
