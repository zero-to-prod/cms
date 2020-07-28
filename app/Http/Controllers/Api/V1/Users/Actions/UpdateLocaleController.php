<?php

namespace App\Http\Controllers\Api\V1\Users\Actions;

use App\Helpers\Responses\HttpResponse;
use App\Models\User;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\Routes\Api\V1\Users\Actions\UpdateLocaleTest;

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
                'id'          => ['required'],
                'user_locale' => ['required', 'string']
            ]
        );
        $user         = User::where('id', $request->id)->first();
        $user->locale = $request->user_locale;
        $user->save();
        $status   = 204;
        $response = $this->status($status)->title('User locale updated.')->get();

        return response($response, $status);
    }
}
