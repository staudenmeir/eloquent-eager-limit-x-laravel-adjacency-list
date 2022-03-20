<?php

namespace Staudenmeir\EloquentEagerLimit\Tests\Models;

use Illuminate\Database\Eloquent\Model as Base;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\HasEagerLimitAndRecursiveRelationships;

abstract class Model extends Base
{
    use HasEagerLimitAndRecursiveRelationships;
}
