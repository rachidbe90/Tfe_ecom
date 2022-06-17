<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 *
 */
class PriveController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function prive(){
        return view('frontend.pages.prive');
    }
}
