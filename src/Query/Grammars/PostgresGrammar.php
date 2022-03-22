<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\PostgresGrammar as Base;

class PostgresGrammar extends Base implements EagerLimitGrammar
{
    /**
     * Compile an extraction of the first path segment.
     *
     * @param string $pathColumn
     * @return string
     */
    public function compileFirstPathSegment(string $pathColumn): string
    {
        $pathColumn = $this->wrap($pathColumn);

        return $pathColumn . '[1]';
    }

    /**
     * Compile an extraction of the first path segment's parent key.
     *
     * @param string $pathColumn
     * @param string $parentKeyColumn
     * @param \Illuminate\Database\Query\Builder $parentKeyQuery
     * @return string
     */
    public function compileParentKeyOfFirstPathSegment(string $pathColumn, string $parentKeyColumn, Builder $parentKeyQuery): string
    {
        $pathColumn = $this->wrap($pathColumn);
        $parentKeyColumn = $this->wrap($parentKeyColumn);
        $sql = $parentKeyQuery->toSql();

        return "case when array_length($pathColumn, 1) = 1 then $parentKeyColumn else ($sql) end";
    }
}
