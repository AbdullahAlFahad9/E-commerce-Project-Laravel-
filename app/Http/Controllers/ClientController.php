<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\product;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    public function CategoryPage($id){
        $category = Category:: findOrFail($id);
        $products = product::where('product_category_id',$id)->latest()->get();
        return view('user_template.category', compact('category','products'));
    }

    public function SingleProduct($id){
        $product = product::findOrFail($id);
        $subcat_id = product::where('id',$id)->value('product_subcategory_id');
        $related_products = product::where('product_subcategory_id', $subcat_id)->latest()->get();
        return view('user_template.singleproduct', compact('product', 'related_products'));
    }

    public function AddToCart(){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        return view('user_template.addtocart',compact('cart_items'));
    }

    public function AddProductToCart(Request $request ){
        $product_price = $request->product_price; 
        $product_quantity = $request->quantity; 
        $total_price = $product_price * $product_quantity;
        
        Cart::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $product_quantity, 
            'price' => $total_price, 
        ]);
        
        return redirect()->route('addtocart')->with('message', 'Your item added to cart Successfully!');
    }

    public function RemoveCartItem($id){
        $cart_items= Cart::findOrFail($id)->delete();
        return redirect()->route('addtocart')->with('message','Cart Item Removed Successfully');
    }

    public function ShippingAddress(){
        return view('user_template.shippingaddress');
    }

    public function AddShippingInfo(Request $request){
        $request->validate([
            "recipient_name" => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^\+?\d{10,15}$/'], // Validates phone numbers with optional country code
            'city_name' => ['required', 'string', 'max:255'],
            "postal_code" => ['required', 'digits_between:4,10'], // Ensures valid postal code format
            "address" => ['required', 'string', 'max:500'],
        ]);


        ShippingInfo::insert([
            'user_id' => Auth::id(),
            'recipient_name' => $request->recipient_name,
            'phone_number' => $request->phone_number,
            'city_name' => $request->city_name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
        ]);
        return redirect()->route('checkout');
    }

    public function Checkout(){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        $shipping_address = ShippingInfo::where('user_id',$userid)->first();
        return view('user_template.checkout', compact('cart_items','shipping_address'));
    }

    public function PlaceOrder(){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        $shipping_address = ShippingInfo::where('user_id',$userid)->first();

        foreach($cart_items as $item){
            
             $product_name = product::where('id', $item->product_id)->value('product_name');
             $product_image = product::where('id', $item->product_id)->value('product_img');
            
             Order::insert([
                'userid' => $userid,
                'shipping_recipient_name' => $shipping_address->recipient_name,
                'shipping_phone_number' => $shipping_address->phone_number,
                'shipping_city_name' => $shipping_address->city_name,
                'shipping_postal_code' => $shipping_address->postal_code,
                'shipping_address' => $shipping_address->address,
                'product_id' => $item->product_id,
                'product_image' => $product_image,
                'product_name' => $product_name,
                'product_quantity' => $item->quantity,
                'total_price' => $item->price,
            ]);
             $id = $item->id;
            Cart::findOrFail($id)->delete();
        }
        ShippingInfo::where('user_id',$userid)->first()->delete();
        return redirect()->route('pendingorder')->with('message','Your Order Has Been Placed Successfully');
        
    }

    public function UserProfile(){
        return view('user_template.userprofile');
    }

    public function PendingOrder(){
        $pending_orders =  Order::where('status','pending')->latest()->get();
        return view('user_template.pendingorder', compact('pending_orders'));
    }

    public function History(){
        return view('user_template.history');
    }

    public function NewRelease(){
        return view('user_template.newrelease');
    }

    public function TodaysDeal(){
        return view('user_template.todaysdeal');
    }

    public function CustomerService(){
        return view('user_template.customerservice');
    }

}
