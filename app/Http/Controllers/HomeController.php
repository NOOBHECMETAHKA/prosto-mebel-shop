<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        return View('home');
    }
}
