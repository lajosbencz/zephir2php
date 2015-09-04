<?php

namespace Zephir2Php\File;

use SplHeap;
use Iterator as IteratorInterface;

class Iterator extends SplHeap
{
    public function __construct(IteratorInterface $iterator)
    {
        foreach ($iterator as $item) {
            $this->insert($item);
        }
    }
    public function compare($b,$a)
    {
        return strcmp($a->getRealpath(), $b->getRealpath());
    }
}
