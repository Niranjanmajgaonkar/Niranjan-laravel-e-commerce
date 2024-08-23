

@extends('htmlstructure')

@section('linkscss')
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/productscss.css') }}">
@endsection

@section('navbar')
    <x-navbar />
@endsection

@section('body')
    <x-sidebar />

    @if(isset($error))
    <div style="color: red;">
        <p>{{ $error }}</p>
    </div>
    @endif


    @isset($combined_data_db)

    <div class="products-outerdiv">
        {{-- db products --}}
        @foreach ($combined_data_db as $item)
        <div class="products-innerdiv_db" data-id="{{ $item['product_id'] }}">
            <li id="products-title">{{ $item['title'] }}</li>
            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}">
            <li id="products-price">Price: {{ $item['price'] }}</li>
        </div>
        @endforeach
        @isset($combined_data_api)
        {{-- api products --}}
        @foreach ($combined_data_api as $item)
        <div class="products-innerdiv" data-id="{{ $item['id'] }}">
            <li id="products-title">{{ $item['title'] }}</li>
            <img src="{{$item['image']}}" alt="{{$item['image']}}">
            <li id="products-price">Price: {{ $item['price'] }}</li>
        </div>
        @endforeach
@endisset
    
    </div>
    @endisset
    
    <div class="products-outerdiv">

        {{-- db category product data --}}
        @isset($db_category_data)
        @foreach ($db_category_data as $item)
        <div class="products-innerdiv_db" data-id="{{ $item['product_id'] }}">
            <li id="products-title">{{ $item['title'] }}</li>
            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}">
            <li id="products-price">Price: {{ $item['price'] }}</li>
        </div>
        @endforeach
        @endisset

    {{-- api category product data --}}
    @isset($datas)
    @isset($category)

     @php

        $datass=collect($datas)->where('category',$category);
     
        @endphp
        @foreach ($datass as $item)
        <div class="products-innerdiv" data-id="{{ $item['id'] }}">
            <li id="products-title">{{ $item['title'] }}</li>
            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
            <li id="products-price">Price: {{ $item['price'] }}</li>
        </div>
        @endforeach
    </div>
    @endisset
    @endisset
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let productElements = document.querySelectorAll('.products-innerdiv');
        productElements.forEach(element => {
            element.addEventListener('click', function() {
                let c=1;
                let id = this.getAttribute('data-id');
                window.location.href=`/product/${id}/${c}`;
            });
        });
        let productElements_db = document.querySelectorAll('.products-innerdiv_db');
        productElements_db.forEach(element => {
            element.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                let c=2;
                window.location.href=`/product/${id}/${c}`;
            });
        });
    });
</script>
