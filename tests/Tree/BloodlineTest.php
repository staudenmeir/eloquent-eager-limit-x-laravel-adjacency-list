<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Tests\Tree;

use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Tests\Tree\Models\User;

class BloodlineTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if ($this->database === 'sqlsrv') {
            $this->markTestSkipped();
        }
    }

    public function testLazyLoadingWithLimit()
    {
        $posts = User::find(5)->bloodline()->orderByRaw('abs(depth) desc')->orderBy('id')->limit(3)->get();

        $this->assertEquals([1, 2, 8], $posts->pluck('id')->all());
    }

    public function testEagerLoading()
    {
        $users = User::with(
            [
                'bloodline' => fn ($query) => $query->orderByRaw('abs(depth) desc')->orderBy('id')->limit(3),
            ]
        )->get();

        $this->assertEquals([8, 9, 5], $users[0]->bloodline->pluck('id')->all());
        $this->assertEquals([8, 1, 5], $users[1]->bloodline->pluck('id')->all());
        $this->assertEquals([1, 2, 8], $users[4]->bloodline->pluck('id')->all());
        $this->assertEquals(['5.2.1', '5.2', '5.8'], $users[4]->bloodline->pluck('path')->all());
    }

    public function testLazyEagerLoading()
    {
        $users = User::all()->load(
            [
                'bloodline' => fn ($query) => $query->orderByRaw('abs(depth) desc')->orderBy('id')->limit(3),
            ]
        );

        $this->assertEquals([8, 9, 5], $users[0]->bloodline->pluck('id')->all());
        $this->assertEquals([8, 1, 5], $users[1]->bloodline->pluck('id')->all());
        $this->assertEquals([1, 2, 8], $users[4]->bloodline->pluck('id')->all());
        $this->assertEquals(['5.2.1', '5.2', '5.8'], $users[4]->bloodline->pluck('path')->all());
    }
}
