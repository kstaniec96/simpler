<?php
/**
 * This class is managed for Factory data.
 *
 * @package Simpler
 * @subpackage Factories
 * @version 2.0
 */

namespace Simpler\Components\Database;

use Simpler\Components\Database\Interfaces\FactoryInterface;

class Factory implements FactoryInterface
{
    /**
     * Make factory class data.
     *
     * @param string $factory
     * @return mixed
     */
    public static function make(string $factory)
    {
        return container($factory)->call('handle', true);
    }
}
