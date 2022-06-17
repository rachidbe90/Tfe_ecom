<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 *
 */
class ConditionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function condition(){
        return view('frontend.pages.conditions');
    }
}
