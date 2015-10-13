<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {
        return redirect()->route('homeLogged');
    }

    public function changeLocale()
    {

        if (App::getLocale() == 'en') {
            Session::put('locale', 'bg');
        } else {
            Session::put('locale', 'en');
        }


        return redirect()->route('homeLogged');

    }

}