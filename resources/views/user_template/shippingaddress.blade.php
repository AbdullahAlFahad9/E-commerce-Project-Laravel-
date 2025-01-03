@extends('user_template.layouts.template')

@section('main-content')
<div class="container">
<div class="row justify-content-center my-5">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Delivery Information</h4>
            </div>
            <div class="card-body">
                <form action="{{route('addshippinginfo')}}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Recipient Name -->
                    <div class="form-group mb-3">

                        <label for="recipient_name" class="font-weight-bold">Recipient's Name</label>
                        <input type="text" class="form-control" id="recipient_name" name="recipient_name"
                            value="{{ old('recipient_name')}}" placeholder="Enter recipient's name" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group mb-3">
                        <label for="phone_number" class="font-weight-bold">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            placeholder="Enter phone number" required>
                    </div>

                    <!-- City/Village/District -->
                    <div class="form-group mb-3">
                        <label for="city_name" class="font-weight-bold">Village Name/City/District</label>
                        <input type="text" class="form-control" id="city_name" name="city_name"
                            placeholder="Enter city or district" required>
                    </div>

                    <!-- Postal Code -->
                    <div class="form-group mb-3">
                        <label for="postal_code" class="font-weight-bold">Postal/Zip Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                            placeholder="Enter postal or zip code" required>
                    </div>

                    <!-- Full Address -->
                    <div class="form-group mb-4">
                        <label for="address" class="font-weight-bold">Full Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3"
                            placeholder="Enter full address" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            Next
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection