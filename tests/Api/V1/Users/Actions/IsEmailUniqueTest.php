<?php

namespace Tests\Api\V1\Users\Actions;

use App\Http\Controllers\Api\V1\Users\Actions\IsEmailUniqueController;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/** @see IsEmailUniqueController */
class IsEmailUniqueTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected const ROUTE = '/api/v1/users/actions/is-email-unique';

    /** @test */
    public function email_is_unique()
    {
        $email = 'email@domain.com';
        $request_payload = [
            'email' => $email,
        ];
        $this->post(self::ROUTE, $request_payload)
            ->assertStatus(200)
            ->assertJson([
                'email'     => $email,
                'is_unique' => true,
            ]);
    }

    /** @test */
    public function email_is_not_unique(): void
    {
        $email = 'email@domain.com';
        factory(User::class)->create(['email' => $email]);
        $request_payload = [
            'email' => $email,
        ];
        $this->post(self::ROUTE, $request_payload)
            ->assertStatus(200)
            ->assertJson([
                'email'     => $email,
                'is_unique' => false,
            ]);
    }
}
