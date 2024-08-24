@php
     use Illuminate\Support\Facades\Auth;
     use App\Models\ProductCategory;
@endphp

@extends('store_pannel.store_htmlstructure')

@section('head')
<x-store_navbar/>   
@endsection

@section('csslinks')
<link rel="stylesheet" href="{{ asset('css/store_pannel/store_navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/store_pannel/store_product_upload.css') }}">  
<link rel="stylesheet" href="{{ asset('css/store_pannel/store_home.css') }}">  
@endsection


@section('body')

@isset($product_edit)

<div class="store_product_upload_outer">
    <div class="store_product_upload_inner">
      
        @if(session('success'))
        <li id="success">{{ session('success') }}</li> 
    @endif
        <h1 style="color: red">* EDIT OLD PRODUCT *</h1>
       
        <form action="{{ route('store_product_edit') }}" method="POST" >
            @csrf
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" value="{{$product_edit->title}}" name="title" required>
            </div>
            <div>
           
                <input type="text" value="{{$product_edit->product_id}}" id="product_id" name="product_id" hidden required>
            </div>
            <div>
               
                <input type="text" value="{{$product_edit->store_id}}" id="store_id" name="store_id" hidden required>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" step="0.01" value="{{$product_edit->price}}" id="price" name="price" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <input style="padding: 20px" id="description" value="{{$product_edit->description}}" name="description" required></textarea>
            </div>
            <div>
                @php
                $obj =ProductCategory::all();

            @endphp
                <select name="category" id="category" style="    padding-left: 13vw;
                           padding-right: 9vw;
                           /* display: flex; */ margin-top:10px;
                            ">
                           {{-- <option value="{{$product_edit->category}}">{{$product_edit->category}}</option> --}}
                           @foreach ($obj as $item)
                           <option value="{{$item->category}}">{{$item->category}}</option>
                           @endforeach
                </select>
            </div>
           
            <div>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" value="{{$product_edit->quantity}}"  name="quantity" required>
            </div>
           
        
            <button type="submit">Edit Product</button>
        </form>
    </div>
</div>

    @else
    <div class="store_product_upload_outer">
        <div class="store_product_upload_inner">
            @if(session('success'))
                <li id="success">{{ session('success') }}</li> 
            @endif
            <h1>* UPLOAD NEW PRODUCT *</h1>
            
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div>
                    <input type="text" value="{{ rand(1000, 9999) }}" id="product_id" name="product_id" hidden required>
                </div>
                <div>
                    <input type="text" value="{{Auth::guard('store')->user()->store_id}}" id="store_id" name="store_id" hidden required>
                </div>
                <div>
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" id="price" name="price" required>
                </div>
                <div>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div>
                    <label for="category">Category:</label>
                    @php
                        $obj =ProductCategory::all();
     
                    @endphp
                    <select name="category" id="category" style="    padding-left: 13vw;
                                                                     padding-right: 9vw;
                                                                     /* display: flex; */
                                                                 ">
                        @foreach ($obj as $item)
                        <option value="{{$item->category}}">{{$item->category}}</option>
                        @endforeach
                    </select>
                </div>
                <br>    
                <div>
                    <label for="image">Upload Image:</label>
                    <input type="file" id="image" name="image" required>
                </div>
                <div>
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" required>
                </div>
                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>
    
@endisset
@endsection

