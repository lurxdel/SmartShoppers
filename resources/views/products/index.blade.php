@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Product List
    </h2>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/entities.css') }}">

<div class="table-container">
    <div class="top-actions">
        <a href="{{ route('products.create') }}" class="create-button">+ Create Product</a>
    </div>

    <div class="form-group-wrapper">
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <form method="GET" action="{{ route('products.index') }}" class="flex gap-4">
                <input type="text" name="search" placeholder="Search product name or address..." value="{{ request('search') }}"
                    class="border border-gray-300 rounded px-4 py-2 dark:bg-gray-700 dark:text-white">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" style="background-color: #b2b81d;">Search</button>
            </form>
            
            <a href="{{ route('products.pdf', ['search' => request('search')]) }}"
                class="ml-4 px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700"
                style="background-color:#b2b81d;" target="_blank">
                View PDF
            </a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>₱{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn">Edit</a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" 
                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
            {{ $products->links() }}
    </div>
</div>
@endsection