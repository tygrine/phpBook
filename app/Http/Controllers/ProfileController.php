<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $user = \App\User::findOrFail($user);

        return view('profiles.index', [ 
            'user' => $user,
        ]);
    }
}
