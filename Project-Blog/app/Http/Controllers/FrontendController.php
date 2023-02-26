<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comments;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function welcome()
    {
        return view('frontend.welcome');
    }

    public function index()
    {
        $blog = Blog::paginate(4);
        return view('frontend.index',[
            'blog'=>$blog,
        ]);
    }

    public function blog_view ($slug)
    {
        $blog = Blog::where('slug','=', $slug)->first();
        $comment = Comments::where('blog_id','=', $blog->id)->get();
        return view('frontend.blogview',[
            'blog'=>$blog,
            'comment'=>$comment,
        ]);
    }



}
