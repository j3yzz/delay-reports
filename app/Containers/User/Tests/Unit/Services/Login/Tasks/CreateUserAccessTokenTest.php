<?php

namespace App\Containers\User\Tests\Unit\Services\Login\Tasks;

use App\Containers\User\Models\User;
use App\Containers\User\Services\Login\Tasks\CreateUserAccessTokenTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Tests\TestCase;

class CreateUserAccessTokenTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_create_user_access_token()
    {
        $user = User::query()->create([
            'name' => 'Amir Reza',
            'phone_number' => '09123456789',
            'password' => Hash::make('password'),
            'phone_number_verified_at' => now(),
        ]);

        $task = new CreateUserAccessTokenTask();
        $task->run($user);

        $this->assertCount(1, $user->tokens);
        $this->assertInstanceOf(PersonalAccessToken::class, $user->tokens->first());
        $this->assertEquals('customer-auth', $user->tokens->first()->name);
    }

    /** @test */
    public function it_should_attach_access_token_to_user()
    {
        $user = User::query()->create([
            'name' => 'Amir Reza',
            'phone_number' => '09123456789',
            'password' => Hash::make('password'),
            'phone_number_verified_at' => now(),
        ]);

        $task = new CreateUserAccessTokenTask();

        $task->run($user);

        $this->assertTrue($user->tokens->isNotEmpty());
    }
}
