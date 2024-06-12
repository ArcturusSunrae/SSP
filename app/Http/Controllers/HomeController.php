<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //show notification
        session()->flash('flash.bannerStyle', 'warning');
        session()->flash('flash.banner', 'Welcome to our website!');
        return view('home');
    }
}
