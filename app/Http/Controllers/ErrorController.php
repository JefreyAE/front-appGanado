<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function pageNotFound(){
        return view('errors.errorPage404');
    }
}
