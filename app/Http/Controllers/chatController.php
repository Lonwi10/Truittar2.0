<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use Session;
use Auth;

class chatController extends Controller
{
    public function getChat(){
    	
    	$users = User::where('id', '!=', Auth::user()->id)->get();
    	return view('chat.chat')->withUsers($users);
    
    }
}
