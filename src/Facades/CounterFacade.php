<?php

namespace Kryptonit3\Counter\Facades;

use Illuminate\Support\Facades\Facade;

class CounterFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'counter';
    }

}