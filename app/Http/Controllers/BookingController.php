<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Services;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Log;
use App\Services\TransactionService;
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

         $transaction = $this->storeTransaction($booking);  // Menyimpan transaksi
         $this->storeTransactionDetails($transaction, $booking);

     
         return redirect()->route('bookings.index')->with('message', 'Booking created successfully');
     }
     
     public function storeTransaction(Booking $booking)
     {
         // Hitung total sebelum pajak, pajak, dan total setelah pajak
         $totalBeforeTax = $booking->service->price + ($booking->menu ? $booking->menu->price : 0);
         $taxPercent = 0.1; // Contoh pajak 10%
         $taxAmount = $totalBeforeTax * $taxPercent;
         $totalAfterTax = $totalBeforeTax + $taxAmount;
     
         // Simpan transaksi utama dengan memasukkan nilai untuk kolom tax_percent
         $transaction = Transaction::create([
             'booking_id' => $booking->id,
             'total_before_tax' => $totalBeforeTax,
             'tax_percent' => $taxPercent * 100,  // Pastikan tax_percent dalam bentuk persen (misal 10%)
             'total_after_tax' => $totalAfterTax,
         ]);
     
         // Log untuk memastikan transaksi sudah disimpan
        //  Log::info('Transaction saved:', [
        //      'transaction_id' => $transaction->id,
        //  ]);
     
         return $transaction;
     }
     

    public function storeTransactionDetails(Transaction $transaction, Booking $booking)
{
    // Simpan detail transaksi untuk layanan
    $transactionDetailService = TransactionDetail::create([
        'transaction_id' => $transaction->id,
        'item_type' => 'service',
        'item_id' => $booking->service->id,
        'item_name' => $booking->service->name,
        'item_price' => $booking->service->price,
    ]);

    // Jika ada menu, simpan detail transaksi untuk menu
    if ($booking->menu) {
        $transactionDetailMenu = TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'item_type' => 'menu',
            'item_id' => $booking->menu->id,
            'item_name' => $booking->menu->name,
            'item_price' => $booking->menu->price,
        ]);
    }
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Booking $booking)
    {
        
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
        ->orderBy('id', 'desc')
        ->get();

        $query = Booking::with(['barber', 'service', 'menu'])  // Include 'barber', 'service', 'menu' relations
                        ->orderBy('id', 'desc');  // Sort by booking date (latest first)

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
