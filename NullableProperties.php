<?php declare(strict_types=1);

namespace Temper\NullableProperties;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait NullableProperties
 * @package Temper\NullableProperties
 * @mixin Model
 */
trait NullableProperties {

    public static function bootNullableProperties(): void
    {
        static::observe(new NullableObserver());
    }
}

