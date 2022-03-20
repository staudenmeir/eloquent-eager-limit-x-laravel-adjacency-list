<?php

namespace Staudenmeir\LaravelAdjacencyList\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\HasEagerLimitAndRecursiveRelationships;

class Category extends Model
{
    use HasEagerLimitAndRecursiveRelationships;

    public $incrementing = false;

    protected $keyType = 'string';
}
