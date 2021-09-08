<?php

namespace App\Http\Controllers\Reza;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('blog', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('post', compact('blog'));
    }
}
