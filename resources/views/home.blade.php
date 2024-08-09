

@extends('htmlstructure')

@section('linkscss')
    @vite('resources/css/navbar.css')
    @vite('resources/css/sidebar.css')
    @vite('resources/css/productscss.css')
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


    @isset($data)
    <div class="products-outerdiv">
        @foreach ($data as $item)
        <div class="products-innerdiv" data-id="{{ $item['id'] }}">
            <li id="products-title">{{ $item['title'] }}</li>
            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
            <li id="products-price">Price: {{ $item['price'] }}</li>
        </div>
        @endforeach
    </div>
    @endisset
    @isset($datas)
    @isset($category)
    <div class="products-outerdiv">
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
                let id = this.getAttribute('data-id');
                window.location.href=`/product/${id}`;
            });
        });
    });
</script>
