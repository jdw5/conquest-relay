<?php

use Conquest\Text\Facades\Text;

if (! function_exists('text')) {

    function text()
    {
        $instance = Text::getFacadeRoot();

        return $instance;
    }
}