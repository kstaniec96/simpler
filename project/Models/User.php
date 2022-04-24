<?php

declare(strict_types=1);

namespace Project\Models;

use Simpler\Components\Database\Model;

/**
 * @property int $id
 */
class User extends Model
{
    protected $relations = [];
    protected $table = 'Users';
    protected $connectName = 'default';
    protected $alias = 'u';
}
