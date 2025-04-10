<?php

namespace App\Http\Controllers\user;

use App\Models\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
  public function index()
  {
      $services = Services::all();  // Get all services
      return view('user.services.index', compact('services'));
  }

  // Show details for a single service
  public function show(Services $service)
  {
      return view('user.services.show', compact('service'));
  }
}
