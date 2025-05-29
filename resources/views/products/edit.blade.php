@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Edit Product
    </h2>
@endsection

@section('content')
<div class="table-container">
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group-wrapper">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" class="form-input rounded-md shadow-sm mt-1 block dark:bg-gray-700 dark:text-white" value="{{ $product->name }}" required>
        </div>

        <div class="form-group-wrapper">
            <label for="category">Category</label>
            <textarea id="category" name="category" rows="4" class="form-input rounded-md shadow-sm mt-1 block dark:bg-gray-700 dark:text-white" required>{{ $product->category }}</textarea>
        </div>

        <div class="form-group-wrapper">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" class="form-input rounded-md shadow-sm mt-1 block dark:bg-gray-700 dark:text-white" value="{{ $product->price }}" required>
        </div>

        <button type="submit" class="btn">Update Product</button>
    </form>
</div>
@endsection
