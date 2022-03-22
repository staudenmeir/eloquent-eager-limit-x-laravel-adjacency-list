<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations;

use Illuminate\Database\Query\Expression;
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
                $grammar = $this->getEagerLimitGrammar();

                $firstPathSegment = $grammar->compileFirstPathSegment(
                    $this->related->qualifyColumn(
                        $this->related->getPathName()
                    )
                );

                $parentKeyQuery = $this->related->newModelQuery()
                                                ->select($this->getForeignKeyName())
                                                ->from($this->related->getTable(), 'laravel_alias')
                                                ->where($this->localKey, new Expression($firstPathSegment))
                                                ->limit(1);

                $sql = $grammar->compileParentKeyOfFirstPathSegment(
                    $this->related->qualifyColumn(
                        $this->related->getPathName()
                    ),
                    $this->related->qualifyColumn(
                        $this->related->getParentKeyName()
                    ),
                    $parentKeyQuery->getQuery()
                );

                $column = new Expression($sql);

                $this->query->groupLimit($value, $column);

                $this->query->getQuery()->addBinding(
                    array_fill(
                        0,
                        substr_count($sql, '?'),
                        $this->related->getPathSeparator()
                    ),
                    'select'
                );
            }
        }

        return $this;
    }
}
