<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Follower;
use Mail;
use Session;
use Auth;

class PagesController extends Controller
{
    public function getIndex() {

        $posts = Post::orderBy('created_at', 'desc')->get();
        $users = User::all();
        
        if(Auth::check()){  
            $people = User::where('id', '!=', Auth::user()->id)->get();
            $followers = Follower::where('follower', '=', Auth::user()->username)->get();
            return view('pages.welcome')->withPosts($posts)->withUsers($users)->withPeople($people)->withFollowers($followers);
        }
        else{
         return view('pages.welcome')->withPosts($posts)->withUsers($users);
        }
    }
    public function getAbout() {
        $first = 'Grupo';
        $last = 'Sintesis';
        $full = $first . "  " .$last;
        //return view('pages.about')->with("fullname", $full);
        $email = 'truittarcontact@gmail.com';
        //return view('pages.about')->withFullname($full)->withEmail($email);
        $data = [];
        $data['email'] = $email;
        $data['fullname'] = $full;
        return view('pages.about')->withData($data);
    }
    public function getContact() {
        return view('pages.contact');
    }

    public function postContact(Request $request) {
        $this->validate($request, array(
            'email' => 'required|email',
            'subject' => 'min:3',
            'message' => 'min:10'
        ));

        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        );
        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            //$message->reply_to();
            //$message->cc();
            //$message->attach();
            $message->to('truittarcontact@gmail.com');
            $message->subject($data['subject']);
        });

        Session::flash('Correcto', 'Tu mensaje ha sido enviado!');
        return redirect('/');
    }


}
