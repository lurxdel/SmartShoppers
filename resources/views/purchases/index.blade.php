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
            <form action="{{ route('purchases.store') }}" method="POST" class="purchase-form">
                @csrf
                <label for="product_id">Product:</label>
                <select name="product_id" id="product_id" class="rounded-md shadow-sm mt-1 dark:bg-gray-700 dark:text-white" required>
                    <option value="">Select Product</option>
                    @foreach($products as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <label for="customer_id">Customer:</label>
                <select name="customer_id" id="customer_id" class="rounded-md shadow-sm mt-1 dark:bg-gray-700 dark:text-white" required>
                    <option value="">Select Customer</option>
                    @foreach($customers as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" class="rounded-md shadow-sm mt-1 dark:bg-gray-700 dark:text-white" value="1" min="1" required>

                <button type="submit" class="create-button">Save Purchase</button>

            </form>
        </div>
    </div>

    <div class="form-group-wrapper">
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <form method="GET" action="{{ route('purchases.index') }}" class="flex gap-4 items-center">
                Products:
                <input type="text" name="product_name" placeholder="Search products..." value="{{ request('product_name') }}"
                    class="border border-gray-300 rounded px-4 py-2 dark:bg-gray-700 dark:text-white" style="width: 190px;">
                Customers:
                <input type="text" name="customer_name" placeholder="Search customers..." value="{{ request('customer_name') }}"
                    class="border border-gray-300 rounded px-4 py-2 dark:bg-gray-700 dark:text-white" style="width: 190px;">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" style="background-color: #007bff;">Search</button>
            
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
                <th>Purchase Date</th>
                <th>Staff</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse ($purchases as $purchase)
                <tr>
                    <td>{{ ($purchases->currentPage() - 1) * $purchases->perPage() + $loop->iteration }}</td>
                    <td>{{ $purchase->customer->name }}</td>
                    <td>{{ $purchase->product->name }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                    <td>
                        {{ $purchase->user->name ?? 'N/A' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No purchases found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
            {{ $purchases->links() }}
    </div>

</div>

@endsection