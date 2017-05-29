<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Follower;
use Session;

class FollowController extends Controller
{
    public function storeFollowers($followed){
        $Follower = new Follower();
        $Follower->follower = Auth::user()->username;
        $Follower->followed = $followed;
        $Follower->save();

        return redirect('/');
    }

    public function deleteFollowers($usuario){
    	$Follower = Follower::where('follower', Auth::user()->username)->where('followed', $usuario);
        $Follower->delete();
        Session::flash('success', 'Unfollowed!');
        return redirect('/');
    }
}
