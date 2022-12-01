<?php

namespace Tests\Feature;

use App\Models\Log;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogTest extends TestCase
{
    use RefreshDatabase;

    /**
     * List of user show
     *
     * @test
     *
     * @return void
     */
    public function list_of_single_user_logs_show()
    {
        // Prepare
        $user = User::factory()->create();
        User::factory(15)->create();
        $logs = Log::factory(15)->create();

        // Perform
        $response = $this->get(route('user.logs',$user->id));

        // Predict
        $this->assertEquals(15, $logs->count());
        $response->assertStatus(200);
    }
}
