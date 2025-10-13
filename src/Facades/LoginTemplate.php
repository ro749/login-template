<?php

namespace Ro749\LoginTemplate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ro749\LoginTemplate\LoginTemplate
 */
class LoginTemplate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ro749\LoginTemplate\LoginTemplate::class;
    }
}
