<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 *
 */
class ReturnController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function return(){
        return view('frontend.pages.return');
    }
}
