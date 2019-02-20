<?php

namespace Orbitali\Http\Controllers;

use Orbitali\Http\Models\Website;

class WebsiteController
{
    public function index()
    {
        $websites = Website::with('extras')->paginate(10);
        return view('Orbitali::website.index', compact('websites'));
    }
}
