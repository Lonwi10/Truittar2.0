<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use Session;

class chatController extends Controller
{
    public function getChat(){
    	
    	$users = User::all();
    	return view('chat.chat')->withUsers($users);
    
    }
}
