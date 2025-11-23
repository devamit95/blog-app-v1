<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
        $this->middleware('audit');
    }

    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,user',
        ]);

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success','User updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success','User deleted.');
    }

}
