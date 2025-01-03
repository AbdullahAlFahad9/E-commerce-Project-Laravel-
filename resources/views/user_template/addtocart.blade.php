@extends('user_template.layouts.template')

@section('main-content')
<h2>Add to cart page</h2>
@if (session()->has('message'))
    <div class=" alert alert-success">
        {{session()->get('message')}}
    </div>

@endif
<div class="container py-5">
<div class="row">
    <div class="col-12">
        <div class="box_main">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>

                    @php
                        $total = 0;
                    @endphp

                    @foreach ($cart_items as $item)
                                        <tr>
                                            @php
                                                $product_name = App\Models\product::where('id', $item->product_id)->value('product_name');
                                                $product_image = App\Models\product::where('id', $item->product_id)->value('product_img');
                                            @endphp
                                            <td><img src="{{asset($product_image)}}" style="height: 50px"></td>
                                            <!-- product_id to product_image catch  -->
                                            <td>{{$product_name}}</td> <!-- product_id to product_name catch  -->
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->price}}</td>
                                            <td><a href="{{route('removecartitem',$item->id)}}" class="btn btn-warning">Remove</a></td>
                                        </tr>
                                        @php
                                            $total = $total + $item->price; 
                                        @endphp

                    @endforeach

                    <tr> 
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>{{$total}}</td>
                        @if ($total <= 0)
                        <td><a href="" class="btn btn-primary disabled">Checkout</a></td>
                        @else
                        <td><a href="{{route('shippingaddress',$item->id)}}" class="btn btn-primary">Checkout</a></td>
                        @endif
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection