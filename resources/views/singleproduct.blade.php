@extends('htmlstructure')

@section('linkscss')
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/productscss.css') }}">
<link rel="stylesheet" href="{{ asset('css/singleproductscss.css') }}">
@endsection

@section('navbar')
    <x-navbar />
@endsection

@section('body')
    <x-sidebar />

    @if (isset($error))
        <div style="color: red;">
            <p>{{ $error }}</p>
        </div>
    @endif
 {{-- api product display --}}
    @isset($p_category_products)
        <div class="single-product-outerdiv">
            @foreach ($singleproduct as $item)
            <div class="single-product-innerdiv" data-id="{{ $item['id'] }}">
                    <li id="single-product-title">{{ $item['title'] }}</li>
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                    <li id="single-product-price" data-original-price="{{ $item['price'] }}">Price: {{ $item['price'] }}</li>
                </div>
                <div class="products-descreption">

                    <div class="products-descreption-body">
                        <h1>Descreption's</h1>
                        <p>{{ $item['description'] }}</p>
                    </div>

                    <div class="products-descreption-rating">
                        <h1>Rating </h1>
                        <p>{{ $item['rating']['rate'] }}</p>
                    </div>
                    <div class="products-all-btn">
                        <div class="products-buy-btn">
                            <button class="btn"><a href="/buy/{{ $item['id'] }}/1">BUY</a></button>
                        </div>
                        <div class="products-addcard-btn">
                            <button class="btn"><a href="/addcards/{{ $item['id'] }}/1">ADD-CARD</a></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endisset


    @isset($p_category_products)
        <div class="products-outerdiv">
            @foreach ($p_category_products as $item)
                <div class="products-innerdiv" data-id="{{ $item['id'] }}">
                    <li id="products-title">{{ $item['title'] }}</li>
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                    <li id="products-price" data-original-price="{{ $item['price'] }}">Price: {{ $item['price'] }}</li>
                </div>
            @endforeach
        </div>
    @endisset

    {{-- db product display --}}
    @isset($singleproduct_db)
        <div class="single-product-outerdiv_db">
           
            <div class="single-product-innerdiv_db" data-id="{{ $singleproduct_db->product_id }}">
                    <li id="single-product-title">{{ $singleproduct_db->title }}</li>
                    <td><img src="{{ asset('storage/' . $singleproduct_db->image) }}" alt="{{ $singleproduct_db->title }}" ></td>
                    <li id="single-product-price" data-original-price="{{ $singleproduct_db->price }}">Price: {{ $singleproduct_db->price }}</li>
                </div>
                <div class="products-descreption">

                    <div class="products-descreption-body">
                        <h1>Descreption's</h1>
                        <p>{{ $singleproduct_db->description }}</p>
                    </div>

                    <div class="products-descreption-rating">
                        <h1>Rating </h1>
                        <p>{{ $singleproduct_db->rate }}</p>
                    </div>
                    <div class="products-all-btn">
                        <div class="products-buy-btn">
                            <button class="btn"><a href="/buy/{{ $singleproduct_db->product_id }}/2">BUY</a></button>
                        </div>
                        <div class="products-addcard-btn">
                            <button class="btn"><a href="/addcards/{{ $singleproduct_db->product_id }}/2">ADD-CARD</a></button>
                        </div>
                    </div>
                </div>
       
        </div>
    @endisset


    @isset($p_category_products_db)
        <div class="products-outerdiv_db">
            @foreach ($p_category_products_db as $item)
                <div class="products-innerdiv_db" data-id="{{ $item->product_id }}">
                    <li id="products-title">{{ $item->title }}</li>
                    <td><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"></td>
                    <li id="products-price" data-original-price="{{ $item->price }}">Price: {{ $item->price }}</li>
                </div>
            @endforeach
        </div>
    @endisset
@endsection


 <script>
    document.addEventListener('DOMContentLoaded', function() {
     
        // db product click hanneler
        let productElements_db = document.querySelectorAll('.products-innerdiv_db');
        productElements_db.forEach(e => {
            e.addEventListener('click', function() {
                let ids = this.getAttribute('data-id');
                window.location.href=`/product/${ids}/2`;
            });
        });
    
           // api product cllick handderler
           let productElements = document.querySelectorAll('.products-innerdiv');
        productElements.forEach(element => {
            element.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                window.location.href=`/product/${id}/1`;
            });
        });

    });
</script>
