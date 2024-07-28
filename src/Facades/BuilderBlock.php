<?php

namespace Rmitesh\BuilderBlock\Facades;

use Illuminate\Support\Facades\Facade;

class BuilderBlock extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Rmitesh\BuilderBlock\BuilderBlock::class;
    }
}
