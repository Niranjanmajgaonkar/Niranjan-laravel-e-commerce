@extends('htmlstructure')

@section('linkscss')
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/productscss.css') }}">
<link rel="stylesheet" href="{{ asset('css/about.css') }}">

@endsection

@section('navbar')
    <x-navbar />
@endsection

@section('body')
    <x-sidebar />

    <div class="products-outerdiv">
        <div class="about-outerdiv">
            <h2>About Us</h2>
            <p>Welcome to our E-commerce platform! This site is developed by Niranjan Mukund Majgaonkar as part of an educational project. The primary goal of this project is to demonstrate the application of Laravel in building a fully functional online store.</p>
            <p>Our platform features a wide range of products, categorized to help you find exactly what you're looking for. From electronics to fashion, we aim to provide a seamless shopping experience with a user-friendly interface and robust backend functionality.</p>
            <p>This site is only for educational purposes and showcases the integration of various technologies including HTML, CSS, JavaScript, PHP, and Laravel. We hope you find this project informative and inspiring as you explore the capabilities of modern web development frameworks.</p>
            <p class="author">Devloper :- Niranjan Majgaonkar</p>
        </div>
    </div>
@endsection

<style>
.about-outerdiv {
    margin: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
}

.about-outerdiv h2 {
    font-size: 2em;
    margin-bottom: 15px;
    color: #333;
}

.about-outerdiv p {
    font-size: 1.2em;
    line-height: 1.6;
    color: #666;
    margin-bottom: 10px;
}

.about-outerdiv .author {
    font-size: 1em;
    color: #999;
    text-align: right;
    margin-top: 20px;
}


</style>