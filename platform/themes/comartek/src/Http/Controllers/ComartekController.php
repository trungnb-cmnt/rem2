<?php

namespace Theme\Comartek\Http\Controllers;

use Illuminate\Routing\Controller;

class ComartekController extends Controller
{
    /**
     * @return string
     * @author Sang Nguyen
     */
    public function getTest()
    {
        // return Theme::scope('test')->render(); You can create a view (public/themes/ripple/views/test.blade.php) to show data.
        return 'This is a test route';
    }
}
