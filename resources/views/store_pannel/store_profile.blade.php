@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('store_pannel.store_htmlstructure')

@section('head')
    <x-store_navbar/>   
@endsection

@section('csslinks')
    <link rel="stylesheet" href="{{ asset('css/store_pannel/store_navbar.css') }}">   
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}"> 
@endsection

@section('body')
<div class="profile-outerdiv">
    <div class="profile-innerdiv">
        <div class="profile-labels">
            <h1>Name</h1>
            <h1>Mobile</h1>
            <h1>Store ID </h1>
            <h1>Email</h1>
            <h1>Account Created At</h1>
        </div>
        <div class="profile-values">
            @if (Auth::guard('store')->check())
                @php
                    $storeUser = Auth::guard('store')->user();
                  
                @endphp
                <h3>{{ Str::upper($storeUser->store_name) }}</h3>
                <h3>{{ $storeUser->mobile }}</h3>
                <h3>{{ $storeUser->store_id }}</h3>
                <h3>{{ $storeUser->email }}</h3>
                <h3>{{ $storeUser->created_at->format('d M Y, h:i A') }}</h3> <!-- Formatting the date -->
            @else
                <p>User is not authenticated.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('footer')
    <style>
        .profile-labels h1 {
            background-color: black;
            color: white;
        }
    </style>
@endsection
