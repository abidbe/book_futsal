<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('user', 'lapangan')->get();
        // dd($bookings);
        return view('admin.booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lapangans = Lapangan::where('status', 1)->get();
        return view('admin.booking.create', compact('lapangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $lapangan = Lapangan::findOrFail($request->lapangan_id);
            $request->validate([
                'lapangan_id' => 'required',
                'from' => 'required',
                'to' => 'required|after:from',
                'payment' => 'nullable|image|mimes:jpg,png,jpeg'
            ]);

            if ($request->hasFile('payment')) {
                $imageName = time() . '.' . $request->payment->extension();
                $request->payment->storeAs('public/booking', $imageName);
            } else {
                $imageName = null;
            }

            // Validasi agar tidak bertabrakan waktunya
            $existingBookings = Booking::where('lapangan_id', $request->lapangan_id)
                ->where(function ($query) use ($request) {
                    $query->where('from', '<=', $request->from)
                        ->where('to', '>=', $request->to);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('from', '>=', $request->from)
                        ->where('from', '<', $request->to);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('to', '>', $request->from)
                        ->where('to', '<=', $request->to);
                })
                ->count();
            // dd($existingBookings);
            if ($existingBookings > 0) {
                Alert::error('Error', 'Lapangan sudah dibooking pada waktu tersebut.');
                return redirect()->back();
            }

            // Simpan booking
            Booking::create([
                'user_id' => auth()->user()->id, // Ambil id user yang login
                'lapangan_id' => $lapangan->id,
                'from' => $request->from,
                'to' => $request->to,
                'payment' => $imageName,
            ]);
            Alert::success('Success', 'Booking created successfully!');
            return redirect()->route('booking.index')->with('payment', $imageName);
        } catch (\Throwable $th) {
            // Handle exception
            Alert::error('Error', 'Please fill all the fields!');
            return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
