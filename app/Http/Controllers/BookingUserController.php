<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BookingUserController extends Controller
{
    public function welcome()
    {
        $lapangans = Lapangan::where('status', 1)->get();
        // dd($lapangans);
        return view('user.welcome', compact('lapangans'));
    }
    public function jadwal(){
        $lapangans = Lapangan::where('status', 1)->get();
        $bookings = Booking::with('lapangan','user')->where('status',0)->get();
        return view('user.jadwal', compact('bookings','lapangans'));
    }
    public function index()
    {
        $bookings = Booking::with('lapangan')->where('user_id', auth()->user()->id)->get();
        return view('user.index', compact('bookings'));
    }
    public function create()
    {
        $lapangans = Lapangan::where('status', 1)->get();
        return view('user.create', compact('lapangans'));
    }
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
            return redirect()->route('bookinguser.index')->with('payment', $imageName);
        } catch (\Throwable $th) {
            // Handle exception
            Alert::error('Error', 'Please fill all the fields!');
            return redirect()->back();
        }
    }
}
