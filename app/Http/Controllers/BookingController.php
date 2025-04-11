<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with('barber', 'service', 'menu') // Include related models
          ->where('user_id', Auth::id())
          ->get();
        $services = Services::all(); // Ambil semua layanan

        return view('bookings.index',compact('bookings', 'services')); // Kirim data bookings dan services ke view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barbers = Barber::all();
        $services = Services::all();
        $user = User::all();
        $menus = Menu::all();
        
        // dd($barbers, $services); 
        return view('bookings.create', [
          'barbers' => $barbers,
          'services' => $services,
          'user' => $user,
          'menus' => $menus // Pass the authenticated user to the view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookingRequest  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
         $user = Auth::user();
     
         // Validasi form
         $request->validate([
             'date' => 'required|date',
             'time' => 'required|date_format:H:i',
             'barber_id' => 'required|exists:barbers,id',
             'services_id' => 'required|exists:services,id',
             'menu_id' => 'nullable|exists:menus,id', // Pastikan menu_id valid jika dipilih
         ]);
     
         // Debug: Periksa apakah menu_id ada di request
         Log::info('Received menu_id:', ['menu_id' => $request->menu_id]);
     
         // Simpan booking
         $booking = new Booking([
             'booking_date' => $request->date,
             'booking_time' => $request->time,
             'barber_id' => $request->barber_id,
             'services_id' => $request->services_id,
             'menu_id' => $request->menu_id, // Pastikan menu_id diterima dan disimpan
         ]);
     
         // Set user_id
         $booking->user_id = $user->id;
         $booking->save();
     
         return redirect()->route('bookings.index')->with('message', 'Booking created successfully');
     }
     

     
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Booking $booking)
    {
        $customer = User::where('phone', $request->phone)->first();

        if (!$customer) {
            return redirect()->route('bookings.index')->with('message', 'Customer not found.');
        }

        if ($customer->id === $booking->customer_id) {
            return view('bookings.show')->with('booking', $booking);
        } else {
            return redirect()->route('bookings.index')->with('message', 'You do not have access to this booking.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookingRequest  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
   
    public function history(Request $request)
    {
        $bookings = Booking::with(['barber', 'service', 'menu'])
        ->orderBy('booking_date', 'desc')
        ->get();

        $query = Booking::with(['barber', 'service', 'menu'])  // Include 'barber', 'service', 'menu' relations
                        ->orderBy('booking_date', 'desc');  // Sort by booking date (latest first)

        // If a status is provided, filter by that status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get the filtered bookings
        $bookings = $query->get();

        // Dump the result for debugging (optional)
        // dd($bookings);

        // Return the view with bookings
        return view('bookings.history', compact('bookings'));
    }

    

    
    public function cancel(Booking $booking)
    {
        if ($booking->status === 'Ongoing') {
            $booking->status = 'Cancelled';
            $booking->save();
        }

        return redirect()->route('bookings.history')->with('success', 'Booking telah dibatalkan');
    }
}
