@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Access Denied!</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-4">You do not have permission to access this page.</p>
                    <a href="{{ route('dashboard') }}" class="text-blue-500 dark:text-blue-400 underline mt-6 inline-block">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection
