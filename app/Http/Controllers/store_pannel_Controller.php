<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store_detail;
use App\Models\StoreDetail; // Make sure this matches the model name
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class store_pannel_Controller extends Controller
{
    public function store_login(Request $r)
    {
        // Validate input data
        $login_data = $r->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

       if(Auth::guard('store')->attempt($login_data)){

            return redirect()->route('store_home');
        } else {
          
            return redirect()->route('store_login')->withErrors(['email' => 'Invalid details. Please try again.']);
        }
    }

    public function store_registration(Request $r)
    {
        $registration_data = $r->validate([
            'store_name' => 'required',
            'store_id' => 'required',
            
            'mobile' => 'required|numeric',
            'password' => 'required',
            'email' => 'required|email|unique:store_details'
        ]);

        $registration_data['password'] = bcrypt($registration_data['password']);

        $store = StoreDetail::create($registration_data);

        if ($store) {
            return view('store_pannel.store_login')->with('success', 'Successfully Registered Store. Store ID: ' . $r->store_id);
        } else {
            return back()->withErrors(['registration' => 'There was an issue registering the store. Please try again.']);
        }
    }

    public function store_orders(){
     

        $store_orders_data =DB::table('orders')
                         ->select('orders.*','store_details.store_id')
                         ->join('store_details','orders.store_id','store_details.store_id')
                         
                        //  ->where('account_id',$account_id)
                         ->orderBy('id','desc')
                         ->get();


                       return view('store_pannel.store_orders',['store_orders_data'=>$store_orders_data]);

    }


    public function store_update($order_stage ,$order_reference){
 $updation =DB::table('orders')
      ->where('order_refrence',$order_reference)
      ->update([
'order_stage'=>$order_stage
      ]);


      if($updation){
        return redirect()->route('store_orders')->with('success','order Updation Succesfull');
    }else{
          return redirect()->route('store_orders')->with('success','order Updation Error');
        
      }
    }


    public function store_logout()
    {
        // Log out the authenticated store user
        Auth::guard('store')->logout();
    
        // Redirect to the store login page
        return redirect()->route('store_login');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'required|string|unique:products',
            'store_id' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|string',
            'quantity' => 'required|integer|min:1', // Change 'qut' to 'quantity'
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'rating_rate' => 'required|numeric|min:0|max:5',
            // 'rating_count' => 'required|integer|min:0',
        ]);
    
        $imagePath = $request->file('image')->store('images/products', 'public');
    
        Product::create([
            'title' => $request->input('title'),
            'product_id' => $request->input('product_id'),
            'store_id' => $request->input('store_id'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'quantity' => $request->input('quantity'), // Change 'qut' to 'quantity'
            'image' => $imagePath,
            // 'rating_rate' => $request->input('rating_rate'),
            // 'rating_count' => $request->input('rating_count'),
        ]);
        
        return redirect()->route('store_home')->with('success', 'Product added successfully.');
    }
    
    public function store_product()
{
    // Retrieve the authenticated store's store_id
    $store_id = Auth::guard('store')->user()->store_id;

    // Fetch the products associated with the store, ordered by 'id' in descending order
    $products = Product::where('store_id', $store_id)
        ->orderBy('id', 'desc')
        ->get();

    return view('store_pannel.store_products',['products'=>$products]);
}


public function store_edit($id){

    $data_edit = Product::where('product_id',$id)
                ->first();



    return view('store_pannel.store_home',['product_edit'=>$data_edit]);
}


public function store_product_edit(Request $res){
  
    $validate_data=$res->validate([
                  'title'=>'required' ,    
                  'price'=>'required' ,    
                  'description'=>'required' ,    
                  'category'=>'required' ,    
                  'quantity'=>'required' ,    
            
    ]);

    $s=Product::where('product_id',$res->product_id)
             ->update([
                  'title'=>$validate_data['title'] ,    
                  'price'=> $validate_data['price'],    
                  'description'=> $validate_data['description'],    
                  'category'=> $validate_data['category'],    
                  'quantity'=> $validate_data['quantity'],    
               
             ]);
     
    if($s){
        return redirect()->route('store_product')->with('success','Edit successfully');
    }
    
}

public function store_delete($id){

if(Product::where('product_id',$id)
->delete()){
   return redirect()->route('store_product')->with('delete','Item Deleted succfully');
}


    }

    
public function store_forget_password(Request $res){
    $obj = StoreDetail::where('email',$res->email)->first();

    if($obj){

        if ($obj->mobile == $res->mobile){
            
            $validate = $res->validate([
                'email' => 'required|email',   // You can add 'email' validation here
                'mobile' => 'required|digits:10',
                'password' => 'required|string|confirmed',
            ]);
            

        if($validate){
            $password =Hash::make($res->password);
            $obj->password=$password;
            $obj->save(); // Save the updated password to the database
            return redirect()->route('store_login')->with('success','Your Password can be succefully forgeted');

        }

        }else{
            return redirect()->back()->with('forget_error','error to invalid mobile number for validate');
        }    
    }else{
        return redirect()->back()->with('forget_error','error to invalid email for validate');
        
    }
        


}

}
