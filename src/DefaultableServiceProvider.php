<?php

namespace Inspheric\NovaDefaultable;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Fields\Field;

class DefaultableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/defaultable_field.php' => config_path('defaultable_field.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/../config/defaultable_field.php', 'defaultable_field'
        );

        Field::macro('defaultValue', function($value, callable $callback = null) {
            return DefaultableField::defaultValue($this, $value, $callback);
        });

        Field::macro('defaultLastValue', function(callable $callback = null) {
            return DefaultableField::defaultLastValue($this, $callback);
        });
    }
}
