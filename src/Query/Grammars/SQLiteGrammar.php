<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\SQLiteGrammar as Base;

class SQLiteGrammar extends Base implements EagerLimitGrammar
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

        return "case when instr($pathColumn, ?) = 0 then $pathColumn else substr($pathColumn, 0, instr($pathColumn, ?)) end";
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
        $column          = $this->wrap($pathColumn);
        $parentKeyColumn = $this->wrap($parentKeyColumn);
        $sql             = $parentKeyQuery->toSql();

        return "case when instr($column, ?) = 0 then $parentKeyColumn else ($sql) end";
    }
}
