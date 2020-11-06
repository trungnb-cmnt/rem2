<?php

namespace Theme\Shards\Http\Controllers;

use Illuminate\Routing\Controller;
use Theme;

class ShardsController extends Controller
{

    /**
     * @return \Response
     */
    public function contact()
    {
        return Theme::scope('contact')->render();
    }
}
