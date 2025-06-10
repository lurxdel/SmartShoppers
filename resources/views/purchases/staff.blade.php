@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Purchase List
    </h2>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/entities.css') }}">

<div class="table-container table-container-wide">

    <div class="form-group-wrapper">
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <form method="GET" action="{{ route('purchases.index') }}" class="flex gap-4 items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product or customer name" 
                class="border border-gray-300 rounded px-4 py-2 dark:bg-gray-700 dark:text-white">
                <button type="submit" class="ml-4 px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700"
                    style="background-color: #007bff;">Search</button>
            </form>
                <a href="{{ route('purchases.pdf', ['product_name' => request('product_name'), 'customer_name' => request('customer_name')]) }}"
                    class="ml-4 px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700"
                    style="background-color: #007bff;" target="_blank">
                    View PDF
                </a>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Purchase Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse ($purchases as $purchase)
                <tr>
                    <td>{{ ($purchases->currentPage() - 1) * $purchases->perPage() + $loop->iteration }}</td>
                    <td>{{ $purchase->customer->name }}</td>
                    <td>{{ $purchase->product->name }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>₱{{ $purchase->total_price }}</td>
                    <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                    <td>{{ $purchase->status }}</td>
                    <td>
                        <form action="{{ route('purchases.staff.update', $purchase->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="rounded-md shadow-sm mt-1 dark:bg-gray-700 dark:text-white">
                                <option value="Pending" {{ $purchase->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Confirmed" {{ $purchase->status === 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="On Delivery" {{ $purchase->status === 'On Delivery' ? 'selected' : '' }}>On Delivery</option>
                            </select>

                            <button type="submit" class="mt-2 px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700"
                            style="background-color: #007bff;">Update</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No purchases found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
            {{ $purchases->links() }}
    </div>

</div>

@endsection