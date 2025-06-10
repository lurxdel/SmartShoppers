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

                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" class="rounded-md shadow-sm mt-1 dark:bg-gray-700 dark:text-white" value="1" min="1" required>

                <button type="submit" class="create-button">Save Purchase</button>

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
                </tr>
            @empty
                <tr>
                    <td colspan="7">No purchases found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
            {{ $purchases->links() }}
    </div>

</div>

@endsection