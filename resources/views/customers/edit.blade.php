@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Customer Edit
    </h2>
@endsection

@section('content')
    <div class="table-container">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group-wrapper">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block dark:bg-gray-700 dark:text-white" value="{{ old('name', $customer->name ?? '') }}" required>
                </div>

                <div class="form-group-wrapper">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-input rounded-md shadow-sm mt-1 block dark:bg-gray-700 dark:text-white" value="{{ old('address', $customer->address ?? '') }}" required>
                </div>

                <div class="form-group-wrapper">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-select rounded-md shadow-sm mt-1 block w-full dark:bg-gray-700 dark:text-white" required>
                        <option value="">Select</option>
                        <option value="Male" {{ (old('gender', $customer->gender ?? '') == 'Male') ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ (old('gender', $customer->gender ?? '') == 'Female') ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn">Update Product</button>
            </form>
        </div>
    </div>
@endsection