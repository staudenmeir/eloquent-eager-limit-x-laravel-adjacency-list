# Eloquent Eager Limit + Laravel Adjacency List

[![CI](https://github.com/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/actions/workflows/ci.yml/badge.svg)](https://github.com/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/actions/workflows/ci.yml)
[![Code Coverage](https://codecov.io/gh/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/graph/badge.svg?token=48FQL6WV0T)](https://codecov.io/gh/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/?branch=main)
[![Latest Stable Version](https://poser.pugx.org/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/v/stable)](https://packagist.org/packages/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list)
[![Total Downloads](https://poser.pugx.org/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/downloads)](https://packagist.org/packages/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/stats)
[![License](https://poser.pugx.org/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/license)](https://github.com/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/blob/main/LICENSE)

This Laravel package merges [staudenmeir/eloquent-eager-limit](https://github.com/staudenmeir/eloquent-eager-limit)
and [staudenmeir/laravel-adjacency-list](https://github.com/staudenmeir/laravel-adjacency-list) to allow them being used
in the same model.

Supports Laravel 9.0+.

## Installation

    composer require staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list:"^1.0"

Use this command if you are in PowerShell on Windows (e.g. in VS Code):

    composer require staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list:"^^^^1.0"

## Versions

| Laravel | Package |
|:--------|:--------|
| 10.x    | 1.1     |
| 9.x     | 1.0     |

## Usage

### Trees

Use the `HasEagerLimitAndRecursiveRelationships` trait in your model:

```php
class User extends Model
{
    use \Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\HasEagerLimitAndRecursiveRelationships;
}
```

#### Limitations

`Descendants` relationships only support eager loading limits when the query is ordered breadth-first (siblings before
children):

```php
$users = User::with([
    'descendants' => function ($query) {
        $query->breadthFirst()->limit(10);
    }
])->get();
```

`*OfDescendants` relationships do not support eager loading limits.

### Graphs

Use the `HasEagerLimitAndGraphRelationships` trait in your model:

```php
class Node extends Model
{
    use \Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\HasEagerLimitAndGraphRelationships;
}
```

#### Limitations

Eager loading limits on graph relationships are not supported at the moment.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CODE OF CONDUCT](.github/CODE_OF_CONDUCT.md) for details.
