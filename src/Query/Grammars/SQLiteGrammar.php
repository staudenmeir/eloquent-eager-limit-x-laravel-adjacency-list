<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars;

use Illuminate\Database\Query\Grammars\SQLiteGrammar as Base;

class SQLiteGrammar extends Base implements EagerLimitGrammar
{
    /**
     * Compile a substring of the first path segment.
     *
     * @param string $column
     * @return string
     */
    public function compileFirstPathSegment($column)
    {
        $column = $this->wrap($column);

        return "(case when instr($column, ?) = 0 then $column else substr($column, 0, instr($column, ?)) end)";
    }
}
