<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view("Orbitali::dashboard.index");
    }
}
