<?php

namespace App\Http\Controllers\user;

use App\Models\Menu;
use App\Models\User;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        // $user->authorizeRoles('user');

        $bookings = Booking::where('user_id', $user->id)
        ->with('barber', 'services')
        ->latest()
        ->simplePaginate(4);

        return view('user.bookings.index')->with('bookings', $bookings);
    }

    public function show(Booking $booking)
    {
        $user = Auth::user();
        // $user->authorizeRoles('user');

        if ($user->id === $booking->user_id) {
            return view('user.bookings.show')->with('booking', $booking);
        }
        else {
            return redirect()->route('user.bookings.index')->with('message', 'You do not have access to this booking.');
        }
    }

    public function create()
    {
        $user = Auth::user();
        // $user->authorizeRoles('user');

        $barbers = Barber::all();
        $services = Services::all();
        $menus = Menu::all();

        return view('user.bookings.create', [
            'barbers' => $barbers,
            'services' => $services,
            'user' => $user,
            'menus' => $menus
        ]);
    }

    public function store(Request $request) 
    {
        $user = Auth::user();

        // Validasi inputan
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'barber_id' => 'required',
            'services_id' => 'required|exists:services,id',
        ]);

        // Buat booking baru
        $booking = new Booking([
            'date' => $request->date,
            'time' => $request->time,
            'barber_id' => $request->barber_id,
            'services_id' => $request->services_id,
        ]);

        $booking->user_id = $user->id; // Set user ID
        $booking->save();

        // Menyimpan menu yang dipilih beserta quantity-nya
        $menus = $request->input('menus', []); // Ambil data dari form

        foreach ($menus as $menuId => $data) {
            if (isset($data['selected']) && isset($data['quantity']) && $data['quantity'] > 0) {
                // Menyimpan data ke pivot table booking_menu
                $booking->menus()->attach($menuId, [
                    'quantity' => $data['quantity'],
                ]);
            }
        }

        if ($booking) {
            return redirect()->route('user.bookings.index')->with('message', 'Booking created successfully. We look forward to seeing you!');
        } else {
            return redirect()->back()->withInput()->with('message', 'Unable to create booking at this time. Please try again later.');
        }
    }


    public function edit(Booking $booking)
    {

        $user = Auth::user();
        // $user->authorizeRoles('user');

        $barbers = Barber::all();
        $services = Services::all();

        return view('user.bookings.edit', ['booking' => $booking])->with('barbers', $barbers)->with('services', $services);
    }

    public function update(Request $request, Booking $booking)
    {

        $user = Auth::user();
        // $user->authorizeRoles('user');

        $formFields = $request->validate([
            'date' => 'required',
            'time' => 'required',
            'barber_id' => 'required',
            'service_id' => 'required' | 'exists:services,id'
        ]);

        $booking->update($formFields);

        if ($booking) {
            return redirect()->route('user.bookings.index')->with('message', 'Your booking has been Updated');
        } 
        else {
            return redirect()->back()->withInput()->with('message', 'Unable to Update booking at this time. Please try again later.');
        }
    }

    public function destroy(Booking $booking)
    {
        $user = Auth::user();
        // $user->authorizeRoles('user');

        $booking->delete();

        if ($booking) {
            return redirect()->route('user.bookings.index')->with('message', 'Your booking has been cancelled');
        } 
        else {
            return redirect()->back()->withInput()->with('message', 'Unable to delete booking at this time. Please try again later.');
        }
    }

    public function cancel(Booking $booking)
    {
        if ($booking->status === 'Ongoing') {
            $booking->status = 'Cancelled';
            $booking->save();
        }

        return redirect()->route('bookings')->with('success', 'Booking telah dibatalkan');
    }
}
