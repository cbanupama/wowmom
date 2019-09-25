<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SuperCategory;

class SuperCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_super_category()
    {
        $superCategory = factory(SuperCategory::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/super_categories', $superCategory
        );

        $this->assertApiResponse($superCategory);
    }

    /**
     * @test
     */
    public function test_read_super_category()
    {
        $superCategory = factory(SuperCategory::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/super_categories/'.$superCategory->id
        );

        $this->assertApiResponse($superCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_super_category()
    {
        $superCategory = factory(SuperCategory::class)->create();
        $editedSuperCategory = factory(SuperCategory::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/super_categories/'.$superCategory->id,
            $editedSuperCategory
        );

        $this->assertApiResponse($editedSuperCategory);
    }

    /**
     * @test
     */
    public function test_delete_super_category()
    {
        $superCategory = factory(SuperCategory::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/super_categories/'.$superCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/super_categories/'.$superCategory->id
        );

        $this->response->assertStatus(404);
    }
}
