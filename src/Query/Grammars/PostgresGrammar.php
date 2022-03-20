<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars;

use Illuminate\Database\Query\Grammars\PostgresGrammar as Base;

class PostgresGrammar extends Base implements EagerLimitGrammar
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

        return $column . '[1]';
    }
}
