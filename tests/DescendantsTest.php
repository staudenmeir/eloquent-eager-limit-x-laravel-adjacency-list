<?php

namespace Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Tests;

use Staudenmeir\EloquentEagerLimitXLaravelAdjacencyList\Tests\Models\User;

class DescendantsTest extends TestCase
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
        $posts = User::find(1)->descendants()->orderByDesc('depth')->orderBy('id')->limit(3)->get();

        $this->assertEquals([8, 9, 5], $posts->pluck('id')->all());
    }

    public function testEagerLoading()
    {
        $this->expectExceptionMessage('Eager loading limits are not supported on Descendants relationships.');

        User::with(
            [
                'descendants' => fn ($query) => $query->orderByDesc('depth')->orderBy('id')->limit(3),
            ]
        )->get();
    }

    public function testEagerLoadingAndSelf()
    {
        $users = User::with(
            [
                'descendantsAndSelf' => fn ($query) => $query->orderByDesc('depth')->orderBy('id')->limit(3),
            ]
        )->get();

        $this->assertEquals([8, 9, 5], $users[0]->descendantsAndSelf->pluck('id')->all());
        $this->assertEquals([12, 11], $users[9]->descendantsAndSelf->pluck('id')->all());
        $this->assertEquals([12], $users[10]->descendantsAndSelf->pluck('id')->all());
        $this->assertEquals([3, 3, 2], $users[0]->descendantsAndSelf->pluck('depth')->all());
        $this->assertEquals(['1.2.5.8', '1.3.6.9', '1.2.5'], $users[0]->descendantsAndSelf->pluck('path')->all());
    }

    public function testLazyEagerLoading()
    {
        $this->expectExceptionMessage('Eager loading limits are not supported on Descendants relationships.');

        User::all()->load(
            [
                'descendants' => fn ($query) => $query->orderByDesc('depth')->orderBy('id')->limit(3),
            ]
        );
    }

    public function testLazyEagerLoadingAndSelf()
    {
        $users = User::all()->load(
            [
                'descendantsAndSelf' => fn ($query) => $query->orderByDesc('depth')->orderBy('id')->limit(3),
            ]
        );

        $this->assertEquals([8, 9, 5], $users[0]->descendantsAndSelf->pluck('id')->all());
        $this->assertEquals([12, 11], $users[9]->descendantsAndSelf->pluck('id')->all());
        $this->assertEquals([12], $users[10]->descendantsAndSelf->pluck('id')->all());
        $this->assertEquals([3, 3, 2], $users[0]->descendantsAndSelf->pluck('depth')->all());
        $this->assertEquals(['1.2.5.8', '1.3.6.9', '1.2.5'], $users[0]->descendantsAndSelf->pluck('path')->all());
    }
}
