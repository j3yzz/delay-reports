<?php

namespace App\Containers\User\Tests\Unit\Services\Login\Tasks;

use App\Containers\User\Contracts\Repositories\UserRepositoryInterface;
use App\Containers\User\DataTransfers\LoginData;
use App\Containers\User\Exceptions\InvalidPasswordException;
use App\Containers\User\Exceptions\PhoneNotVerifiedException;
use App\Containers\User\Models\User;
use App\Containers\User\Services\Login\Tasks\CheckUserValidityTask;
use App\Ship\Exceptions\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckUserValidityTest extends TestCase
{
    use RefreshDatabase;

    protected $userRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepositoryMock = $this->createMock(UserRepositoryInterface::class);
    }

    /** @test */
    public function it_should_return_user_when_valid_login_data_provided()
    {
        $user = new User([
            'name' => 'Amir Reza',
            'password' => Hash::make('password'),
            'phone_number_verified_at' => now(),
        ]);

        $loginData = LoginData::from(['phoneNumber' => '09123456789', 'password' => 'password']);

        $this->userRepositoryMock->expects($this->once())
            ->method('findByPhoneNumber')
            ->with($loginData->phoneNumber)
            ->willReturn($user);

        $task = new CheckUserValidityTask($this->userRepositoryMock);
        $result = $task->run($loginData);

        $this->assertInstanceOf(User::class, $result);
    }

    /** @test */
    public function it_should_throw_exception_when_user_not_found()
    {
        $this->expectException(ModelNotFoundException::class);
        $loginData = LoginData::from(['phoneNumber' => '09123456789', 'password' => 'password']);

        $this->userRepositoryMock->expects($this->once())
            ->method('findByPhoneNumber')
            ->with($loginData->phoneNumber)
            ->willReturn(null);

        $task = new CheckUserValidityTask($this->userRepositoryMock);
        $task->run($loginData);
    }

    /** @test */
    public function it_should_throw_exception_when_phone_not_verified()
    {
        $this->expectException(PhoneNotVerifiedException::class);

        $user = new User([
            'name' => 'Amir Reza',
            'password' => Hash::make('password'),
        ]);

        $loginData = LoginData::from(['phoneNumber' => '09123456789', 'password' => 'password']);

        $this->userRepositoryMock->expects($this->once())
            ->method('findByPhoneNumber')
            ->with($loginData->phoneNumber)
            ->willReturn($user);

        $task = new CheckUserValidityTask($this->userRepositoryMock);
        $task->run($loginData);
    }

    /** @test */
    public function it_should_throw_exception_when_invalid_password()
    {
        $this->expectException(InvalidPasswordException::class);

        $user = new User([
            'name' => 'Amir Reza',
            'password' => Hash::make('password1'),
            'phone_number_verified_at' => now(),
        ]);

        $loginData = LoginData::from(['phoneNumber' => '09123456789', 'password' => 'password']);

        $this->userRepositoryMock->expects($this->once())
            ->method('findByPhoneNumber')
            ->with($loginData->phoneNumber)
            ->willReturn($user);

        $task = new CheckUserValidityTask($this->userRepositoryMock);
        $task->run($loginData);
    }
}
