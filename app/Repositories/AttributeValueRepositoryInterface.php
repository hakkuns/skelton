<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Collection;

interface AttributeValueRepositoryInterface extends BaseRepositoryInterface
{
    public function createAttributeValue(Attribute $attribute, array $data) : AttributeValue;

    public function associateToAttribute(Attribute $attribute) : AttributeValue;

    public function dissociateFromAttribute() : bool;

    public function findProductAttributes() : Collection;
}
