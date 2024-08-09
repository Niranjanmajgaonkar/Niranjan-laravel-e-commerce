<?php
namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Order;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RegistrationController extends Controller
{
    private $products = null;

    public function __construct()
    {
      
        $this->fetchProducts();
    }


    private function fetchProducts()
    {
        try {
            // Use cache to store products data for 60 minutes to avoid frequent API calls
            $this->products = Cache::remember('products', 60, function() {
                $response = Http::get('https://fakestoreapi.com/products'); // Ensure this URL is correct
                return json_decode($response, true);
            });
        } catch (\Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage() . ' at line ' . $e->getLine());
            $this->products = null;
        }
    }

    
    public function login(Request $req)
    {
        $validatedData = $req->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::attempt($validatedData)){
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid details filled']);
        }
    }

    public function registration(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|max:255|unique:registrations,email',
            'number' => 'required|numeric|digits:10',
            'password' => 'required|string',
            'account_id'=> 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $registration = new Registration();
        $registration->name = $validatedData['name'];
        $registration->email = $validatedData['email'];
        $registration->number = $validatedData['number'];
        $registration->password = $validatedData['password'];
        $registration->account_id=$validatedData['account_id'];

        if ($registration->save()) {
            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        } else {
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }
    }

    public function getapidata() {
 
                       return view('home', ['data' => $this->products]);
       
    
    }
    
    public function category($value) {

                       return view('home', ['datas' => $this->products ,'category'=>$value]);
       
    
    }
    

    public function logout(){

     Auth::logout();
         return redirect()->route('login');
   
     }
     
     public function singleproduct($id){
         
         // we also can be used the firstWhere this for first finded data
         // and its the important for the such LIKE as the SQL condition we can use COLLECT method in array
         $product = collect($this->products)->Where('id',$id);
         
         $p_category=$product[$id-1]['category'];
         $p_category_products= collect($this->products)->Where('category',$p_category);
         //  dd($p_category_products);
         return view('singleproduct',['singleproduct'=>$product ,'p_category_products'=>$p_category_products]);
        }
        
        
            public function buy($id){
                $productdata =collect($this->products)->where('id',$id);

// when the by using the card to cllicked buy button this time this two line remove the card items
                if($card_object=Card::where('product_id',$id)->first()){
                $card_object->delete();
                }

        return view('order',['order_p_id'=>$id,
                             'productdata' => $productdata
                            ]
                            );
           
             }



            public function addcards($id){
                
      $add_card_product = collect($this->products)->where('id',$id)->first();

      $card_object= new Card();
      $account_id =AUTH::user();
     
     $card_object->product_id=$add_card_product['id'];
     $card_object->account_id=$account_id->account_id;
     $card_object->product_name=$add_card_product['title'];
     $card_object->product_image_link=$add_card_product['image'];
     $card_object->price=$add_card_product['price'];
     $card_object->descreption=$add_card_product['description'];

     $card_object->save();
    
     
        return redirect()->route('card');
      
     

             }



        public function order(Request $req){
             
      $orderdata=$req->validate([
        'product_id'=>'required',
        'customer_name'=>'required|string',
        'customer_mobile_no'=>'required|numeric|min_digits:10|max_digits:10',
        'state_name'=>'',
        'customer_address'=>'required',
        'customer_pincode'=>'required|numeric|min_digits:6|max_digits:6',
        'product_name'=>'',
        'product_price_gross'=>'',
        'product_dilevery_charge'=>'',
        'product_total_payble_price'=>'',
        'account_id'=>'required',
        'order_refrence'=>'required',
        'product_image_link'=>'',

      ]);
        
      $order_reference_number =$orderdata['order_refrence'];
     
      $orderobj =new Order();
      if($orderobj->insert($orderdata)){


        return redirect()->route('results')
        ->with('success', 'YOUR ORDER PLACED SUCCESSFULLY....#ORDER_REFERENCE_NUMBER : ' . $order_reference_number . '.... THANKS FOR USING NIRANJAN-LARAVEL-E_COMMERCE PLATFORM');
}
        else
        {
          return redirect()->route('results')->with('error','YOUR ORDER UNSUCCFULLY . . . THANKS FOR USING NIRANJAN-LARAVEL-E_COMMERCES PLATFORM ');
        }
        }     


        public function remove_product($id){
     $account_id =AUTH::user()->account_id;

     $account_id_card_products=Card::where('account_id',$account_id);

            $card_object=$account_id_card_products->where('product_id',$id)->first();

            $card_object->delete();
return redirect()->route('card');
        }


        public function order_placed(){
            $account_id=AUTH::user()->account_id;

            $qurybuilder_order_stage =DB::table('orders')
                             ->select('orders.*','order_states.order_stage')
                             ->join('order_states','orders.order_stage','order_states.id')
                             
                             ->where('account_id',$account_id)
                             ->orderBy('id','desc')
                             ->get();

            return view('order_placed',['qurybuilder_order_stage'=>$qurybuilder_order_stage]);

        }



    
    }
    