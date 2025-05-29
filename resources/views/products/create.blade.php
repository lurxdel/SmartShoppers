@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Create Product
    </h2>
@endsection

@section('content')
<div class="table-container">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group-wrapper">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" class="form-input rounded-md shadow-sm mt-1 block dark:bg-gray-700 dark:text-white" required>
        </div>

        <div class="form-group-wrapper">
            <label for="category">Category</label>
            <textarea id="category" name="category" rows="4" class="form-input rounded-md shadow-sm mt-1 block dark:bg-gray-700 dark:text-white" required></textarea>
        </div>

        <div class="form-group-wrapper">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" class="form-input rounded-md shadow-sm mt-1 block dark:bg-gray-700 dark:text-white" required>
        </div>

        <button type="submit" class="btn">Save Product</button>
    </form>
</div>
@endsection
