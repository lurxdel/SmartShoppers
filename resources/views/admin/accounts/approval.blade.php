@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Pending Accounts Approval
    </h2>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/entities.css') }}">

<div class="table-container">
    @if (session('status'))
        <div class="mb-4 text-green-500">
            {{ session('status') }}
        </div>
    @endif

    @if ($pendingUsers->isEmpty())
        <p>No pending users.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingUsers as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('accounts.approve', $user->id) }}" method="POST">
                                @csrf
                                <select name="role" class="rounded-md shadow-sm mt-1 dark:bg-gray-700 dark:text-white" required>
                                    <option value="staff">Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="user">User</option>
                                </select>
                                <button type="submit" class="mt-2 px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700"
                            style="background-color: #b2b81d;">Approve</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $pendingUsers->links() }}
        </div>
    @endif
</div>
@endsection