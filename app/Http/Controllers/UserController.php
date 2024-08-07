<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // Profile
    public function profile(Request $request)
    {
        // Return authenticated user
        $profile = $request->user();

        return view('pages.auth.profile', compact('profile'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $users = DB::table('users')->when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->keyword}%")
                ->orWhere('email', 'like', "%{$request->keyword}%")
                ->orWhere('phone', 'like', "%{$request->keyword}%");
        })->orderBy('id', 'desc')->paginate(10);

        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]
        );
        User::create($request->all());
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $user->name = $request->name;
        $user->email = $request->email;

        $user->role = $request->role;
        $user->save();
        // Check if phone is not empty
        if ($request->phone) {
            $user->update(['phone' => $request->phone]);
        }
        // Check if password is not empty
        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
