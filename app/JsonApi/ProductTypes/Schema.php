<?php

namespace App\JsonApi\ProductTypes;

use App\Models\ProductType;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{
    /**
     * @var string
     */
    protected $resourceType = 'product_types';

    /**
     * @param  ProductType  $resource
     *      the domain record being serialized.
     *
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'name'        => $resource->name,
            'slug'        => $resource->slug,
            'description' => $resource->description,
            'created-at'  => $resource->created_at->toAtomString(),
            'updated-at'  => $resource->updated_at->toAtomString(),
        ];
    }

    /**
     * @param  ProductType  $resource
     *      the domain record being serialized.
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
            'products' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
            ],
        ];
    }
}
