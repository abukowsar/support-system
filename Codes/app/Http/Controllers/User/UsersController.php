<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updatePassword(Request $request){
        $user = auth()->user();

        $validator= \Validator::make($request->all(), [

            'password' => 'required|min:8|confirmed|max:191',
            ],['password.required'=>'The change password field is required.',
                'password.confirmed'=>"The password confirmation does not match."
        ]);

        if ($validator->fails()) {
            return \Response::json(
                [
                    'status'  => false,
                    'message' => $validator->getMessageBag()->toArray()
                ]
            );
        }

        $user->fill([
            'password' => Hash::make($request->password)
            ])->save();
        \Auth::logout();

        return response()->json(array('status' => true,'redirect_url'=>route('home')));
    }
}
