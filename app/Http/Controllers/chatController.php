<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chatController extends Controller
{
    public function getChat(){
    	return view('chat.chat');
    }
}
