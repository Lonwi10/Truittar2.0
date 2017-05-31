<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\Follower;
use Session;
use Auth;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|min:5|max:2000'
        ));
        $followers = Follower::where('follower', '=', Auth::user()->username)->get();
        $followeds = Follower::where('followed', '=', Auth::user()->username)->get();
        $post = Post::find($post_id);
        $posts = Post::orderBy('created_at', 'desc')->get();
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);
        $comment->save();

        Session::flash('success', 'Comment was added');
        return redirect()->action(
            'PagesController@getIndex'
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $comment = Comment::find($id);
          if ($comment->name == Auth::user()->username){
            return view('comments.edit')->withComment($comment);
        }
        else{
            Session::flash('warning', "This isn't your comment");
            return redirect('/');
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
        $comment = Comment::find($id);
        if ($comment->name == Auth::user()->username){
            $this->validate($request, array('comment' => 'required'));
            $comment->comment = $request->comment;
            $comment->save();

            Session::flash('success', 'Comment updated');
            return redirect('/');
        }
        else{
            Session::flash('warning', "This isn't your comment");
            return view('/');

        }
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        return view('comments.delete')->withComment($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment->name == Auth::user()->username){
            $post_id = $comment->post->id;
            $comment->delete();
            Session::flash('success', 'Deleted Comment!');
            return redirect('/');
        }
        else{
            Session::flash('warning', "This isn't your comment");
            return redirect('/');
        }
    }
}
