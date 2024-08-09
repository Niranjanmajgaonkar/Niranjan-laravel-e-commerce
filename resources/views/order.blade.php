@php
use App\Models\City;
use Illuminate\Support\Facades\Auth;

// Fetching all cities
$cities = City::all()->unique('city_state');
$pid = $order_p_id;
$productdatas = collect($productdata)->first(); // Using collect and first to get the first array

// Calculate delivery charges and total amount
$dilevery_charges = $productdatas['price'] > 50 ? 'FREE' : 40;
$totalamount = $dilevery_charges == 'FREE' ? $productdatas['price'] : $dilevery_charges + $productdatas['price'];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Order Form</title>
    @vite('resources/css/order.css')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .order-product-details-outer {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        #main-head {
            text-align: center;
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
        }
        #product-charges {
            font-size: 1.5em;
            color: #555;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .order-product-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .order-product-details-label p,
        .order-product-details-values p {
            margin: 5px 0;
        }
        .order-product-details-values p {
            font-weight: bold;
            color: #333;
        }
        .order-product-details-form {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            background-color: #fff;
        }
        #submit-btn {
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
    
</head>
<body>
    <div class="order-product-details-outer">
        <form action="{{ route('order') }}" method="POST">
            <h1 id="main-head">Customer Order Form</h1>
            <h2 id="product-charges">Product Charges</h2>
            <div class="order-product-details">
                <div class="order-product-details-label">
                    <p>Product Name:</p>
                    <p>Product Price:</p>
                    <p>Delivery Charges:</p>
                    <p>Total Payable Amount:</p>
                </div>
                <div class="order-product-details-values" 
                     data-title="{{ $productdatas['title'] }}" 
                     data-price="{{ $productdatas['price'] }}" 
                     data-dilevery-charges="{{ $dilevery_charges }}" 
                     data-total-amount="{{ $totalamount }}">
                    <p id="product-title"></p>
                    <p id="product-price"></p>
                    <p id="delivery-charges"></p>
                    <p id="total-amount"></p>
                    <p>Cash on Delivery: <input type="radio" checked></p>
                </div>
            </div>
            <div class="order-product-details-form">
                @isset($errors)
                    @foreach ($errors->all() as $err)
                        <p style="color: red;">{{ $err }}</p>
                    @endforeach
                @endisset
                @csrf
                <input type="hidden" name="product_id" value="{{ $pid }}">
                <input type="hidden" name="product_name" value="{{ $productdatas['title'] }}">
                <input type="hidden" name="product_price_gross" value="{{ $productdatas['price'] }}">
                <input type="hidden" name="product_dilevery_charge" value="{{ $dilevery_charges }}">
                <input type="hidden" name="product_total_payble_price" value="{{ $totalamount }}">
                <input type="hidden" name="product_image_link" value="{{ $productdatas['image'] }}">
                <input type="hidden" name="account_id" value="{{ Auth::user()->account_id }}">
                @php
                    $order_refrence_number = rand(0000, 9999);
                @endphp
                <input type="hidden" name="order_refrence" value="{{ $order_refrence_number }}">
                <div class="form-group">
                    <label for="customer-name">Customer Name:</label>
                    <input type="text" id="customer-name" name="customer_name" required>
                </div>
                <div class="form-group">
                    <label for="customer-mobile">Customer Mobile No:</label>
                    <input type="text" id="customer-mobile" name="customer_mobile_no" required pattern="\d{10}">
                </div>
                <div class="form-group">
                    <label for="state-name">State Name:</label>
                    <select id="state-name" name="state_name" required>
                        @foreach ($cities as $city)
                            <option value="{{ $city->city_state }}">{{ $city->city_state }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="customer-address">Customer Address:</label>
                    <input type="text" id="customer-address" name="customer_address" required>
                </div>
                <div class="form-group">
                    <label for="customer-pincode">Pincode:</label>
                    <input type="text" id="customer-pincode" name="customer_pincode" required pattern="\d{6}">
                </div>
                <div class="form-group">
                    <button type="submit" id="submit-btn">Place Order</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const orderDetails = document.querySelector('.order-product-details-values');
        const title = orderDetails.getAttribute('data-title');
        const price = orderDetails.getAttribute('data-price');
        const deliveryCharges = orderDetails.getAttribute('data-dilevery-charges');
        const totalAmount = orderDetails.getAttribute('data-total-amount');
        
        document.getElementById('product-title').textContent = title;
        document.getElementById('product-price').textContent = 'Rs: ' + price;
        document.getElementById('delivery-charges').textContent = deliveryCharges;
        document.getElementById('total-amount').textContent = 'Rs: ' + totalAmount;
    });
</script>
</html>
