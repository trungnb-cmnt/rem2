<?php

namespace Theme\Bootstrap4\Http\Controllers;

use Illuminate\Routing\Controller;
use Theme;

class Bootstrap4Controller extends Controller
{

    /**
     * @return \Response
     */
    public function test()
    {
        return Theme::scope('test')->render();
    }
}