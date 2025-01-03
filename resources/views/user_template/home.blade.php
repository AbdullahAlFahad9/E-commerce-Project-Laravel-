@extends('user_template.layouts.template')

@section('main-content')

<!-- fashion section start -->
<div class="fashion_section">
   <div id="main_slider" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            <div class="container">
               <h1 class="fashion_taital">All Products</h1>
               <div class="fashion_section_2">
                  <div class="row">

                     @foreach ($allproducts as $product)

                   <div class="col-lg-4 col-sm-4">
                     <div class="box_main">
                        <h4 class="shirt_text">{{$product->product_name}}</h4>
                        <p class="price_text">Price <span style="color: #262626;">Tk.
                            {{$product->product_price}}</span></p>
                        <div class="tshirt_img"><img src="{{asset($product->product_img)}}"></div>
                        <div class="btn_main">
                          <div class="btn_main d-flex justify-content-between align-items-center mt-3">
                            <!-- Buy Now Button -->
                            <form action="{{route('addproducttocart')}}" method="POST" class="m-0">
                              @csrf
                              <input type="hidden" value="{{$product->id}}" name="product_id">
                              <input type="hidden" value="{{$product->product_price}}" name="product_price">
                              <input type="hidden" value="1" name="quantity">

                              <input class="btn btn-warning px-4" type="submit" value="Buy Now">
                            </form>

                            <!-- See More Button -->
                            <a href="{{route('singleproduct', [$product->id, $product->slug])}}"
                              class="btn btn-outline-primary px-4">See More</a>
                          </div>
                        </div>
                     </div>
                   </div>
                @endforeach
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection