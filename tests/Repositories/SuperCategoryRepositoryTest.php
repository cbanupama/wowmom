<?php namespace Tests\Repositories;

use App\Models\SuperCategory;
use App\Repositories\SuperCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SuperCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SuperCategoryRepository
     */
    protected $superCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->superCategoryRepo = \App::make(SuperCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_super_category()
    {
        $superCategory = factory(SuperCategory::class)->make()->toArray();

        $createdSuperCategory = $this->superCategoryRepo->create($superCategory);

        $createdSuperCategory = $createdSuperCategory->toArray();
        $this->assertArrayHasKey('id', $createdSuperCategory);
        $this->assertNotNull($createdSuperCategory['id'], 'Created SuperCategory must have id specified');
        $this->assertNotNull(SuperCategory::find($createdSuperCategory['id']), 'SuperCategory with given id must be in DB');
        $this->assertModelData($superCategory, $createdSuperCategory);
    }

    /**
     * @test read
     */
    public function test_read_super_category()
    {
        $superCategory = factory(SuperCategory::class)->create();

        $dbSuperCategory = $this->superCategoryRepo->find($superCategory->id);

        $dbSuperCategory = $dbSuperCategory->toArray();
        $this->assertModelData($superCategory->toArray(), $dbSuperCategory);
    }

    /**
     * @test update
     */
    public function test_update_super_category()
    {
        $superCategory = factory(SuperCategory::class)->create();
        $fakeSuperCategory = factory(SuperCategory::class)->make()->toArray();

        $updatedSuperCategory = $this->superCategoryRepo->update($fakeSuperCategory, $superCategory->id);

        $this->assertModelData($fakeSuperCategory, $updatedSuperCategory->toArray());
        $dbSuperCategory = $this->superCategoryRepo->find($superCategory->id);
        $this->assertModelData($fakeSuperCategory, $dbSuperCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_super_category()
    {
        $superCategory = factory(SuperCategory::class)->create();

        $resp = $this->superCategoryRepo->delete($superCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(SuperCategory::find($superCategory->id), 'SuperCategory should not exist in DB');
    }
}
