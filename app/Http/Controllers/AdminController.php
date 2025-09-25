<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function account()
    {
        $account = User::where('role', 'author')->get();
        return view('account', compact('account'));
    }
    public function create(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:account',
            'name' => 'required|string|max:255',
            'password' => 'required|string|confirmed',
        ]);
        User::create($validated);
        return redirect()->back()->with('success', 'Account created successfully.');
    }
    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|confirmed',
        ]);
        User::findOrFail($id)->update([
            'username' => $validated['username'],
            'name' => $validated['name'],
            'password' => isset($validated['password']) ? bcrypt($validated['password']) : User::findOrFail($id)->password,
        ]);
        return redirect()->back()->with('success', 'Account updated successfully.');
    }
    public function delete($id)
    {
        User::where('username', $id)->delete();
        return redirect()->back()->with('success', 'Account deleted successfully.');
    }
}
