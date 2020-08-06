<?php

namespace Tests\Routes\Api\V1\User\Actions;

use App\Http\Controllers\Api\V1\User\Actions\UpdateLocaleController;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Passport\Passport;
use Tests\TestCase;

/** @see UpdateLocaleController */
class UpdateLocaleTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected const ROUTE = '/api/v1/user/actions/update-locale';

    /**
     * @test
     * @see UpdateLocaleController::__invoke()
     */
    public function set_locale(): void
    {
        $user = factory(User::class)->create(['locale' => 'en']);
        Passport::actingAs($user);
        $locale = 'es';
        $this->post(self::ROUTE, ['user_locale' => $locale])->assertStatus(204);
        $query = User::where('id', $user->id)->first();
        self::assertEquals($locale, $query->locale);
    }

    /**
     * @test
     * @see UpdateLocaleController::__invoke()
     */
    public function locale_not_present(): void
    {
        $user = factory(User::class)->create(['locale' => 'en']);
        Passport::actingAs($user);
        $this->post(self::ROUTE, [])->assertStatus(302);
    }
}
