<?php

namespace Tests\Routes\Api\V1;

use App\Http\Controllers\Api\RegisterController;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected const PATH = '/api/v1/register';

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function nameIsRequired(): void
    {
        $email    = 'test@location.domain';
        $password = 'secret';
        $response = $this->post(self::PATH, ['email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function nameIsString(): void
    {
        $name     = 100;
        $email    = 'test@location.domain';
        $password = 'secret';
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function nameMax(): void
    {
        $length   = config('api.name_length');
        $name     = Str::random(10);
        $email    = 'test@location.domain';
        $password = 'secret';
        $response = $this->post(self::PATH, ['name' => 'absc', 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function emailIsRequired(): void
    {
        $name     = 'User Name';
        $password = 'secret';
        $response = $this->post(self::PATH, ['name' => $name, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function passwordIsRequired(): void
    {
        $name     = 'User Name';
        $email    = 'test@location.domain';
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email]);
        $response->assertStatus(302);
    }
}