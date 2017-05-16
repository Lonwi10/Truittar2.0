<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getIndex(){
        $posts = Post::paginate(10);
        return view('/');
    }
    public function getSingle($id){
        //return $slug;
        // fetch from the DB based on slug
        $post = Post::where('id', '=', $id)->first();
        // return the view and pass in the post object
        return view('blog.single')->withPost($post);
    }
}
