<?php

namespace App\Http\Controllers;

use App\Models\Mylist;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        if (Auth::User()->type == 'editor') {
            $lists = Mylist::with('cards')->get();
            return view('editor.dashboard', compact('lists'));
        } else {
            redirect('/');
        }
    }
}
