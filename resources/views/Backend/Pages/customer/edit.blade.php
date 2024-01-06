@extends('backend.layout.app')
@section('title','Dashboard | Admin Panel')

@section('content')
<!-- start page title -->
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0 font-size-18">Edit the customer</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Customers</a></li>
          <li class="breadcrumb-item active">Edit the customer</li>
        </ol>
      </div>

    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h4 class="card-title mb-4">Customer overview</h4>

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
      @csrf
      @method('PUT')
      <!-- Use PUT method for update -->

      <div class="row">
        <div class="mb-3 col-md-4">
          <label for="formrow-firstname-input" class="form-label">First Name</label>
          <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
            id="formrow-firstname-input" placeholder="Enter Your First Name" value="{{ $customer->first_name }}">
          <!-- Error handling for the first name field -->
          @error('first_name')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3 col-md-4">
          <label for="formrow-lastname-input" class="form-label">Last Name</label>
          <input type="text" name="last_name" class="form-control" id="formrow-lastname-input"
            placeholder="Enter Your Last Name" value="{{ $customer->last_name }}">
        </div>

        <div class="mb-3 col-md-4">
          <label for="formrow-email-input" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="formrow-email-input"
            placeholder="Enter Your Email ID" value="{{ $customer->email }}">
        </div>


        <div class="mb-3 col-md-4">
          <label for="formrow-country-input" class="form-label">Country</label>
          <input type="text" name="country" class="form-control" id="formrow-country-input"
            placeholder="Enter Your Country" value="{{ $customer->country }}">
        </div>
        <div class="mb-3 col-md-4">
          <label for="formrow-city-input" class="form-label">City</label>
          <input type="text" name="city" class="form-control" id="formrow-city-input" placeholder="Enter Your City"
            value="{{ $customer->city }}">
        </div>

        <div class="mb-3 col-md-4">
          <label for="formrow-region-input" class="form-label">Region</label>
          <input type="text" name="region" class="form-control" id="formrow-region-input"
            placeholder="Enter Your Region" value="{{ $customer->region }}">
        </div>

        <div class="mb-3 col-md-4">
          <label for="formrow-phone-input" class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" id="formrow-phone-input"
            placeholder="Enter Your Phone Number" value="{{ $customer->phone }}">
        </div>
        <div class="mb-3 col-md-12">
          <label for="formrow-notes-input" class="form-label">Notes</label>
          <textarea name="notes" class="form-control" id="formrow-notes-input"
            placeholder="Enter Your Notes">{{ $customer->notes }}</textarea>
        </div>
      </div>
  </div>
</div>
<!-- Addresses -->
<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="mt-2">Addresses:</h5>
      <button type="button" id="addAddress" class="btn btn-info flex-grow-0">
        Add Address <i class="bi bi-plus"></i>
      </button>
    </div>
    <hr>
  </div>
</div>
@if($customer->addresses)
@foreach($customer->addresses as $address)
<div class="address card border p-2 mt-3">
  <div class="row">
    <!-- Fill in the existing address details -->
    <input type="hidden" name="address_id[]" value="{{ $address->id }}">
    <div class="mb-3 col-md-3">
      <label for="additional_first_name" class="form-label">First Name</label>
      <input type="text" name="additional_first_name[]" class="form-control"
        value="{{ $address->additional_first_name }}">
    </div>

    <div class="mb-3 col-md-3">
      <label for="additional_last_name" class="form-label">Last Name</label>
      <input type="text" name="additional_last_name[]" class="form-control"
        value="{{ $address->additional_last_name }}">
    </div>

    <div class="mb-3 col-md-3">
      <label for="additional_company_name" class="form-label">Company Name</label>
      <input type="text" name="additional_company_name[]" class="form-control"
        value="{{ $address->additional_company_name }}">
    </div>

    <div class="mb-3 col-md-3">
      <label for="additional_phone" class="form-label">Phone Number</label>
      <input type="text" name="additional_phone[]" class="form-control" value="{{ $address->additional_phone }}">
    </div>

    <div class="mb-3 col-md-12">
      <label for="additional_address_line_1" class="form-label">Address Line #1</label>
      <input type="text" name="additional_address_line_1[]" class="form-control"
        value="{{ $address->additional_address_line_1 }}">
    </div>

    <div class="mb-3 col-md-12">
      <label for="additional_address_line_2" class="form-label">Address Line #2</label>
      <input type="text" name="additional_address_line_2[]" class="form-control"
        value="{{ $address->additional_address_line_2 }}">
    </div>

    <div class="mb-3 col-md-3">
      <label for="additional_country" class="form-label">Country</label>
      <input type="text" name="additional_country[]" class="form-control" value="{{ $address->additional_country }}">
    </div>

    <div class="mb-3 col-md-3">
      <label for="additional_region" class="form-label">Region</label>
      <input type="text" name="additional_region[]" class="form-control" value="{{ $address->additional_region }}">
    </div>

    <div class="mb-3 col-md-3">
      <label for="additional_city" class="form-label">City</label>
      <input type="text" name="additional_city[]" class="form-control" value="{{ $address->additional_city }}">
    </div>

    <div class="mb-3 col-md-3">
      <label for="additional_zip_code" class="form-label">Zip Code</label>
      <input type="text" name="additional_zip_code[]" class="form-control" value="{{ $address->additional_zip_code }}">
    </div>


  </div>
</div>
@endforeach
@endif




<!-- Submit Button -->
<div class="card mt-3 text-center">
  <div>
    <button type="submit" class="btn btn-primary w-md">Update</button>
  </div>
</div>
</form>
</div>

@endsection
@push('script')
<script>
  $(document).ready(function() {
      let addressCount = 1;

      $('#addAddress').click(function() {
          addressCount++;

          const newAddress = $('.address:first').clone(); 

          
          newAddress.find('input, textarea').each(function() {
              const currentId = $(this).attr('id');
              const newName = currentId.replace('_1', `_${addressCount}`);
              $(this).attr('id', newName).attr('name', $(this).attr('name').replace('[]', `[]`));
              $(this).val(''); 
          });

          $('#addressForm').append(newAddress); // Append the cloned address div
      });
  });
</script>
@endpush