<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getAccount()
    {
        return view('Account.account', ['account' => Auth::account()]);
    }

    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
           'first_name' => 'required|max:120'
        ]);

        $account = Auth::account();
        $old_name = $account->first_name;
        $account->first_name = $request['first_name'];
        $account->update();
        $file = $request->file('image');
        $filename = $request['first_name'] . '-' . $account->id . '.jpg';
        $old_filename = $old_name . '-' . $account->id . '.jpg';
        $update = false;
        if (Storage::disk('local')->has($old_filename)) {
            $old_file = Storage::disk('local')->get($old_filename);
            Storage::disk('local')->put($filename, $old_file);
            $update = true;
        }
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        if ($update && $old_filename !== $filename) {
            Storage::delete($old_filename);
        }
        return redirect()->route('account');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}
