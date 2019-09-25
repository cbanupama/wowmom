<?php namespace Tests\Repositories;

use App\Models\$User;
use App\Repositories\$UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class $UserRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var $UserRepository
     */
    protected $$UserRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->$UserRepo = \App::make($UserRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_$_user()
    {
        $$User = factory($User::class)->make()->toArray();

        $created$User = $this->$UserRepo->create($$User);

        $created$User = $created$User->toArray();
        $this->assertArrayHasKey('id', $created$User);
        $this->assertNotNull($created$User['id'], 'Created $User must have id specified');
        $this->assertNotNull($User::find($created$User['id']), '$User with given id must be in DB');
        $this->assertModelData($$User, $created$User);
    }

    /**
     * @test read
     */
    public function test_read_$_user()
    {
        $$User = factory($User::class)->create();

        $db$User = $this->$UserRepo->find($$User->id);

        $db$User = $db$User->toArray();
        $this->assertModelData($$User->toArray(), $db$User);
    }

    /**
     * @test update
     */
    public function test_update_$_user()
    {
        $$User = factory($User::class)->create();
        $fake$User = factory($User::class)->make()->toArray();

        $updated$User = $this->$UserRepo->update($fake$User, $$User->id);

        $this->assertModelData($fake$User, $updated$User->toArray());
        $db$User = $this->$UserRepo->find($$User->id);
        $this->assertModelData($fake$User, $db$User->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_$_user()
    {
        $$User = factory($User::class)->create();

        $resp = $this->$UserRepo->delete($$User->id);

        $this->assertTrue($resp);
        $this->assertNull($User::find($$User->id), '$User should not exist in DB');
    }
}
