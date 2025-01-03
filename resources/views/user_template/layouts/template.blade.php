<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Eflyer</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.min.css')}}">
   <!-- style css -->
   <link rel="stylesheet" type="text/css" href="{{asset('home/css/style.css')}}">
   <!-- Responsive-->
   <link rel="stylesheet" href="{{asset('home/css/responsive.css')}}">
   <!-- fevicon -->
   <link rel="icon" href="{{asset('home/images/fevicon.png')}}" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="{{asset('home/css/jquery.mCustomScrollbar.min.css')}}">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <!-- fonts -->
   <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
   <!-- font awesome -->
   <link rel="stylesheet" type="text/css"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <!--  -->
   <!-- owl stylesheets -->
   <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext"
      rel="stylesheet">
   <link rel="stylesheet" href="{{asset('home/css/owl.carousel.min.css')}}">
   <link rel="stylesoeet" href="{{asset('home/css/owl.theme.default.min.css')}}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
      media="screen">
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
   <!-- banner bg main start -->
   <div class="banner_bg_main">
      <!-- header top section start -->
      <div class="container">
         <div class="header_section_top">
            <div class="row">
               <div class="col-sm-12">
                  <div class="custom_menu">
                     <ul>
                        <li><a href="#">Best Sellers</a></li>
                        <li><a href="#">Gift Ideas</a></li>
                        <li><a href="{{route('newrelease')}}">New Releases</a></li>
                        <li><a href="{{route('todaysdeal')}}">Today's Deals</a></li>
                        <li><a href="{{route('customerservice')}}">Customer Service</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- header top section start -->
      <!-- logo section start -->
      <div class="logo_section">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="logo"><a href="{{asset('home/index.html')}}"><img
                           src="{{asset('home/images/logo.png')}}"></a></div>
               </div>
            </div>
         </div>
      </div>
      <!-- logo section end -->
      <!-- header section start -->
      <div class="header_section">
         <div class="container">
            <div class="containt_main">
               <div id="mySidenav" class="sidenav">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                  <a href="{{route('home')}}">Home</a>

                  <!-- get all category access -->
                  @php
               $categories = App\Models\category::latest()->get();
               $allproducts = App\Models\product::latest()->get();
            @endphp
                  <!-- now set this catogory  -->
                  @foreach ($categories as $category)
                 <a href="{{route('category', [$category->id, $category->slug])}}">{{$category->category_name}}</a>
              @endforeach

               </div>
               <span class="toggle_icon" onclick="openNav()"><img src="{{asset('home/images/toggle-icon.png')}}"></span>
               <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                     @foreach ($categories as $category)
                   <a class="dropdown-item"
                     href="{{route('category', [$category->id, $category->slug])}}">{{$category->category_name}}</a>
                @endforeach

                  </div>
               </div>
               <div class="main">
                  <!-- Another variation with a button -->
                  <div class="input-group">
                     <input type="text" class="form-control" placeholder="Search this blog">
                     <div class="input-group-append">
                        <button class="btn btn-secondary" type="button"
                           style="background-color: #f26522; border-color:#f26522 ">
                           <i class="fa fa-search"></i>
                        </button>
                     </div>
                  </div>
               </div>
               <div class="header_box">
                  <div class="lang_box ">
                     <a href="#" title="Language" class="nav-link" data-toggle="dropdown" aria-expanded="true">
                        <img src="{{asset('home/images/flag-uk.png')}}" alt="flag" class="mr-2 " title="United Kingdom">
                        English <i class="fa fa-angle-down ml-2" aria-hidden="true"></i>
                     </a>
                     <div class="dropdown-menu ">
                        <a href="#" class="dropdown-item">
                           <img src="{{asset('home/images/flag-france.png')}}" class="mr-2" alt="flag">
                           French
                        </a>
                     </div>
                  </div>

                  <div class="login_menu">
                     <ul>
                        <li><a href="{{route('addtocart')}}">
                              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                              <span class="padding_10">Cart</span></a>
                        </li>
                        <li><a href="{{route('profile.edit')}}">
                              <i class="fa fa-user" aria-hidden="true"></i>
                              <span class="padding_10">Profile</span></a>
                        </li>
                        <li>
                           <a href="{{route('admindashboard')}}">
                              <i class="fa fa-cogs" aria-hidden="true"></i>
                              <span class="padding_10">Admin</span>
                           </a>
                        </li>

                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- header section end -->

      <!-- Banner Section Start -->
      <div class="banner_section layout_padding">
         <div class="container">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <!-- Loop through all products -->
                  @foreach ($allproducts as $index => $product)
                 <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                   <div class="row justify-content-center align-items-center">
                     <div class="col-sm-8 text-center">
                        <!-- Product Name -->
                        <h4 class="banner_taital"><span
                            style="color: aliceblue "></span>{{ $product->product_name }}</span></h4>
                        <!-- Product Price -->
                        <p class="price_text" style="color: blue">
                          Price: <span style="color: white">Tk. {{ $product->product_price }}</span>
                        </p>
                        <!-- Product Image -->
                        <div><img src="{{ asset($product->product_img) }}" alt="{{ $product->product_name }}"
                            class="img-fluid" style="max-height: 250px;">

                          <!-- Buttons -->
                          <div class="btn_main d-flex justify-content-center align-items-center">
                            <!-- Buy Now Button -->
                            <form action="{{ route('addproducttocart') }}" method="POST" class=" ">
                              @csrf
                              <input type="hidden" value="{{ $product->id }}" name="product_id">
                              <input type="hidden" value="{{ $product->product_price }}" name="product_price">
                              <input type="hidden" value="1" name="quantity">
                              <input class="btn btn-warning px-4 my-3" type="submit" value="Buy Now">
                            </form>
                          </div>
                        </div>
                     </div>
                   </div>
                 </div>
              @endforeach
               </div>
               <!-- Carousel Controls -->
               <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
               </a>
               <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                  <i class="fa fa-angle-right"></i>
               </a>
            </div>
         </div>
      </div>
      <!-- Banner Section End -->



   </div>
   <!-- banner bg main end -->



   <!-- start common part -->
   <div class="container py-5" style="margin-top: 200px;>
      @yield("main-content")
   </div>

   <!-- end of common part -->



   <!-- footer section start -->
   <div class=" footer_section layout_padding">
      <div class="container">
         <div class="footer_logo"><a href="index.html"><img src="{{asset('home/images/footer-logo.png')}}"></a></div>
         <div class="input_bt">
            <input type="text" class="mail_bt" placeholder="abdulahalfahad9@gmail.com" name="Your Email">
            <span class="subscribe_bt" id="basic-addon2">
               <a href="https://www.facebook.com/abdullahaallfahad.nitul?mibextid=ZbWKwL" target="_blank">
                  <i class="fa fa-facebook-square" style="margin-right: 5px;"></i> Follow
               </a>
            </span>
         </div>
         <div class="footer_menu">
            <ul>
               <li><a href="#">Best Sellers</a></li>
               <li><a href="#">Gift Ideas</a></li>
               <li><a href="{{route('newrelease')}}">New Releases</a></li>
               <li><a href="{{route('todaysdeal')}}">Today's Deals</a></li>
               <li><a href="{{route('customerservice')}}">Customer Service</a></li>
            </ul>
         </div>
         <div class="location_main">Help Line Number : <a href="https://web.whatsapp.com/">+8801825037371</a></div>
      </div>
   </div>
   <!-- footer section end -->
   <!-- copyright section start -->
   <div class="copyright_section">
      <div class="container">
         <p class="copyright_text">© 2020 All Rights Reserved. Design by <a
               href="https://www.linkedin.com/in/abdullah-al-fahad-26569b1b6">Abdullah Al Fahad</a></p>
      </div>
   </div>
   <!-- copyright section end -->
   <!-- Javascript files-->
   <script src="{{asset('home/js/jquery.min.js')}}"></script>
   <script src="{{asset('home/js/popper.min.js')}}"></script>
   <script src="{{asset('home/js/bootstrap.bundle.min.js')}}"></script>
   <script src="{{asset('home/js/jquery-3.0.0.min.js')}}"></script>
   <script src="{{asset('home/js/plugin.js')}}"></script>
   <!-- sidebar {{asset('home/')}}-->
   <script src="{{asset('home/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
   <script src="{{asset('home/js/custom.js')}}"></script>
   <script>
      function openNav() {
         document.getElementById("mySidenav").style.width = "250px";
      }

      function closeNav() {
         document.getElementById("mySidenav").style.width = "0";
      }
   </script>

</body>

</html>