<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use Session;
use App\Tag;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create a variable and store all the blog posts in it from the database
        // $posts = Post::all();
        $posts = Post::where('creator' , '=' , Auth::user()->username)->orderBy('id', 'desc')->paginate(5);
        // return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('posts.create')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        // validate the data
        $this->validate($request, array(
            'body' => 'required',
            'featured_image' => 'sometimes|image',
            'creator' => 'required'
        ));
        // store in the database
        $post = new Post;
        $post->body = Purifier::clean($request->body);
        $post->creator = $request->creator;

        // save our image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(600, 400)->save($location);

            $post->image = $filename;
        }

        $post->save();


        Session::flash('success', 'The blog post was successfully save!');
        // redirect to another page
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        //return view('posts.show')->with('post', $post);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post in the database and save as a var

        $post = Post::find($id);
        if ($post->creator == Auth::user()->username){
            $cats = array();
            $tags = Tag::all();
            $tags2 = array();
            foreach ($tags as $tag) {
                $tags2[$tag->id] = $tag->name;
            }
            // return the view and pass in the var we previously created
            if ($post->creator == Auth::user()->username){
                return view('posts.edit')->withPost($post)->withTags($tags2);
            }
            else{
                Session::flash('success',"This isn't your post");
                return redirect('/');
            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the data
        $post = Post::find($id);
        if ($post->creator == Auth::user()->username){
            $this->validate($request, array(
                'body' => 'required',
                'featured_image' => 'image'
            ));

            // Save the data to the database
            $post = Post::find($id);
            $post->body = Purifier::clean($request->input('body'));

            if ($request->hasFile('featured_image')) {
                // add the new photo
                $image = $request->file('featured_image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->resize(600, 400)->save($location);
                $oldFilename = $post->image;
                // update the database
                $post->image = $filename;
                // Delete the old photo
                Storage::delete($oldFilename);
            }
            $post->save();
        }

        else{
            Session::flash('warning', "This isn't your post");
            return redirect('/');
        }

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }
        // set flash data with success message
        Session::flash('success', 'This post was successfully saved.');
        // redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $post = Post::find($id);
        if ($post->creator == Auth::user()->username){
            $post->tags()->detach();
            Storage::delete($post->image);

            $post->delete();
            Session::flash('success', 'The post was successfully deleted.');
            return redirect('/');
        }
        else{
            Session::flash('warning','This isnt your post');
            return redirect('/');
        }
        
        
    }
}
