<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AttachUserRole extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('user')->with([
            'title' => 'Add Roles To Users',

            'users' => $users
        ]);
    }

    public function user($id)
    {
        $user = User::find($id);

        $user->type = 0;
        $user->save();


        return redirect()->back()->with('success', 'Successfully added user role to: ' . $user->name);
    }

    public function admin($id)
    {
        $user = User::find($id);

        $user->type = 1;
        $user->save();


        return redirect()->back()->with('success', 'Successfully added admin role to: ' . $user->name);
    }

    public function verifier($id)
    {
        $user = User::find($id);

        $user->type = 2;
        $user->save();


        return redirect()->back()->with('success', 'Successfully added verifier role to: ' . $user->name);
    }
}
