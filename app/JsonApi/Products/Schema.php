<?php

namespace App\JsonApi\Products;

use App\Models\Product;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{
    /**
     * @var string
     */
    protected $resourceType = 'products';

    /**
     * @param  Product  $resource
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
     * @param  Product  $resource
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
            'product_type' => [
                self::SHOW_SELF    => true,
                self::SHOW_RELATED => true,
            ],
        ];
    }
}
