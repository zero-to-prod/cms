<?php

namespace App\Http\Controllers\Api\V1\User\Actions;

use App\Helpers\Responses\HttpResponse;
use App\Models\User;
use App\Validation\ValidateUser;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tests\Routes\Api\V1\User\Actions\UpdateLocaleTest;

class UpdateLocaleController extends JsonApiController
{
    use HttpResponse;

    /**
     * Determines if an email is unique.
     *
     * @param  Request  $request
     *
     * @return Application|ResponseFactory|Response
     * @see UpdateLocaleTest
     */
    public function __invoke(Request $request)
    {
        $request->validate(
            [
                'user_locale' => ValidateUser::locale()
            ]
        );
        $user         = User::where('id', Auth::user()->id)->first();
        $user->locale = $request->user_locale;
        $user->save();

        return response(null, 204);
    }
}
