<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * List of user show
     *
     * @test
     *
     * @return void
     */
    public function list_of_user_show()
    {
        // Prepare
        $user = User::factory(15)->create();

        // Perform
        $response = $this->get('/');

        // Predict
        $this->assertEquals(15, $user->count());

        $response->assertStatus(200);
    }


    /**
     * Store new user
     *
     * @test
     *
     * @return void
     */
    public function store_new_user()
    {
        // Prepare
        $user = $this->user;

        // Perform
        $this->postJson('/user/store', [
            $user
        ]);

        // Predict
        $this->assertDatabaseCount('users', 1);

    }


    /**
     * Update single user
     *
     * @test
     *
     * @return void
     */
    public function update_single_user()
    {
        // Prepare
        $user = $this->user;

        // Perform
        $this->patchJson(route('user.update', $user->id), [
            $user
        ]);

        // Predict
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    /**
     * Delete single user
     *
     * @test
     *
     * @return void
     */
    public function delete_single_user()
    {
        // Prepare
        $user = $this->user;

        // Perform
        $this->delete(route('user.destroy', $user));

        // Predict
        $this->assertDatabaseMissing('users', [
            ['name' => $user->name]
        ]);
    }

}
