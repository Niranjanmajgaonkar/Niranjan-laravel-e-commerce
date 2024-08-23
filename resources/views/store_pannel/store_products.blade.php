@extends('store_pannel.store_htmlstructure')

@section('head')
<x-store_navbar/>   
@endsection

@section('csslinks')
<link rel="stylesheet" href="{{ asset('css/store_pannel/store_navbar.css') }}">    
<link rel="stylesheet" href="{{ asset('css/store_pannel/store_orders.css') }}">    
@endsection

@section('body')
@if (session('success'))
   <marquee behavior="flow" direction="left" style="    color: green;
    font-size: 31px;

">{{session('success')}}</marquee>
@endif
@if (session('delete'))
 <marquee behavior="flow" direction="left" style="    color: red;
    font-size: 31px;
    ">{{session('delete')}}</marquee>
@endif
@isset($products)

<div class="store_orders">
    <h1>Store Products</h1>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Category</th>
                <th>Description</th>

       
                <th>Total qut</th>
                <th>Image</th>
                <th> Edit </th>
                <th> Delete</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->quantity }}</td>
      
      
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" width="50"></td>
                    <td><a href="/products/store/edit/{{$product->product_id}}"><button>Edit</button><a></td>
                    <td><a href="/products/store/delete/{{$product->product_id}}"><button>Delete</button><a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
   
    </div>
    @else
    <p style="font-size: 30px;
               padding-top:20px;
               padding-left:20px;
               color:brown">No products found.</p>
    @endisset
    @endsection
<style>
    table{
        padding-left:35px; 
    }
    tr th{
        padding: 18px;
        margin-left: 8vw;
        font-size: 28px;
    border-bottom:2px solid black;
    margin-bottom:5px;  
}

    tr td{
        padding: 5px;
        border-left: 2px solid;
    border-bottom: 2px solid;
    }

    .store_orders h1{
        display: flex;
    padding-left:33vw; 
    color: blue;  display: flex;
    padding-top:10px; 
    }

    td button{
        font-size: 20px;
        padding-left:20px; 
        padding-right:20px; 
        background-color:black;
        color: wheat;
        border-radius:5px;
        margin-left:15px;   
    }

    td button:hover{
        cursor: pointer;
        background-color: wheat;
        color: black;

    }
    .store_orders{
        margin-left:200px; 
    }
</style>
