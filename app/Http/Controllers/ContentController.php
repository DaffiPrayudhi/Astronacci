<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function articles()
    {
        $user = auth()->user();
        $limit = 0;
        
        switch($user->membership_type) {
            case 'A': $limit = 3; break;
            case 'B': $limit = 10; break;
            case 'C': $limit = 1000; break; 
        }
        
        $articles = \App\Models\Article::take($limit)->get();
        return view('articles', compact('articles'));
    }

    public function videos()
    {
        $user = auth()->user();
        $limit = 0;
        
        switch($user->membership_type) {
            case 'A': $limit = 3; break;
            case 'B': $limit = 10; break;
            case 'C': $limit = 1000; break;
        }
        
        $videos = \App\Models\Video::take($limit)->get();
        return view('videos', compact('videos'));
    }
}
