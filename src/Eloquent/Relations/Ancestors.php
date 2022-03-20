<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations;

use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Traits\HasEagerLimit;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Ancestors as Base;

class Ancestors extends Base
{
    use HasEagerLimit;

    /**
     * Set the "limit" value of the query.
     *
     * @param int $value
     * @return $this
     */
    public function limit($value)
    {
        if ($this->parent->exists) {
            $this->query->limit($value);
        } else {
            $this->addGroupLimit($value);
        }

        return $this;
    }
}
