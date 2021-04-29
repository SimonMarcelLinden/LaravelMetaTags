<?php

namespace SimonMarcelLinden\LaravelMetaTags\Facades;

use Illuminate\Support\Facades\Facade;

class MetaTag extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string {
        return 'metatag';
    }
}
