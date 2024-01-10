@extends('backend.layout.app')
@section('title','Dashboard | Admin Panel')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Basic Shipping</h4>
  
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Shipping</a></li>
            <li class="breadcrumb-item active">Basic Shipping</li>
          </ol>
        </div>
  
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <!-- Customer Information -->
            <h4>Customer Information</h4>
            <div class="mb-3">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name">
            </div>
            <!-- Add other customer fields: last name, email, phone, etc. -->
        
            <!-- Shipping Address -->
            <h4>Shipping Address</h4>
            <div class="mb-3">
                <label for="shipping_first_name">First Name</label>
                <input type="text" class="form-control" id="shipping_first_name" name="shipping_first_name">
            </div>
            <!-- Add other shipping address fields: last name, phone, address, city, region, country, postal code, etc. -->
        
            <!-- Billing Address -->
            <h4>Billing Address</h4>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="same_as_shipping">
                <label class="form-check-label" for="same_as_shipping">Same as Shipping Address</label>
            </div>
            <div class="mb-3" id="billing_address_section" style="display: none;">
                <!-- Fields for billing address -->
                <label for="billing_first_name">First Name</label>
                <input type="text" class="form-control" id="billing_first_name" name="billing_first_name">
                <!-- Add other billing address fields: last name, phone, address, city, region, country, postal code, etc. -->
            </div>
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
    </div>
  </div>
@endsection