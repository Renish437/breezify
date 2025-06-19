<?php

namespace CodesRen\Breezify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('breezify::profile.edit', [
            'user' => $request->user(),
        ]);
    }
}