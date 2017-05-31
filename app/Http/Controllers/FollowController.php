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
    	$comprobacion = Follower::where('follower', Auth::user()->username)->where('followed', $followed);
    	if($comprobacion->count()==0){
	        $Follower = new Follower();
	        $Follower->follower = Auth::user()->username;
	        $Follower->followed = $followed;
	        $Follower->save();
        	return redirect('/');
        }
        else{
        	Session::flash('warning', 'You are already following user');
        	return redirect('/');
        }
    }

    public function deleteFollowers($usuario){
    	$comprobacion = Follower::where('follower', Auth::user()->username)->where('followed', $usuario);
    	if($comprobacion->count()==1){
	    	$Follower = Follower::where('follower', Auth::user()->username)->where('followed', $usuario);
	        $Follower->delete();
	        Session::flash('success', 'Unfollowed!');
	        return redirect('/');
    	}
    	else{
    		Session::flash('warning', 'You are not following this user');
        	return redirect('/');
    	}
    }
}
