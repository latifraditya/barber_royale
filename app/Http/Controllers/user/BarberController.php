<?php

namespace App\Http\Controllers\user;

use App\Models\Barber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BarberController extends Controller
{
     // Show a list of all barbers for the user
     public function index()
     {
         $barbers = Barber::all(); // Get all barbers
         return view('user.barbers.index', compact('barbers'));
     }
 
     // Show the details of a single barber for the user
     public function show(Barber $barber)
     {
         return view('user.barbers.show', compact('barber'));
     }
}
