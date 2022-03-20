<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Tests;

use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Tests\Models\User;

class SiblingsTest extends TestCase
{
    public function testLazyLoading()
    {
        $siblings = User::find(2)->siblings()->limit(1)->get();

        $this->assertEquals([3], $siblings->pluck('id')->all());
    }

    public function testLazyLoadingAndSelf()
    {
        $siblingsAndSelf = User::find(2)->siblingsAndSelf()->limit(2)->get();

        $this->assertEquals([2, 3], $siblingsAndSelf->pluck('id')->all());
    }

    public function testEagerLoading()
    {
        $users = User::with(
            [
                'siblings' => fn ($query) => $query->orderBy('id')->limit(1),
            ]
        )->get();

        $this->assertEquals([11], $users[0]->siblings->pluck('id')->all());
        $this->assertEquals([3], $users[1]->siblings->pluck('id')->all());
    }

    public function testEagerLoadingAndSelf()
    {
        $users = User::with(
            [
                'siblingsAndSelf' => fn ($query) => $query->orderBy('id')->limit(2),
            ]
        )->get();

        $this->assertEquals([1, 11], $users[0]->siblingsAndSelf->pluck('id')->all());
        $this->assertEquals([2, 3], $users[1]->siblingsAndSelf->pluck('id')->all());
    }

    public function testEagerLoadingWithoutLimit()
    {
        $users = User::with('siblings')->get();

        $this->assertEquals([11], $users[0]->siblings->pluck('id')->all());
        $this->assertEquals([3, 4], $users[1]->siblings->pluck('id')->all());
    }

    public function testLazyEagerLoading()
    {
        $users = User::all()->load(
            [
                'siblings' => fn ($query) => $query->orderBy('id')->limit(1),
            ]
        );

        $this->assertEquals([11], $users[0]->siblings->pluck('id')->all());
        $this->assertEquals([3], $users[1]->siblings->pluck('id')->all());
    }

    public function testLazyEagerLoadingAndSelf()
    {
        $users = User::all()->load(
            [
                'siblingsAndSelf' => fn ($query) => $query->orderBy('id')->limit(2),
            ]
        );

        $this->assertEquals([1, 11], $users[0]->siblingsAndSelf->pluck('id')->all());
        $this->assertEquals([2, 3], $users[1]->siblingsAndSelf->pluck('id')->all());
    }

    public function testLazyEagerLoadingWithoutLimit()
    {
        $users = User::all()->load('siblings');

        $this->assertEquals([11], $users[0]->siblings->pluck('id')->all());
        $this->assertEquals([3, 4], $users[1]->siblings->pluck('id')->all());
    }
}
