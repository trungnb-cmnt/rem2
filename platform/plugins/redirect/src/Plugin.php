<?php

namespace Botble\Redirect;

use Schema;
use Botble\Base\Interfaces\PluginInterface;

class Plugin implements PluginInterface
{

    public static function activate()
    {
    }

    public static function deactivate()
    {
    }

    public static function remove()
    {
        Schema::dropIfExists('redirects');
    }
}