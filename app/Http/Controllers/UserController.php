<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view( 'server.users', data: compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        if($request->password_confirmation == $validated['password']){
            $validated['password'] = Hash::make($validated['password']);
            $validated['role'] = $request->role;

            User::create($validated);
        }

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $validated = $request->validated();
        $user = User::findOrFail($id);

        if (!Hash::check($validated['password'], $user->password)) {
            return back()->withErrors(['password' => 'The current password is incorrect.'])->withInput();
        }

        if (!empty($validated['password']) && $request->new_password !== $request->password_confirmation) {
            return back()->withErrors(['password_confirmation' => 'The password confirmation does not match.'])->withInput();
        }

        if (!empty($validated['password']) && !empty($request->new_password)) {
            $validated['password'] = Hash::make($request->new_password);
        } else {
            unset($validated['password']);
        }

        // dd($validated);

        $user->update($validated);

        return redirect()->back()->with('success', 'User berhasil diedit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
