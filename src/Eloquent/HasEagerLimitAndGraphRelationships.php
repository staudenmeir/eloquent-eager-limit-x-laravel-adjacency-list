<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent;

use Staudenmeir\EloquentEagerLimitXLaravelCte\Eloquent\HasEagerLimitAndQueriesExpressions;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Traits\HasGraphAdjacencyList;

trait HasEagerLimitAndGraphRelationships
{
    use HasGraphAdjacencyList;
    use HasEagerLimitAndQueriesExpressions;
}
