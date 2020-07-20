<?php

namespace App\JsonApi\AuthLogs;

use App\Models\AuthLog;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'auth-logs';

    /**
     * @param  AuthLog  $resource
     *      the domain record being serialized.
     *
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param  AuthLog  $resource
     *      the domain record being serialized.
     *
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'user_id'    => $resource->user_id,
            'login'      => $resource->login,
            'logout'     => $resource->logout,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'user' => [
                self::DATA => static function () use ($resource) {
                    return $resource->user;
                },
            ],
        ];
    }
}
