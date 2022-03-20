<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\Relations\Traits;

use Illuminate\Database\Query\Expression;
use RuntimeException;
use Staudenmeir\EloquentEagerLimit\Relations\HasLimit;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars\MySqlGrammar;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars\PostgresGrammar;
use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars\SQLiteGrammar;

trait HasEagerLimit
{
    use HasLimit;

    /**
     * Add group limit.
     *
     * @param int $value
     * @return void
     */
    protected function addGroupLimit($value)
    {
        $grammar = $this->getEagerLimitGrammar();

        $sql = $grammar->compileFirstPathSegment(
            $this->related->qualifyColumn(
                $this->related->getPathName()
            )
        );

        $column = new Expression($sql);

        $this->query->groupLimit($value, $column);

        $this->query->getQuery()->addBinding(
            array_fill(
                0,
                substr_count($sql, '?'),
                $this->related->getPathSeparator()
            ),
            'groupBy'
        );
    }

    /**
     * Get the eager limit grammar.
     *
     * @return \Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Query\Grammars\EagerLimitGrammar
     */
    protected function getEagerLimitGrammar()
    {
        $connection = $this->query->getQuery()->getConnection();
        $driver = $connection->getDriverName();

        switch ($driver) {
            case 'mysql':
                return $connection->withTablePrefix(
                    new MySqlGrammar()
                );
            case 'pgsql':
                return $connection->withTablePrefix(
                    new PostgresGrammar()
                );
            case 'sqlite':
                return $connection->withTablePrefix(
                    new SQLiteGrammar()
                );
        }

        throw new RuntimeException('This database is not supported.'); // @codeCoverageIgnore
    }
}
