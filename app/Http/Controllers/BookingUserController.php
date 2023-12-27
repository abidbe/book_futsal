<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class BookingUserController extends Controller
{
    public function welcome()
    {
        $lapangans = Lapangan::where('status', 1)->orderBy('no','asc')->get();
        // dd($lapangans);
        return view('user.welcome', compact('lapangans'));
    }
    public function jadwal()
    {
        $lapangans = Lapangan::where('status', 1)->get();
        $bookings = Booking::with('lapangan', 'user')->where('status', 0)->get();
        return view('user.jadwal', compact('bookings', 'lapangans'));
    }
    public function showjadwal($id, Request $request)
    {
        $lapangans = Lapangan::findOrFail($id);

        if ($request->ajax()) {
            // Mengambil tanggal dari input request atau menggunakan today() jika tidak ada
            $from = $request->filled('from') ? Carbon::createFromFormat('Y-m-d', $request->from) : now()->startOfDay();

            // Memastikan tanggal 'from' berada dalam rentang yang sesuai
            $bookings = Booking::with('lapangan', 'user')
                ->where('lapangan_id', $id)
                ->where('status', 1)
                ->whereDate('from', '>=', $from)
                ->whereDate('from', '<', $from->copy()->addDay()->startOfDay())
                ->orderBy('from', 'asc') 
                ->get();

            return DataTables::of($bookings)
                ->addIndexColumn()
                ->make(true);
        }

        return view('user.showjadwal', compact('lapangans'));
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
            return redirect()->route('bookinguser.index')->with('payment', $imageName);
        } catch (\Throwable $th) {
            // Handle exception
            Alert::error('Error', 'Please fill all the fields!');
            return redirect()->back();
        }
    }
    public function destroy(Booking $bookinguser)
    {
        // dd($bookinguser);
        $bookinguser->delete();
        Alert::success('Success', 'Booking deleted successfully!');
        return back();
    }
}
