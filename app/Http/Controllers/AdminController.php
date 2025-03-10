<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all()
        ->where('status', 'admin');
        return view('dashboard.admin', compact('users'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username','alpha_num'],
            'phone' => ['required', 'string','max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()]
        ]);
        // dd($request);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'status' => 'admin',
            'email_verified_at' => now(),
        ]);

            event(new Verified($user));
            return redirect('/admin');

    }

    // Update User
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|alpha_num|unique:users,username,'.$id,
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);
        if ($request->password) {
            $request->validate([
                'password' => Rules\Password::defaults()
            ]);
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return response()->json(['message' => 'User updated successfully']);
    }

    // Delete User
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
