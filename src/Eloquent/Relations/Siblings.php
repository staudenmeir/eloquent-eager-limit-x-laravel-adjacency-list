<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations;

use Illuminate\Database\Eloquent\Collection;
use Staudenmeir\EloquentEagerLimit\Relations\HasLimit;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Siblings as Base;

class Siblings extends Base
{
    use HasLimit {
        limit as baseLimit;
    }

    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param array $models
     * @param \Illuminate\Database\Eloquent\Collection $results
     * @param string $relation
     * @return array
     */
    public function match(array $models, Collection $results, $relation)
    {
        parent::match($models, $results, $relation);

        if (!$this->parent->exists && !$this->andSelf) {
            $limit = $this->query->getQuery()->groupLimit;

            if ($limit) {
                foreach ($models as $model) {
                    $model->setRelation(
                        $relation,
                        $model->getRelation($relation)->take($limit['value'] - 1)
                    );
                }
            }
        }

        return $models;
    }

    /**
     * Set the "limit" value of the query.
     *
     * @param int $value
     * @return $this
     */
    public function limit($value)
    {
        if (!$this->parent->exists && !$this->andSelf) {
            $value++;
        }

        return $this->baseLimit($value);
    }
}
