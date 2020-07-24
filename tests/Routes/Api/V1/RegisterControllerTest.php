<?php

namespace Tests\Routes\Api\V1;

use App\Http\Controllers\Api\RegisterController;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;
    use WithoutMiddleware;
    use WithFaker;

    protected const PATH = '/api/v1/register';
    private $name_max_length;
    private $name_min_length;
    private $password_max_length;
    private $password_min_length;
    private $email_max_length;

    protected function setUp(): void
    {
        parent::setUp();
        $this->name_max_length     = config('api.name_max_length');
        $this->name_min_length     = config('api.name_min_length');
        $this->password_max_length = config('api.password_max_length');
        $this->password_min_length = config('api.password_min_length');
        $this->email_max_length    = config('api.email_max_length');
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function canRegister()
    {
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
        $user = User::where('email', $email)->first();
        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);
        self::assertIsString($password, $user->password);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function nameIsRequired(): void
    {
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
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
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function nameMin(): void
    {
        $name     = Str::random($this->name_min_length);
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function nameIsLessThanMin(): void
    {
        $name     = Str::random($this->name_min_length - 1);
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function nameIsGreaterThanMin(): void
    {
        $name     = Str::random($this->name_min_length + 1);
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function nameMax(): void
    {
        $name     = Str::random($this->name_max_length);
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function nameIsLessThanMax(): void
    {
        $name     = Str::random($this->name_max_length - 1);
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function nameIsGreaterThanMax(): void
    {
        $name     = Str::random($this->name_max_length + 1);
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function emailIsRequired(): void
    {
        $name     = $this->faker->name;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function emailIsString(): void
    {
        $name     = $this->faker->name;
        $email    = 1234;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function emailIsValidEmail(): void
    {
        $name     = $this->faker->name;
        $email    = 'invalid_email';
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function emailIsMaxLength(): void
    {
        $name     = $this->faker->name;
        $email    = Str::random($this->email_max_length - 6).'@a.com';
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function emailIsLessThanMaxLength(): void
    {
        $name     = $this->faker->name;
        $email    = Str::random($this->email_max_length - 7).'@a.com';
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function emailIsGreaterThanMaxLength(): void
    {
        $name     = $this->faker->name;
        $email    = Str::random($this->email_max_length - 5).'@a.com';
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function emailMusBeUnique(): void
    {
        $name     = $this->faker->name;
        $email    = Str::random($this->email_max_length - 6).'@a.com';
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function passwordIsRequired(): void
    {
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function passwordIsString(): void
    {
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function passwordIsMinLength(): void
    {
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $password = Str::random($this->password_min_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function passwordIsLessThanMinLength(): void
    {
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $password = Str::random($this->password_min_length - 1);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function passwordIsGreaterThanMinLength(): void
    {
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $password = Str::random($this->password_min_length + 1);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function passwordIsGreaterThanMaxLength(): void
    {
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length + 1);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(302);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function passwordIsLessThanMaxLength(): void
    {
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length - 1);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @see RegisterController::__invoke()
     */
    public function passwordIsMaxLength(): void
    {
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $password = Str::random($this->password_max_length);
        $response = $this->post(self::PATH, ['name' => $name, 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }
}
