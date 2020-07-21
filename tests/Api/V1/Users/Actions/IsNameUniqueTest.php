<?php

namespace Tests\Api\V1\Users\Actions;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/** @see IsNameUniqueController */
class IsNameUniqueTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;

    protected const ROUTE = '/api/v1/users/actions/is-name-unique';

    /** @test */
    public function name_is_unique()
    {
        $name            = 'User 1';
        $request_payload = [
            'name' => $name,
        ];
        $this->post(self::ROUTE, $request_payload)
            ->assertStatus(200)
            ->assertJson([
                'name'      => $name,
                'is_unique' => true,
            ]);
    }

    /** @test */
    public function name_is_not_unique()
    {
        $name = 'User 1';
        factory(User::class)->create(['name' => $name]);
        $request_payload = [
            'name' => $name,
        ];
        $this->post(self::ROUTE, $request_payload)
            ->assertStatus(200)
            ->assertJson([
                'name'      => $name,
                'is_unique' => false,
            ]);
    }
}
