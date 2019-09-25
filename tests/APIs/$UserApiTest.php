<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\$User;

class $UserApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_$_user()
    {
        $$User = factory($User::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/$_users', $$User
        );

        $this->assertApiResponse($$User);
    }

    /**
     * @test
     */
    public function test_read_$_user()
    {
        $$User = factory($User::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/$_users/'.$$User->id
        );

        $this->assertApiResponse($$User->toArray());
    }

    /**
     * @test
     */
    public function test_update_$_user()
    {
        $$User = factory($User::class)->create();
        $edited$User = factory($User::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/$_users/'.$$User->id,
            $edited$User
        );

        $this->assertApiResponse($edited$User);
    }

    /**
     * @test
     */
    public function test_delete_$_user()
    {
        $$User = factory($User::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/$_users/'.$$User->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/$_users/'.$$User->id
        );

        $this->response->assertStatus(404);
    }
}
