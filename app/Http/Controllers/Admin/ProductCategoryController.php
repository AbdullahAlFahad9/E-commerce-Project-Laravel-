<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use App\Models\subcategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(){
        $products= product::latest()->get();
        return view("admin.allproduct", compact('products'));
    }

    public function AddProduct(){
        $categories = category::latest()->get();
        $subcategories = subcategory::latest()->get();
        return view("admin.addproduct", compact('categories','subcategories'));
    }

    public function StoreProduct(Request $request) {
        $request->validate([
            "product_name" => ['required', 'unique:products', 'max:25'],
            'product_quantity' => ['required', 'integer'],
            'product_price' => ['required', 'numeric'],
            "product_short_description" => ['required'],
            "product_long_description" => ['required'],
            "product_category_id" => ['required', 'exists:categories,id'],
            'product_subcategory_id' => ['required', 'exists:subcategories,id'],
            'product_img' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,webp,svg', 'max:2048'],
        ]);
    
        // Handle Image Upload
        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;
    
        // Retrieve Category and Subcategory Names
        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;
        $category_name = category::where('id', $category_id)->value('category_name');
        $subcategory_name = subcategory::where('id', $subcategory_id)->value('subcategory_name');
    
        // Insert Product
        product::insert([
            'product_name' => $request->product_name,
            'product_quantity' => $request->product_quantity,
            'product_price' => $request->product_price,
            'product_short_description' => $request->product_short_description,
            'product_long_description' => $request->product_long_description,
            'product_category_id' => $category_id,
            'product_subcategory_id' => $subcategory_id,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_img' => $img_url,
            'slug' => strtolower(str_replace(' ', '_', $request->product_name)),
        ]);
    
        // Update Product Count in Category and Subcategory
        category::where('id', $category_id)->increment('product_count', 1);
        subcategory::where('id', $subcategory_id)->increment('product_count', 1);
    
        return redirect()->route('allproduct')->with('message', 'Product Added Successfully');
    }
    
    public function EditProductImage($id){
        $product_info= product::findOrFail($id);
        return view('admin.editproductimage', compact('product_info'));
    }

    public function UpdateProductImage(request $request){  
         
            $request->validate([
                'product_img' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,webp,svg', 'max:2048'],
            ]);

        // Handle Image Upload
        $id= $request->id;
        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

        product::findOrFail( $id )->update([
            'product_img' => $img_url,
        ]);
        return redirect()->route('allproduct')->with('message', 'Product Image Updated Successfully!');
    }

    public function editproduct($id){
        $product_info= product::findOrFail($id);
        return view('admin.editproduct', compact('product_info'));
    }

    public function UpdateProduct(Request $request){
       

     $request->validate([
        "product_name" => ['required', 'unique:products', 'max:25'],
        'product_quantity' => ['required', 'integer'],
        'product_price' => ['required', 'numeric'],
        "product_short_description" => ['required'],
        "product_long_description" => ['required'],
     ]);

     $product_id= $request->id;
     product::findOrFail( $product_id )->update([
        'product_name' => $request->product_name,
        'product_quantity' => $request->product_quantity,
        'product_price' => $request->product_price,
        'product_short_description' => $request->product_short_description,
        'product_long_description' => $request->product_long_description,
        'slug' => strtolower(str_replace(' ', '_', $request->product_name)),
     ]);
     return redirect()->route('allproduct')->with('message', 'Product Information Updated Successfully!');
 }

    public function DelectProduct($id){
        $cat_id = product::where('id',$id)->value('product_category_id');
        $subcat_id = product::where('id',$id)->value('product_subcategory_id');

        product::findOrFail($id)->delete();
        
        category::where('id',$cat_id)->decrement('product_count', 1);
        subcategory::where('id',$subcat_id)->decrement('product_count', 1);
        
        return redirect()->route('allproduct')->with('message','Product Deleted Successfully');
    }
    
}
