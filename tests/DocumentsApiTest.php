<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class DocumentsApiTest extends \Tests\MyTestCase
{
    use MakeDocumentsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDocuments()
    {
        $documents = $this->fakeDocumentsData();
        $this->json('POST', '/api/v1/documents', $documents);

        $this->assertApiResponse($documents);
    }

    /**
     * @test
     */
    public function testReadDocuments()
    {
        $documents = $this->makeDocuments();
        $this->json('GET', '/api/v1/documents/'.$documents->id);

        $this->assertApiResponse($documents->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDocuments()
    {
        $documents = $this->makeDocuments();
        $editedDocuments = $this->fakeDocumentsData();

        $this->json('PUT', '/api/v1/documents/'.$documents->id, $editedDocuments);

        $this->assertApiResponse($editedDocuments);
    }

    /**
     * @test
     */
    public function testDeleteDocuments()
    {
        $documents = $this->makeDocuments();
        $this->json('DELETE', '/api/v1/documents/'.$documents->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/documents/'.$documents->id);

        $this->assertResponseStatus(404);
    }
}
