
@extends('store_pannel.store_htmlstructure')

@section('head')
<x-store_navbar/>   
@endsection

@section('csslinks')
<link rel="stylesheet" href="{{ asset('css/store_pannel/store_navbar.css') }}">    
<link rel="stylesheet" href="{{ asset('css/store_pannel/store_orders.css') }}">    
@endsection


@section('body')
@foreach ($store_orders_data as $item)
    
<div class="store-order-outer">
    <div class="store-outer-inner">
        <div class="store-order-img">
            @if ($item->store_id>10)
                        
            <img src="{{ asset('storage/' . $item->product_image_link) }}" alt="{{ $item->product_name }}">
            @elseif($Card->store_id<10)
            <img id="img" src="{{ $item->product_image_link }}" alt="{{ $item->product_name }}">
            @endif
        </div>
        <div class="store-order-details">
            <h2>ORDER DETAILS</h2>
           <li><span>Product Name :-</span> {{$item->product_name}}</li>
           <li><span>Product Gross Price :- </span>{{$item->product_price_gross}}</li>
           <li><span>Product dilevery Charge :- </span>{{$item->product_dilevery_charge}}</li>
           <li><span>Product total Payble :-</span> {{$item->product_total_payble_price}}</li>
           <li><span>Product total Payble :-</span> {{$item->product_total_payble_price}}</li>

        </div>
        <div class="store-customer-details">
            <h2>CUSTOMER DETAILS</h2>


                <li><span>Customer Name :-  </span> {{$item->customer_name}}</li>
                <li><span>Customer Mobile :- </span> {{$item->customer_mobile_no}}</li>
                <li><span>Customer address :- </span>  {{$item->customer_address}}</li>
                <li><span>Customer state :-</span> {{$item->state_name}}</li>
                    <li><span> Pincode :-    </span>  {{$item->customer_pincode}} </li>


        </div>
        <div class="store-payment-details">
            <h2>PAYMENT DETAILS</h2>
            <div class="s">
                
                <li>Cash on dilevery</li>
                <input type="radio" name="cash_on_delivery" value="1" clicked id="cash_on_delivery">

            </div>
            
            <div class="t">

    <li>online paid</li>
    <input type="radio" name="cash_on_delivery" disabled id="cash_on_delivery">
</div>

<h2 id="postion">CURRENT POSITION</h2>
@php
    if ($item->order_stage == 1) {
        echo "<button class='stage-order'  id='approve'>approve</button>";
    }
    if ($item->order_stage == 2) {
        echo "<button class='stage-order'  id='shipped'>shipped</button>";
    }
    if ($item->order_stage == 3) {
        echo "<button class='stage-order'  id='deleverd'>deleverd</button>";
    }
    if ($item->order_stage == 4) {
        echo "<button class='stage-order'  id='cancel'>cancel</button>";
    }
@endphp
</div>

        <div class="store-order-btn">
            <button class="store-btns" id="approve" data-stage="1" order-reference="{{$item->order_refrence}}">approve</button>
            <button class="store-btns" id="shipped" data-stage="2" order-reference="{{$item->order_refrence}}">Shipped</button>
            <button class="store-btns" id="deleverd" data-stage="3" order-reference="{{$item->order_refrence}}">deleverd</button>
            <button class="store-btns" id="cancel" data-stage="4" order-reference="{{$item->order_refrence}}">canncle</button>
        </div>
    </div>
</div>


@endforeach
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btns = document.querySelectorAll(".store-btns");

        const approve = document.querySelector('#approve').getAttribute('data-stage');
        const shipped = document.querySelector('#shipped').getAttribute('data-stage');
        const delivered = document.querySelector('#deleverd').getAttribute('data-stage');
        const cancel = document.querySelector('#cancel').getAttribute('data-stage');

        // Set the data-stage attributes (if needed)
        document.querySelector('#approve').setAttribute('data-stage', approve);
        document.querySelector('#shipped').setAttribute('data-stage', shipped);
        document.querySelector('#deleverd').setAttribute('data-stage', delivered);
        document.querySelector('#cancel').setAttribute('data-stage', cancel);

        btns.forEach(btn => {
            btn.addEventListener('click', function () {
                const data_stage = btn.getAttribute('data-stage');
                const order_reference = btn.getAttribute('order-reference');
                window.location.href = "/store/update/" + data_stage +"/"+order_reference;
            });
        });
    });
</script>

@endsection