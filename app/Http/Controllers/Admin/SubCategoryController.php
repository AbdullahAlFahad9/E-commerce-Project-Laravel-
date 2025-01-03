<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $allsubcategories= subcategory::latest()->get();
        return view("admin.allsubcategory",compact('allsubcategories'));
    }

    public function AddSubCategory(){
        $categories = category::latest()->get();
        return view("admin.addsubcategory",compact("categories"));
    }

    public function StoreSubCategory(Request $request){
        $request->validate([
            "subcategory_name" => ['required', 'unique:subcategories', 'max:25'],
            'category_id'=> ['required']
        ]);

        $category_id= $request->category_id;
        $category_name= category::where('id',$category_id)->value('category_name');

        subcategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ', '_', $request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name
        ]);

        category::where('id',$category_id)->increment('subcategory_count',1);
        return redirect()->route('allsubcategory')->with('message', 'Sub Category Added Successfully');

    }

    public function EditSubCategory($id){
        $subcategory_info= subcategory::findOrFail($id);
        return view('admin.editsubcategory', compact('subcategory_info'));
 }

 public function UpdateSubCategory(Request $request){
     $subcategory_id= $request->subcategory_id;

     $request->validate([
         "subcategory_name" => ['required', 'unique:subcategories', 'max:25'],
     ]);

     $subcategory_id = $request->subcategory_id;
     subcategory::findOrFail( $subcategory_id )->update([
         'subcategory_name' => $request->subcategory_name,
         'slug' => strtolower(str_replace(' ', '_', $request->subcategory_name)),
     ]);
     return redirect()->route('allsubcategory')->with('message', 'Sub Category Updated Successfully!');
 }

 public function DeleteSubCategory($id){
    $cat_id = subcategory::where('id',$id)->value('category_id');
      subcategory::findOrFail($id)->delete();
     category::where('id',$cat_id)->decrement('subcategory_count', 1);
     return redirect()->route('allsubcategory')->with('message','SubCategory Deleted Successfully');
     
    } 

}



