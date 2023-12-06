<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapangans = Lapangan::latest()->filter(request(['search']))->paginate(10)->withQueryString();
        
        return view('admin.lapangan.index', compact('lapangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lapangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'no' => 'required|unique:lapangans',
                'price' => 'required|numeric',
                'status' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->storeAs('public/lapangan', $imageName);
            } else {
                $imageName = null;
            }
            Lapangan::create([
                'no' => $request->no,
                'price' => $request->price,
                'status' => $request->status,
                'image' => $imageName,
            ]);
            Alert::success('Success', 'Lapangan created successfully!');
            return redirect()->route('lapangan.index')->with('image', $imageName);
        } catch (\Throwable $th) {
            Alert::error('Error', 'Please fill all the fields!');
            return back();
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Lapangan $lapangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lapangan $lapangan)
    {   

        return view('admin.lapangan.edit', compact('lapangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lapangan $lapangan)
    {
        try {
            $request->validate([
                'no' => 'required',
                'price' => 'required|numeric',
                'status' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->storeAs('public/lapangan', $imageName);
            } else {
                $imageName = $lapangan->image;
            }
            $lapangan->update([
                'no' => $request->no,
                'price' => $request->price,
                'status' => $request->status,
                'image' => $imageName,
            ]);
            Alert::success('Success', 'Lapangan updated successfully!');
            return redirect()->route('lapangan.index')->with('image', $imageName);
        } catch (\Throwable $th) {
            Alert::error('Error', 'Please fill all the fields!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lapangan $lapangan)
    {
        $lapangan->delete();
        Alert::success('Success', 'Lapangan deleted successfully!');
        return back();
    }
}
