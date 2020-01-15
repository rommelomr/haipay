<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function showViewWatchVideo(){
    	return view('auth.watch_video');
    }
}