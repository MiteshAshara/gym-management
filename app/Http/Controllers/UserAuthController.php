<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAuthController extends Controller
{
  public function index()
  {
    return view("user.auth.login");
  }
  public function registration()
  {
    return view("user.auth.register");
  }
 
}
