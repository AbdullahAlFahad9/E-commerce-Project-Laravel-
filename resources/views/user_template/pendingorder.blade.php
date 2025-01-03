@extends('user_template.layouts.user_profile_template')

@section('profilecontent')
<h2 class="my-4 text-primary">Pending Orders</h2>

@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Recipient</th>
                <th>Phone</th>
                <th>zip</th>
                <th>City</th>   
                <th>Qnt.</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pending_orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                        
                            <img src="{{ asset($order->product_image) }}" alt="Product Image" class="img-thumbnail" style="height: 50px; width: 50px; margin-right: 10px;">
                            
                            <div class="product-info">
                            <span>ID: {{ $order->product_id }}</span> <br>
                            <span>{{ $order->product_name }}</span>
                        </div>
                        </div>
                    </td>
                    <td>
                             <span>ID: {{ $order->userid }}</span> <br>
                             <span>{{ $order->shipping_recipient_name }}</span>
                    </td>
                    <td>{{ $order->shipping_phone_number }}</td>
                    <td>{{ $order->shipping_postal_code }}</td>
                    <td>{{ $order->shipping_city_name }}</td>       
                    <td>{{ $order->product_quantity }}</td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <span class="badge badge-warning">{{ $order->status }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
