<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Failed to create user. Please try again.');
        }
        
        return redirect()->route('login')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $user->name = $validatedData['name'];

        $user->save();

        return redirect()->route('users.show', $user)->with('success', 'User updated successfully.');

    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        return redirect()->route('users.login')->with('success', 'User deleted successfully.');
    }
    
    /**
     * Show the change password.
     */
    public function changePassword(Request $request, User $user)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string|min:8|same:new_password',
        ]);

        if (!Auth::attempt(['email' => $user->email, 'password' => $validatedData['current_password']])) {
            return redirect()->back()->withInput()->with('error', 'Current password is incorrect.');
        }
        $user->password = bcrypt($validatedData['new_password']);
        $user->save();
        return redirect()->route('users.show', $user)->with('success', 'Password changed successfully.');
    }

     /**
     * Show the login form.
     */
    public function login()
    {
        return view('users.login');
    }

    /**
     * Log in the specified user.
     */
    public function processLogin(User $user)
    {
        // This method would typically handle the login logic, such as validating credentials and starting a session.
        request()->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request()->only('email', 'password');
        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            return redirect()->route('items.index')->with('success', 'User logged in successfully.');
        }
        
        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }

     /**
     * Log out the specified user.
     */
    public function logout(User $user)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'User logged out successfully.');
    }
}
