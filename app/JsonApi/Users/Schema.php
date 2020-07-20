<?php

namespace App\JsonApi\Users;

use App\Models\User;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{
    /**
     * @var string
     */
    protected $resourceType = 'user';

    /**
     * @param  User  $resource
     *      the domain record being serialized.
     *
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'name'              => $resource->name,
            'email'             => $resource->email,
            'email_verified_at' => $resource->email_verified_at,
            'password'          => $resource->password,
            'remember_token'    => $resource->remember_token,
            'created_at'        => $resource->created_at->toAtomString(),
            'updated_at'        => $resource->updated_at->toAtomString(),
            'deleted_at'        => $resource->deleted_at,
        ];
    }

    /**
     * @param  User  $resource
     * The domain record being serialized.
     *
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'users' => [
                self::SHOW_SELF    => true,
                self::SHOW_RELATED => true,
            ],
        ];
    }
}
