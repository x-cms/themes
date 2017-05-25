<?php

namespace Xcms\Themes\Facades;

use Illuminate\Support\Facades\Facade;
use Xcms\Themes\Supports\Themes;

class ThemeFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Themes::class;
    }
}
