<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Mail;
use Session;

class PagesController extends Controller
{
    public function getIndex() {
        # process variable data or params
        # talk to the model
        # recieve from the model
        # compile or process data from the model if needed
        # pass that data to the correct view
        $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
        return view('pages.welcome')->withPosts($posts);
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
            //'survey' = ['Q1' => 'hello', 'Q2' => 'YES']
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
