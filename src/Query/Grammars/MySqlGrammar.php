<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\MySqlGrammar as Base;

class MySqlGrammar extends Base implements EagerLimitGrammar
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

        return "substring_index($pathColumn, ?, 1)";
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
        $column = $this->wrap($pathColumn);
        $parentKeyColumn = $this->wrap($parentKeyColumn);
        $sql = $parentKeyQuery->toSql();

        return "if(instr($column, ?) = 0, $parentKeyColumn, ($sql))";
    }
}
