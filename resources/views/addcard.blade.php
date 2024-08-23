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
    
    @php
        use App\Models\Card;
        use Illuminate\Support\Facades\Auth;
        $Cards = Card::orderBy('id','desc')->where('account_id',AUTH::user()->account_id)->get();
    
    @endphp

    <div class="Cards-list">
        @foreach($Cards as $Card)
            <div class="Card-item">
                <div class="Card-img">
                    @if ($Card->product_id>10)
                        
                    <img src="{{ asset('storage/' . $Card->product_image_link) }}" alt="{{ $Card->product_name }}">
                    @elseif($Card->product_id<10)
                    <img id="img" src="{{ $Card->product_image_link }}" alt="{{ $Card->product_name }}">
                    @endif
                </div>
                <div class="Card-details">
                    <h2>{{ $Card->product_name }}</h2>
                    <p>{{ $Card->price }}</p>
               
                    <div class="Card-buttons">
                        @if ($Card->product_id>10)
                        <a href="/buy/{{ $Card->product_id }}/2"><button class="btn-buy">Buy</button></a>
                      <a href="/remove_product/{{$Card->product_id}}"><button class="btn-remove">Remove</button></a>
                      @elseif($Card->product_id<10)
                      <a href="/buy/{{ $Card->product_id }}/1"><button class="btn-buy">Buy</button></a>
                    <a href="/remove_product/{{$Card->product_id}}"><button class="btn-remove">Remove</button></a>

                      @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div class="no_record_found">

            @if ($Cards->isEmpty())
         <marquee behavior="flow" direction="left"><p>Your Card is Empty . . . Please Shop Now</p></marquee>
            @endif
        </div>
    </div>
@endsection

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
        height: 23vh;
    }
    .Card-img {
        height: 23vh;
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
        font-weight: 900;
    }

    .no_record_found p{
        font-weight: 870;
    font-size: 23px;
    padding-top: 20px;
    color: red;
    }
</style>
