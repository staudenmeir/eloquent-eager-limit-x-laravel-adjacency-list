<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Tests;

use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Tests\Models\User;

class AncestorsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if ($this->database === 'sqlsrv') {
            $this->markTestSkipped();
        }
    }

    public function testLazyLoading()
    {
        $posts = User::find(8)->ancestors()->orderBy('depth')->limit(2)->get();

        $this->assertEquals([1, 2], $posts->pluck('id')->all());
    }

    public function testEagerLoading()
    {
        $users = User::with(
            [
                'ancestors' => fn ($query) => $query->orderBy('depth')->limit(2),
            ]
        )->get();

        $this->assertEquals([], $users[0]->ancestors->pluck('id')->all());
        $this->assertEquals([1], $users[1]->ancestors->pluck('id')->all());
        $this->assertEquals([1, 2], $users[7]->ancestors->pluck('id')->all());
        $this->assertEquals([-3, -2], $users[7]->ancestors->pluck('depth')->all());
        $this->assertEquals(['5.2.1', '5.2'], $users[7]->ancestors->pluck('path')->all());
    }

    public function testEagerLoadingAndSelf()
    {
        $users = User::with(
            [
                'ancestorsAndSelf' => fn ($query) => $query->orderBy('depth')->limit(2),
            ]
        )->get();

        $this->assertEquals([1], $users[0]->ancestorsAndSelf->pluck('id')->all());
        $this->assertEquals([1, 2], $users[1]->ancestorsAndSelf->pluck('id')->all());
        $this->assertEquals([1, 2], $users[7]->ancestorsAndSelf->pluck('id')->all());
        $this->assertEquals([-3, -2], $users[7]->ancestorsAndSelf->pluck('depth')->all());
        $this->assertEquals(['8.5.2.1', '8.5.2'], $users[7]->ancestorsAndSelf->pluck('path')->all());
    }

    public function testLazyEagerLoading()
    {
        $users = User::all()->load(
            [
                'ancestors' => fn ($query) => $query->orderBy('depth')->limit(2),
            ]
        );

        $this->assertEquals([], $users[0]->ancestors->pluck('id')->all());
        $this->assertEquals([1], $users[1]->ancestors->pluck('id')->all());
        $this->assertEquals([1, 2], $users[7]->ancestors->pluck('id')->all());
        $this->assertEquals([-3, -2], $users[7]->ancestors->pluck('depth')->all());
        $this->assertEquals(['5.2.1', '5.2'], $users[7]->ancestors->pluck('path')->all());
    }

    public function testLazyEagerLoadingAndSelf()
    {
        $users = User::all()->load(
            [
                'ancestorsAndSelf' => fn ($query) => $query->orderBy('depth')->limit(2),
            ]
        );

        $this->assertEquals([1], $users[0]->ancestorsAndSelf->pluck('id')->all());
        $this->assertEquals([1, 2], $users[1]->ancestorsAndSelf->pluck('id')->all());
        $this->assertEquals([1, 2], $users[7]->ancestorsAndSelf->pluck('id')->all());
        $this->assertEquals([-3, -2], $users[7]->ancestorsAndSelf->pluck('depth')->all());
        $this->assertEquals(['8.5.2.1', '8.5.2'], $users[7]->ancestorsAndSelf->pluck('path')->all());
    }
}
