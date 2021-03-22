<?php declare(strict_types=1);

namespace Temper\NullableProperties\Providers;

use Illuminate\Support\ServiceProvider;

class NullablePropertiesServiceProvider extends ServiceProvider
{
    protected $defer;

    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        //
    }

    public function provides(): array
    {
        return [];
    }
}
