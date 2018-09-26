<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(){
        return $listvideo= Video::orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request){
        $video= new Video(); 
        $lien=$request->input('lien');
        $lien=substr($lien, strpos($lien, "=") + 1); ;
        $video->lien = "https://www.youtube.com/embed/".$lien;
        
        $video->save();
        return redirect('/');
    }
}
