<?php

namespace Tests\Routes\Api\V1\User\Actions;

use App\Http\Controllers\Api\V1\User\Actions\UpdateNameController;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Passport\Passport;
use Tests\TestCase;

/** @see UpdateNameController */
class UpdateNameTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;
    use WithoutMiddleware;
    use WithFaker;

    protected const ROUTE = '/api/v1/user/actions/update-name';

    /**
     * @test
     * @see UpdateNameController::__invoke()
     */
    public function set_name(): void
    {
        $user = factory(User::class)->create(['name' => $this->faker->name]);
        Passport::actingAs($user);
        $this->post(self::ROUTE, ['name' => $user->name])->assertStatus(204);
        $query = User::where('id', $user->id)->first();
        self::assertEquals($user->name, $query->name);
    }

    /**
     * @test
     * @see UpdateNameController::__invoke()
     */
    public function name_not_present(): void
    {
        $user = factory(User::class)->create(['name' => $this->faker->name]);
        $this->post(
            self::ROUTE,
            [
                'id' => $user->id,
            ]
        )->assertStatus(302);
    }
}
