<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminApprovalController extends Controller
{
    public function index()
    {
        $pendingUsers = User::whereIn('status', ['pending', 'blocked'])->paginate(3);
        return view('admin.accounts.approval', compact('pendingUsers'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();
        return back()->with('success', 'User approved.');
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'blocked';
        $user->save();
        return back()->with('success', 'User blocked.');
    }

    public function setRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();
        return back()->with('success', 'Role updated.');
    }
}

