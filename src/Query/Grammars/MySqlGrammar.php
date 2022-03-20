<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars;

use Illuminate\Database\Query\Grammars\MySqlGrammar as Base;

class MySqlGrammar extends Base implements EagerLimitGrammar
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

        return "substring_index($column, ?, 1)";
    }
}
