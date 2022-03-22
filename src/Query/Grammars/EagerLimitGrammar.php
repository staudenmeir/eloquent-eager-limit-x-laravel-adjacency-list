<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars;

use Illuminate\Database\Query\Builder;

interface EagerLimitGrammar
{
    /**
     * Compile an extraction of the first path segment.
     *
     * @param string $pathColumn
     * @return string
     */
    public function compileFirstPathSegment(string $pathColumn): string;

    /**
     * Compile an extraction of the first path segment's parent key.
     *
     * @param string $pathColumn
     * @param string $parentKeyColumn
     * @param \Illuminate\Database\Query\Builder $parentKeyQuery
     * @return string
     */
    public function compileParentKeyOfFirstPathSegment(string $pathColumn, string $parentKeyColumn, Builder $parentKeyQuery): string;
}
