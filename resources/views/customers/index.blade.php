@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Customer List
    </h2>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/entities.css') }}">

<div class="table-container">
    <div class="top-actions">
        <a href="{{ route('customers.create') }}" class="create-button">+ Create Customer</a>
    </div>

    <div class="form-group-wrapper">
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <form method="GET" action="{{ route('customers.index') }}" class="flex gap-4">
                <input type="text" name="search" placeholder="Search customer name or address..." value="{{ request('search') }}"
                    class="border border-gray-300 rounded px-4 py-2 dark:bg-gray-700 dark:text-white">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" style="background-color: #b2b81d;">Search</button>
            </form>
            
            <a href="{{ route('customers.pdf', ['search' => request('search')]) }}"
                class="ml-4 px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700"
                style="background-color: #b2b81d;" target="_blank">
                View PDF
            </a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->gender }}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn">Edit</a>

                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;" 
                            onsubmit="return confirm('Are you sure you want to delete this customer?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
            {{ $customers->links() }}
    </div>
</div>
@endsection