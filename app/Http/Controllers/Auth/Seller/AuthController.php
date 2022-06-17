<?php

namespace App\Http\Controllers\Auth\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class AuthController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm(){
        return view('seller.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request){
        $request->validate([
            'email'=>'email|required',
            'password'=>'required|min:4'
        ]);
        if(Auth::guard('seller')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->intended(route('seller'))->with('success','You are logged in as seller');
        }
        return back()->withInput($request->only('email'));
    }
}
