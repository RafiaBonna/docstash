<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
   public function index () {
    $users =Role::with('users')->get();
    // dd($users);
    // return $users;
    return view('user', compact('users'));
   }
}
