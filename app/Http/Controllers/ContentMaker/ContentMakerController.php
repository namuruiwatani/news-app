<?php

namespace App\Http\Controllers\ContentMaker;

use App\Http\Controllers\Controller;

class ContentMakerController extends Controller
{
    public function welcome()
    {
        return view('content-maker.welcome');
    }
}
