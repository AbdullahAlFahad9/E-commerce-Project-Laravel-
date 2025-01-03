@extends('user_template.layouts.template')

@section('main-content')
<div class="container py-5">
    <h2 class="mb-4 text-center font-weight-bold">Final Step to Place Your Order</h2>
    <div class="row">
        <!-- Shipping Address Section (Smaller Container) -->
        <div class="col-lg-5">
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Shipping Details</h4>
                </div>
                <div class="card-body">
                    <p><strong style="font-weight: bold;">Recipient's Name:</strong> {{$shipping_address->recipient_name}}</p>
                    <p><strong style="font-weight: bold;">Phone Number:</strong> {{$shipping_address->phone_number}}</p>
                    <p><strong style="font-weight: bold;">City:</strong> {{$shipping_address->city_name}}</p>
                    <p><strong style="font-weight: bold;">Postal Code:</strong> {{$shipping_address->postal_code}}</p>
                    <p><strong style="font-weight: bold;">Full Address:</strong> {{$shipping_address->address}}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Your Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($cart_items as $item)
                                                                @php
                                                                    $product_name = App\Models\product::where('id', $item->product_id)->value('product_name');
                                                                    $product_image = App\Models\product::where('id', $item->product_id)->value('product_img');
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        <img src="{{ asset($product_image) }}" class="img-fluid"
                                                                            style="height: 50px; width: 50px;">
                                                                    </td>
                                                                    <td>{{ $product_name }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>{{ $item->price }}</td>
                                                                </tr>
                                                                @php    $total += $item->price; @endphp
                                @endforeach
                                <tr>
                                    <td colspan="2"></td>
                                    <td><strong>Total:</strong></td>
                                    <td><strong>{{ $total }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->

    <div class="d-flex justify-content-center mt-4">
        <form action="{{route('placeorder')}}" method="POST" class="mr-2">
            @csrf
            <input type="submit" value="Place Order" class="btn btn-success btn-lg px-5">
        </form>

        <form action="" method="POST">
            @csrf
            <input type="submit" value="Cancel Order" class="btn btn-outline-danger btn-lg px-5">
        </form>
    </div>
</div>

@endsection