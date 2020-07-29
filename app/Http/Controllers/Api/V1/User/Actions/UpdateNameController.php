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
use Tests\Routes\Api\V1\User\Actions\UpdateLocaleTest;
use Tests\Routes\Api\V1\User\Actions\UpdateNameTest;

class UpdateNameController extends JsonApiController
{

    use HttpResponse;

    /**
     * Determines if an email is unique.
     *
     * @param  Request  $request
     *
     * @return Application|ResponseFactory|Response
     * @see UpdateNameTest
     */
    public function __invoke(Request $request)
    {
        $request->validate(
            [
                'id'   => ValidateUser::id(),
                'name' => ValidateUser::name()
            ]
        );
        $user       = User::where('id', $request->id)->first();
        $user->name = $request->name;
        $user->save();

        return response(null, 204);
    }
}
