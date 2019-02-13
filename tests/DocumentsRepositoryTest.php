<?php

use App\Models\Documents;
use App\Repositories\DocumentsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class DocumentsRepositoryTest extends \Tests\MyTestCase
{
    use MakeDocumentsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DocumentsRepository
     */
    protected $documentsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->documentsRepo = App::make(DocumentsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDocuments()
    {
        $documents = $this->fakeDocumentsData();
        $createdDocuments = $this->documentsRepo->create($documents);
        $createdDocuments = $createdDocuments->toArray();
        $this->assertArrayHasKey('id', $createdDocuments);
        $this->assertNotNull($createdDocuments['id'], 'Created Documents must have id specified');
        $this->assertNotNull(Documents::find($createdDocuments['id']), 'Documents with given id must be in DB');
        $this->assertModelData($documents, $createdDocuments);
    }

    /**
     * @test read
     */
    public function testReadDocuments()
    {
        $documents = $this->makeDocuments();
        $dbDocuments = $this->documentsRepo->find($documents->id);
        $dbDocuments = $dbDocuments->toArray();
        $this->assertModelData($documents->toArray(), $dbDocuments);
    }

    /**
     * @test update
     */
    public function testUpdateDocuments()
    {
        $documents = $this->makeDocuments();
        $fakeDocuments = $this->fakeDocumentsData();
        $updatedDocuments = $this->documentsRepo->update($fakeDocuments, $documents->id);
        $this->assertModelData($fakeDocuments, $updatedDocuments->toArray());
        $dbDocuments = $this->documentsRepo->find($documents->id);
        $this->assertModelData($fakeDocuments, $dbDocuments->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDocuments()
    {
        $documents = $this->makeDocuments();
        $resp = $this->documentsRepo->delete($documents->id);
        $this->assertTrue($resp);
        $this->assertNull(Documents::find($documents->id), 'Documents should not exist in DB');
    }
}
