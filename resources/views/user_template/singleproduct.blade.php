@extends('user_template.layouts.template')

@section('main-content')
<div class="container">
   <div class="row">
      <div class="col-lg-4">
         <div class="box_main">
            <div class="tshirt_img"><img src="{{asset($product->product_img)}}" class="img-fluid"
                  style="height: 400px; object-fit: cover;"></div>
         </div>
      </div>

      <div class="col-lg-8">
         <div class="box-main p-4 border rounded shadow-sm bg-white">
            <!-- Product Info -->
            <div class="product-info">
               <h4 class="shirt_text text-left font-weight-bold">{{$product->product_name}}</h4>
               <p class="price_text text-left mb-3">
                  Price: <span class="text-danger font-weight-bold">Tk. {{$product->product_price}}</span>
               </p>
            </div>

            <!-- Product Details -->
            <div class="my-3 product-details">
               <p class="lead text-muted">
                  {{$product->product_short_description}}
               </p> <br>

               <p class="lead text-muted">
                  {{$product->product_long_description}}
               </p>
               </p>
               <ul class="p-2 bg-light my-2">
                  <li>Category - Electronics</li>
                  <li>Sub Category - Mobile</li>
                  <li>Available Quantity - 10</li>

               </ul>
            </div>

            <!-- Action Buttons -->
            <div class="btn_main d-flex justify-content-between align-items-center mt-3">
               <!-- Quantity Input -->
               <form action="{{route('addproducttocart')}}" method="POST">
                  @csrf
                  <input type="hidden" value="{{$product->id}}" name="product_id">
                  <div class="form-group">
                     <input type="hidden" value="{{$product->product_price}}" name="product_price">
                     <label for="quantity" class="font-weight-bold">How Many Pieces?</label>
                     <input class="form-control w-50" type="number" value="1" min="1" name="quantity">
                  </div>
                  <br>

                  <!-- Action Buttons -->
                  <input class="btn btn-warning px-4 mr-3" type="submit" value="Buy Now">
                  <input class="btn btn btn-primary" type="submit" value="Add To Cart">        
                  </div>

               </form>
            </div>

         </div>
      </div>


   </div>

</div>

<div class="fashion_section">
   <div id="main_slider" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            <div class="container">
               <h1 class="fashion_taital">Related Products</h1>
               <div class="fashion_section_2">
                  <div class="row">



                     @foreach ($related_products as $product)

                   <div class="col-lg-4 col-sm-4">
                     <div class="box_main">
                        <h4 class="shirt_text">{{$product->product_name}}</h4>
                        <p class="price_text">Price <span style="color: #262626;">$
                            {{$product->product_price}}</span></p>
                        <div class="tshirt_img"><img src="{{asset($product->product_img)}}"></div>
                        <div class="btn_main d-flex justify-content-between align-items-center mt-3">
                          <!-- Buy Now Button -->
                          <form action="{{route('addproducttocart')}}" method="POST" class="m-0">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                            <input type="hidden" value="{{$product->product_price}}" name="price">
                            <input type="hidden" value="1" name="quantity">
                            <input class="btn btn-warning px-4" type="submit" value="Buy Now">
                          </form>

                          <!-- See More Button -->
                          <a href="{{route('singleproduct', [$product->id, $product->slug])}}"
                            class="btn btn-outline-primary px-4">See More</a>
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
</div>
@endsection