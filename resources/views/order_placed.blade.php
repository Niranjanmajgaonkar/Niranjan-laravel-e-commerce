<!-- resources/views/Cards/index.blade.php -->

@extends('htmlstructure')

@section('linkscss')
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endsection

@section('navbar')
    <x-navbar />
@endsection

@section('body')
    <x-sidebar />
    
    <div class="Cards-list">
        @foreach($qurybuilder_order_stage as $Card)
            <div class="Card-item">
                <div class="Card-img">
                    @if ($Card->store_id>10)
                        
                    <img src="{{ asset('storage/' . $Card->product_image_link) }}" alt="{{ $Card->product_name }}">
                    @elseif($Card->store_id<10)
                    <img id="img" src="{{ $Card->product_image_link }}" alt="{{ $Card->product_name }}">
                    @endif
                </div>
                <div class="Card-details">
                    <li id="product_name">{{ $Card->product_name }}</li>
                    <p>RS :- {{ $Card->product_total_payble_price }}</p>
                    <div class="refrence">
                        <h4>#</h4>
                         <li>Order Refrence No :-</li>
                        <li id="refrence_number">{{ $Card->order_refrence }}</li>
                    </div>
                    <div class="status">

                        <li id="status_name">Status :- </li>
                        <li id="status_letter">{{$Card->order_stage}}</li>

                    </div>
                </div>
            </div>
        @endforeach
        <div class="no_record_found">
            @if (collect($qurybuilder_order_stage)->isEmpty())
         <marquee behavior="flow" direction="left"><p>You have No Any order available</p></marquee>
            @endif
        </div>
    </div>
@endsection

<script>
   document.addEventListener("DOMContentLoaded", (event) => {
    
  stage_id=document.querySelectorAll("#status_letter");
  stage_id.forEach(element => {
    if(element.innerText=='order in proccess'){
        element.style.color="white";
        element.style.backgroundColor="blue";
    }
    if(element.innerText=='order is shipped'){
        element.style.color="black";
        element.style.backgroundColor="#F9E400";
    }
    if(element.innerText=='order is deleverd'){
        element.style.color="white";
        element.style.backgroundColor="#399918";
    }
    if(element.innerText=='order is Cannceld'){
        element.style.color="white";
        element.style.backgroundColor="red";
    }

  });
});
</script>

<style>
    .Cards-list {
        display: flex;
        flex-wrap: wrap;
    }
    .Card-item {
        display: flex;
        flex-direction: row;
        border: 2px solid black;
        width: 100vw;
        margin-top: 2vh;
        margin-left: 1vw;
        margin-right: 1vw;
    }
    .Card-img img {
        height: 11vh;
    }
    .Card-img {
        height: 9vh;
    margin-left: 2vw;
    margin-bottom: 1vh;
    margin-top: 1vh;
    }
    .Card-details {
        padding: 1vw;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-left: auto;
        text-align: right; /* Aligns text to the right */
    }
    .Card-buttons {
        display: flex;
        gap: 1vw;
        margin-top: 1vh;
        justify-content: flex-end; /* Aligns buttons to the right */
    }
    .btn-buy, .btn-remove {
        padding: 0.5vw 1vw;
        border: none;
        cursor: pointer;
    }
    .btn-buy {
        background-color: #4CAF50;
        color: white;
    }
    .btn-remove {
        background-color: #f44336;
        color: white;
    }

    .Card-details p{
        font-weight: 500;
        padding-top:5px; 
        padding-bottom:5px; 
    }

    .no_record_found p{
        font-weight: 870;
    font-size: 23px;
    padding-top: 20px;
    color: red;
    }

    .status{
        display: flex;
        justify-content: end;

    }

    #status_letter{
        color: red;
    padding-right: 9px;
    padding-bottom: 3px;
    padding-top: 3px;
    padding-left: 9px;
    }

    .refrence{
        display: flex;
        justify-content: end;
    }

    #refrence_number{
        color: blue;
        padding-left:5px;
        padding-top:2px;  
        padding-bottom:2px;  
    }

    .Card-item{
        list-style: none;
    }

    .refrence h4{
        color: red;
        padding-right:5px; 
    }

    #status_name{
        color: brown;
    }

    #product_name{
        font-weight: 700;
    }
</style>
