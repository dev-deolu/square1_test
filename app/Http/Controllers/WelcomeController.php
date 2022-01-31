<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome', [
            'posts' => Post::getPostsPaginated()
        ]);
    }
}
