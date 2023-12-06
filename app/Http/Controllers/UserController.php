<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'asc')->latest()->where('id', '!=', '1')->filter(request(['search']))->paginate(10)->withQueryString();
        return view('admin.user.index', compact('users'));
    }
    public function makeadmin(User $user)
    {
        $user->timestamps = false;
        $user->is_admin = true;
        $user->save();
        Alert::success('Success', 'Make admin successfully!');
        return back();
    }
    //untuk menjadikan user
    public function removeadmin(User $user)
    {
        if ($user->id != 1) {
            $user->timestamps = false;
            $user->is_admin = false;
            $user->save();
            Alert::success('Success', 'Remove admin successfully!');
            return back();
        } else {

            return redirect()->route('user.index');
        }
    }
    public function destroy(User $user)
    {
        if ($user->id != 1) {
            $user->delete();
            Alert::success('Success', 'User deleted successfully!');
            return back();
        } else {
            return redirect()->route('user.index');
        }
    }
}
