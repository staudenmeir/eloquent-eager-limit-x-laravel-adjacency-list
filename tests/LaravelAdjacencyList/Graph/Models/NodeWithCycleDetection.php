<?php

namespace Staudenmeir\LaravelAdjacencyList\Tests\Graph\Models;

class NodeWithCycleDetection extends Node
{
    public function enableCycleDetection(): bool
    {
        return true;
    }
}
