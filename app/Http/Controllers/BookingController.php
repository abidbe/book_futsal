<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('user', 'lapangan')->latest()->filter(request(['search']))->paginate(8)->withQueryString();
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
            // Ambil data dari form
            $lapangan_id = $request->lapangan_id;
            $from = $request->from;
            $to = $request->to;

            // Cek apakah ada double booking
            $existingBookings = Booking::where('lapangan_id', $lapangan_id)
                ->where(function ($query) use ($from, $to) {
                    $query->where(function ($query) use ($from, $to) {
                        $query->where('from', '<=', $from)
                            ->where('to', '>', $from);
                    })
                        ->orWhere(function ($query) use ($from, $to) {
                            $query->where('from', '<', $to)
                                ->where('to', '>=', $to);
                        })
                        ->orWhere(function ($query) use ($from, $to) {
                            $query->where('from', '>=', $from)
                                ->where('to', '<=', $to);
                        });
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
    public function success(Booking $booking)
    {
        $booking->timestamps = false;
        $booking->status = 1;
        $booking->save();
        Alert::success('Success', 'Booking success!');
        return back();
    }
    public function cancel(Booking $booking)
    {
        $booking->timestamps = false;
        $booking->status = 0;
        $booking->save();
        Alert::success('Success', 'Booking canceled!');
        return back();
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
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $lapangans = Lapangan::where('status', 1)->get();

        return view('admin.booking.edit', compact('booking', 'lapangans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
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
                // Hapus gambar sebelumnya jika ada
                if ($booking->payment) {
                    Storage::delete('public/booking/' . $booking->payment);
                }
            } else {
                $imageName = $booking->payment;
            }

            // Validasi agar tidak bertabrakan waktunya
            // Ambil data dari form
            $lapangan_id = $request->lapangan_id;
            $from = $request->from;
            $to = $request->to;

            // Cek apakah ada double booking
            $existingBookings = Booking::where('lapangan_id', $lapangan_id)
                ->where(function ($query) use ($from, $to, $id) {
                    $query->where(function ($query) use ($from, $to) {
                        $query->where('from', '<=', $from)
                            ->where('to', '>', $from);
                    })
                        ->orWhere(function ($query) use ($from, $to) {
                            $query->where('from', '<', $to)
                                ->where('to', '>=', $to);
                        })
                        ->orWhere(function ($query) use ($from, $to) {
                            $query->where('from', '>=', $from)
                                ->where('to', '<=', $to);
                        });
                })
                ->where('id', '!=', $id)
                ->count();

            if ($existingBookings > 0) {
                Alert::error('Error', 'Lapangan sudah dibooking pada waktu tersebut.');
                return redirect()->back();
            }

            // Update booking
            $booking->update([
                'lapangan_id' => $lapangan->id,
                'from' => $request->from,
                'to' => $request->to,
                'payment' => $imageName,
            ]);
            Alert::success('Success', 'Booking updated successfully!');
            return redirect()->route('booking.index')->with('payment', $imageName);
        } catch (\Throwable $th) {
            // Handle exception
            Alert::error('Error', 'Please fill all the fields!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // dd($booking);
        $booking->delete();
        Alert::success('Success', 'Booking deleted successfully!');
        return back();
    }
}
