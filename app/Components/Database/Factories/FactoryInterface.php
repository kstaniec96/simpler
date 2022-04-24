<?php

namespace Simpler\Components\Database\Interfaces;

interface FactoryInterface
{
    /**
     * @param string $factory
     * @return mixed
     */
    public static function make(string $factory);
}
