<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Ancestors;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Bloodline;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Descendants;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Siblings;
use Staudenmeir\EloquentEagerLimitXLaravelCte\Eloquent\HasEagerLimitAndQueriesExpressions;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Traits\HasAdjacencyList;

trait HasEagerLimitAndRecursiveRelationships
{
    use HasAdjacencyList;
    use HasEagerLimitAndQueriesExpressions;

    /**
     * Instantiate a new Ancestors relationship.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $parent
     * @param string $foreignKey
     * @param string $localKey
     * @param bool $andSelf
     * @return \Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Ancestors
     */
    protected function newAncestors(Builder $query, Model $parent, $foreignKey, $localKey, $andSelf)
    {
        return new Ancestors($query, $parent, $foreignKey, $localKey, $andSelf);
    }

    /**
     * Instantiate a new Bloodline relationship.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $parent
     * @param string $foreignKey
     * @param string $localKey
     * @return \Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Bloodline
     */
    protected function newBloodline(Builder $query, Model $parent, $foreignKey, $localKey)
    {
        return new Bloodline($query, $parent, $foreignKey, $localKey);
    }

    /**
     * Instantiate a new Descendants relationship.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $parent
     * @param string $foreignKey
     * @param string $localKey
     * @param bool $andSelf
     * @return \Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Descendants
     */
    protected function newDescendants(Builder $query, Model $parent, $foreignKey, $localKey, $andSelf)
    {
        return new Descendants($query, $parent, $foreignKey, $localKey, $andSelf);
    }

    /**
     * Instantiate a new Siblings relationship.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $parent
     * @param string $foreignKey
     * @param string $localKey
     * @param bool $andSelf
     * @return \Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Siblings
     */
    protected function newSiblings(Builder $query, Model $parent, $foreignKey, $localKey, $andSelf)
    {
        return new Siblings($query, $parent, $foreignKey, $localKey, $andSelf);
    }
}
