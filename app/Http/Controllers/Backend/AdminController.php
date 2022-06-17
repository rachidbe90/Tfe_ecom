<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class AdminController extends Controller
{
    /**
     * dans cette fonction j'envoie la liste des orderes (commandes) la plus récente en premier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function admin(){
        $orders=Order::orderBy('id','DESC')->get();
        return view('backend.index',compact('orders'));
    }

    // Admin profile

    /**
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profile(){
        return view('backend.profile.index');
    }

    // Admin profile update

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function profileUpdate(Request $request, $id){
        $this->validate($request,[
            'first_name'=>'string|required',
            'last_name'=>'string|required',
        ]);
        $admin=Admin::find($id);

        $data=$request->all();

        $status=$admin->fill($data)->save();
        if($status){
            return redirect()->back()->with('success','Successfully updated your profile');
        }
        else{
            return redirect()->back()->with('error','Something went wrong');

        }
    }

    // Admin password change

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function changePassword(){
        return view('backend.profile.change-password');
    }

    // Admin password store

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','min:6'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $status=Admin::find(auth('admin')->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        if($status){
            return redirect()->route('admin')->with('success','Successfully changed password');

        }
        else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }
}
