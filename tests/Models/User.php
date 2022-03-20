<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\HasEagerLimitAndRecursiveRelationships;

class User extends Model
{
    use HasEagerLimitAndRecursiveRelationships;
    use SoftDeletes;
}
