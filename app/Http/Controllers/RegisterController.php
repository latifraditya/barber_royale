<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function register(Request $request)
    {
        $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'phone_number' => $request->phone_number,
          'password' => bcrypt($request->password),
           // Pastikan ini disertakan
      ]);
        // Redirect ke halaman booking
        return redirect('/login')->with('success','Anda sudah terdaftar, silakan memesan.'); // Pastikan sudah membuat route untuk booking
    }
}
