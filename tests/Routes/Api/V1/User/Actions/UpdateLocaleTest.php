<?php

namespace Tests\Routes\Api\V1\User\Actions;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
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
     */
    public function set_locale(): void
    {
        $user   = factory(User::class)->create(['locale' => 'en']);
        $locale = 'es';
        $this->post(
            self::ROUTE,
            [
                'id'          => $user->id,
                'user_locale' => $locale
            ]
        )->assertStatus(204);
        $query = User::where('id', $user->id)->first();
        self::assertEquals($locale, $query->locale);
    }

    /**
     * @test
     */
    public function locale_not_present(): void
    {
        $user = factory(User::class)->create(['locale' => 'en']);
        $this->post(
            self::ROUTE,
            [
                'id' => $user->id
            ]
        )->assertStatus(302);
    }

    /**
     * @test
     */
    public function id_not_present(): void
    {
        $user = factory(User::class)->create(['locale' => 'en']);
        $this->post(
            self::ROUTE,
            [
                'user_locale' => 'en',
            ]
        )->assertStatus(302);
    }
}
