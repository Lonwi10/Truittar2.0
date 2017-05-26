<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Follower;

class FollowController extends Controller
{
    public function storeFollowers($followed){
        $Follower = new Follower();
        $Follower->follower = Auth::user()->username;
        $Follower->followed = $followed;
        $Follower->save();

        return redirect('/');
    }
}
