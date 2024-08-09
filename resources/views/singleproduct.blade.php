@extends('htmlstructure')

@section('linkscss')
    @vite('resources/css/navbar.css')
    @vite('resources/css/sidebar.css')
    @vite('resources/css/productscss.css')
    @vite('resources/css/singleproductscss.css')
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
                            <button class="btn"><a href="/buy/{{ $item['id'] }}">BUY</a></button>
                        </div>
                        <div class="products-addcard-btn">
                            <button class="btn"><a href="/addcards/{{ $item['id'] }}">ADD-CARD</a></button>
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
