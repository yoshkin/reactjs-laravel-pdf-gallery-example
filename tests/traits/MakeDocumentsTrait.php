<?php

use Faker\Factory as Faker;
use App\Models\Documents;
use App\Repositories\DocumentsRepository;

trait MakeDocumentsTrait
{
    /**
     * Create fake instance of Documents and save it in database
     *
     * @param array $documentsFields
     * @return Documents
     */
    public function makeDocuments($documentsFields = [])
    {
        /** @var DocumentsRepository $documentsRepo */
        $documentsRepo = App::make(DocumentsRepository::class);
        $theme = $this->fakeDocumentsData($documentsFields);
        return $documentsRepo->create($theme);
    }

    /**
     * Get fake instance of Documents
     *
     * @param array $documentsFields
     * @return Documents
     */
    public function fakeDocuments($documentsFields = [])
    {
        return new Documents($this->fakeDocumentsData($documentsFields));
    }

    /**
     * Get fake data of Documents
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDocumentsData($documentsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'attachment' => $fake->word,
            'preview' => $fake->word,
        ], $documentsFields);
    }
}
