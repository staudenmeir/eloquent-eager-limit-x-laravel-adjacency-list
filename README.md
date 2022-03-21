![CI](https://github.com/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/workflows/CI/badge.svg)
[![Code Coverage](https://scrutinizer-ci.com/g/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/?branch=main)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/?branch=main)
[![Latest Stable Version](https://poser.pugx.org/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/v/stable)](https://packagist.org/packages/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list)
[![Total Downloads](https://poser.pugx.org/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/downloads)](https://packagist.org/packages/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list)
[![License](https://poser.pugx.org/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list/license)](https://packagist.org/packages/staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list)

## Introduction

This Laravel package merges [staudenmeir/eloquent-eager-limit](https://github.com/staudenmeir/eloquent-eager-limit)
and [staudenmeir/laravel-adjacency-list](https://github.com/staudenmeir/laravel-adjacency-list) to allow them being used
in the same model.

Supports Laravel 9.0+.

## Installation

    composer require staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list:"^1.0"

Use this command if you are in PowerShell on Windows (e.g. in VS Code):

    composer require staudenmeir/eloquent-eager-limit-x-laravel-adjacency-list:"^^^^1.0"

## Usage

Use the `HasEagerLimitAndRecursiveRelationships` trait in your model:

```php
class User extends Model
{
    use \Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Eloquent\HasEagerLimitAndRecursiveRelationships;
}
```

### Limitations

Eager loading limits are not supported on `Descendants` and `*OfDescendants`relationships. They *are* supported
on `DescendantsAndSelf` relationships.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CODE OF CONDUCT](.github/CODE_OF_CONDUCT.md) for details.
