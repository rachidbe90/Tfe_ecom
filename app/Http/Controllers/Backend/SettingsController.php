<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

/**
 *
 */
class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function settings(){
        $setting=Settings::first();
        return view('backend.settings.settings',compact('setting'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function settingsUpdate(Request $request){
        $setting=Settings::first();
        $status=$setting->update([
            'title'=>$request->title,
            'meta_description'=>$request->meta_description,
            'meta_keywords'=>$request->meta_keywords,
            'favicon'=>$request->favicon,
            'logo'=>$request->logo,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'footer'=>$request->footer,
            'facebook_url'=>$request->facebook_url,
            'twitter_url'=>$request->twitter_url,
            'linkedin_url'=>$request->linkedin_url,
            'pinterest_url'=>$request->pinterest_url,
        ]);
        if($status){
            return back()->with('success','Setting successfully updated');
        }
        else{
            return back()->with('error','Something went wrong');
        }
    }



    //paypal

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function payment(){
        return view('backend.settings.payment');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paypalUpdate(Request $request){
        foreach($request->types as $key=>$type){
            $this->overWriteEnvFile($type,$request[$type]);
        }

        $settings=Settings::first();
        if($request->has('paypal_sandbox')){
            $settings->paypal_sandbox=1;
            $settings->save();
        }
        else{
            $settings->paypal_sandbox=0;
            $settings->save();
        }

        return back()->with('success','Payment setting updated successfully');
    }

    // Mail

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function smtp(){
        return view('backend.settings.smtp');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function smtpUpdate(Request $request){
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }


        return back()->with('success','SMTP configuration updated successfully');
    }

    /**
     * @param $type
     * @param $val
     * @return void
     */
    public function overWriteEnvFile($type, $val){
        if(env('DEMO_MODE') != 'On'){
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"'.trim($val).'"';
                if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                    file_put_contents($path, str_replace(
                        $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                    ));
                }
                else{
                    file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
                }
            }
        }
    }
}
