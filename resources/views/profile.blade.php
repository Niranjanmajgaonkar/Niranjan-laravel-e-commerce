@php
use Illuminate\Support\Str;
    
@endphp
@extends('htmlstructure')

@section('linkscss')
    @vite('resources/css/navbar.css')
    @vite('resources/css/sidebar.css')
    @vite('resources/css/profile.css')
@endsection

@section('navbar')
    <x-navbar />
@endsection

@section('sidebar')
    <x-sidebar />
@endsection

@section('body')
<div class="profile-outerdiv">
    <div class="profile-innerdiv">
        <div class="profile-labels">
            <h1>Name</h1>
            <h1>Mobile</h1>
            <h1>Email</h1>
            <h1>Account Created At</h1>
        </div>
        <div class="profile-values">
            @if (Auth::check())
            <h3>{{str::upper( Auth::user()->name )}}</h3>
            <h3>{{ Auth::user()->number }}</h3>
            <h3>{{ Auth::user()->email }}</h3>
            <h3>{{ Auth::user()->created_at }}</h3>
            @endif
        </div>
    </div>
</div>
@endsection

