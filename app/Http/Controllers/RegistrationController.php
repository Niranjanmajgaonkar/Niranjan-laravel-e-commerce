<?php
namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Order;
use App\Models\Product;
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
    protected $combined_data_db = null;
    protected $combined_data_api = null;
    protected $products = null;
    protected $db_product_data = null;

    public function __construct()
    {
      
        $this->fetchProducts();
        $this->fetchProducts_api();
    }


    protected function fetchProducts()
    {
        try {
            // db product featching
            $this->db_product_data = Product::all(); // Fetch all product data
            $this->combined_data_db=$this->db_product_data;

            // Combine the data into a single collection            

        } catch (\Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage() . ' at line ' . $e->getLine());
       
        }
    }
    protected function fetchProducts_api()
    {
        try {
           // Use cache to store products data for 60 minutes to avoid frequent API calls
           $this->combined_data_api = Cache::remember('products', 60, function() {
            $response = Http::get('https://fakestoreapi.com/products'); // Ensure this URL is correct
            return json_decode($response, true);
        });          

        } catch (\Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage() . ' at line ' . $e->getLine());
            $this->products = null;
        }
    }
    public function getapidata() {

        // Return the view with the combined data
        
        return view('home', ['combined_data_db' =>$this->combined_data_db,
                               'combined_data_api'=>$this->combined_data_api]);
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

    
    
    public function category($value) {
$db_product_data_category =collect($this->combined_data_db)->where('category',$value);

                       return view('home', ['datas' => $this->combined_data_api ,'category'=>$value ,'db_category_data'=>$db_product_data_category]);
       
    
    }
    

    public function logout()
    {
        // Log out the authenticated customer user
        Auth::guard('web')->logout();
    
        // Redirect to the customer login page
        return redirect()->route('login');
    }
    
     
     public function singleproduct($id ,$c){
         if($c==1){
        // finding the api product data
         $product = collect($this->combined_data_api)->Where('id',$id);
         
         $p_category=$product[$id-1]['category'];
         $p_category_products= collect($this->combined_data_api)->Where('category',$p_category);
         return view('singleproduct',['singleproduct'=>$product ,'p_category_products'=>$p_category_products]);
         
        }elseif ($c == 2) {
            // fetaching db product data
            // Convert $this->db_product_data to a collection if it isn't one already
            $collection = collect($this->combined_data_db);
         
            // Filter the collection by product_id
            $product = $collection->firstWhere('product_id', $id);
            
            if ($product) {
               
                $category = $product['category'] ?? 'Category not found'; 
                $p_category_products= collect($collection)->Where('category',$category);

                return view('singleproduct',['singleproduct_db'=>$product ,'p_category_products_db'=>$p_category_products]);
            } else {
             
                return 'Product not found';
            }
        }
        

        }
        
        
            public function buy($id,$c){
                // api product buy
                if($c==1){
                $productdata =collect($this->combined_data_api)->where('id',$id);


// when the by using the card to cllicked buy button this time this two line remove the card items
                if($card_object=Card::where('product_id',$id)->first()){
                $card_object->delete();
                }

        return view('order',['order_p_id'=>$id,
                             'productdata' => $productdata,
                             'c'=>1
                            ]
                            );
                        }
                elseif($c==2){
                           // db product buy
       $collection = collect($this->db_product_data);
       $product = $collection->firstWhere('product_id', $id);


       return view('order',['order_p_id'=>$id,
       'productdata' => $product,
       'c'=>2
      ]
      );
                }
             }



            public function addcards($id,$c){
                // this step for api cards
                if($c==1){

                    $add_card_product = collect($this->combined_data_api)->where('id',$id)->first();
                    
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

                // this step for db products add card
                elseif($c==2){
                    $collection = collect($this->db_product_data);
                    $product = $collection->firstWhere('product_id', $id);
                    $card_object= new Card();
                    $account_id =AUTH::user();
    
                    $card_object->product_id=$product->product_id;
                    $card_object->account_id=$account_id->account_id;
                    $card_object->product_name=$product->title;
                    $card_object->product_image_link=$product->image;
                    $card_object->price=$product->price;
                    $card_object->descreption=$product->description;
                    
                    $card_object->save();
                    
                    
                    return redirect()->route('card');
                }
                    
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
        'store_id'=>''

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

public function forget_password(Request $res){
    $obj = Registration::where('email',$res->email)->first();
    
    if($obj){

        if ($obj->number == $res->mobile){
            
            $validate = $res->validate([
                'email' => 'required|email',   // You can add 'email' validation here
                'mobile' => 'required|digits:10',
                'password' => 'required|string|confirmed',
            ]);
            

        if($validate){
            $password =Hash::make($res->password);
            $obj->password=$password;
            $obj->save(); // Save the updated password to the database
            return redirect()->route('login')->with('login')->with('success','Your Password can be succefully forgeted');

        }

        }else{
            return redirect()->back()->with('forget_error','error to invalid mobile number for validate');
        }    
    }else{
        return redirect()->back()->with('forget_error','error to invalid email for validate');
        
    }
        


}

    
    }
    