{{-- resources/views/components/app-layout.blade.php --}}
@extends('layouts.app')

@section('header')
    {{ $header ?? '' }}
@endsection

@section('content')
    {{ $slot }}
@endsection
