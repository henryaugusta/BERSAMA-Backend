<?php

namespace App\Http\Controllers;
use App\Helper\RazkyFeb;
use App\Models\EatEvent;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function listevent()
    {
        $datas = EatEvent::where('status', '<>', '0')->get();
        return view('event')->with(compact('datas'));
    }
}
