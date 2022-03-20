<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars;

interface EagerLimitGrammar
{
    /**
     * Compile a substring of the first path segment.
     *
     * @param string $column
     * @return string
     */
    public function compileFirstPathSegment($column);
}
