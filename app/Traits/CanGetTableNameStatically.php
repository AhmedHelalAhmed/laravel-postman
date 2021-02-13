<?php

namespace App\Traits;

/**
 * Trait CanGetTableNameStatically
 * @package App\Traits
 */
trait CanGetTableNameStatically
{
    /**
     * @return mixed
     */
    public static function tableName()
    {
        return with(new static)->getTable();
    }
}
