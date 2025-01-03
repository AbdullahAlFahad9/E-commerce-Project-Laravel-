<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Dashboardcontroller;
use App\Http\Controllers\Admin\OrderCategoryController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function(){
  Route::get('/', 'Index')->name('home');
});

Route::controller(ClientController::class)->group(function(){
  Route::get('category/{id}/{slug}', 'CategoryPage')->name('category');
  Route::get('product-details/{id}/{slug}', 'SingleProduct')->name('singleproduct');
  Route::get('new-release', 'NewRelease')->name('newrelease');
  

});

Route::middleware(['auth','role:user'])->group(function () {

  Route::controller(ClientController::class)->group(function(){
    
    Route::get('add-to-cart', 'AddToCart')->name('addtocart');
    Route::post('add-product-to-cart', 'AddProductToCart')->name('addproducttocart');
    Route::get('remove-cart-item/{id}', 'RemoveCartItem')->name('removecartitem');
    Route::get('shipping-address', 'ShippingAddress')->name('shippingaddress');
    Route::post('add-shippinginfo', 'AddShippingInfo')->name('addshippinginfo');
    Route::post('place-order', 'PlaceOrder')->name('placeorder');
    Route::get('checkout', 'Checkout')->name('checkout');
    Route::get('user-profile', 'UserProfile')->name('userprofile');
    Route::get('user-profile/pending_order', 'PendingOrder')->name('pendingorder');
    Route::get('user-profile/history', 'History')->name('history');
    Route::get('todays-deal', 'TodaysDeal')->name('todaysdeal');
    Route::get('customer-service', 'CustomerService')->name('customerservice');
  
  });

});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function () {
   
    Route::controller(Dashboardcontroller::class)->group(function () {
    Route::get('/admin/dashboard', 'Index')->name('admindashboard');

       });

    Route::controller(CategoryController::class)->group(function () {
    Route::get('/admin/all-category', 'Index')->name('allcategory');
    Route::get('/admin/add-category', 'AddCategory')->name('addcategory');
    Route::post('/admin/store-category', 'StoreCategory')->name('storecategory');
    Route::get('/admin/edit-category/{id}', 'EditCategory')->name('editcategory');
    Route::post('/admin/update-category', 'UpdateCategory')->name('updatecategory');
    Route::get('/admin/delete-category/{id}', 'DeleteCategory')->name('deletecategory');
    

       });

    Route::controller(SubCategoryController::class)->group(function () {
    Route::get('/admin/all-subcategory', 'Index')->name('allsubcategory');
    Route::get('/admin/add-subcategory', 'AddSubCategory')->name('addsubcategory');
    Route::post('/admin/store-subcategory', 'StoreSubCategory')->name('storesubcategory');
    Route::get('/admin/edit-subcategory/{id}', 'EditSubCategory')->name('editsubcategory');
    Route::post('/admin/update-subcategory', 'UpdateSubCategory')->name('updatesubcategory');
    Route::get('/admin/delete-subcategory/{id}', 'DeleteSubCategory')->name('deletesubcategory');
    
      });

    Route::controller(ProductCategoryController::class)->group(function () {
    Route::get('/admin/all-product', 'Index')->name('allproduct');
    Route::get('/admin/add-product', 'AddProduct')->name('addproduct');
    Route::post('/admin/store-product', 'StoreProduct')->name('storeproduct');
    Route::get('/admin/edit-product-image/{id}', 'EditProductImage')->name('editproductimage');
    Route::post('/admin/update-product-image', 'UpdateProductImage')->name('updateproductimage');
    Route::get('/admin/edit-product/{id}', 'EditProduct')->name('editproduct');
    Route::post('/admin/update-product', 'UpdateProduct')->name('updateproduct');
    Route::get('/admin/delect-product/{id}', 'DelectProduct')->name('delectproduct');

      }); 

    Route::controller(OrderCategoryController::class)->group(function () {
    Route::get('/admin/pending-orders', 'Index')->name('pendingorders');
    Route::get('/admin/complete-orders', 'AddOrders')->name('completeorders');

      });

});

require __DIR__.'/auth.php';
