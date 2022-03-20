<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations;

use RuntimeException;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Traits\HasEagerLimit;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Descendants as Base;

class Descendants extends Base
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
            if ($this->andSelf) {
                $this->addGroupLimit($value);
            } else {
                throw new RuntimeException('Eager loading limits are not supported on Descendants relationships.');
            }
        }

        return $this;
    }
}
