@extends('backend.layout.app')
@section('title','Dashboard | Admin Panel')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Create a customer</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Customers</a></li>
                    <li class="breadcrumb-item active">Create a customer</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Customer overview</h4>

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="formrow-firstname-input" class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                        id="formrow-firstname-input" placeholder="Enter Your First Name"
                        value="{{ old('first_name') }}">
                    @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label for="formrow-lastname-input" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="formrow-lastname-input"
                        placeholder="Enter Your Last Name" value="{{ old('last_name') }}">
                </div>

                <div class="mb-3 col-md-4">
                    <label for="formrow-email-input" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="formrow-email-input" placeholder="Enter Your Email ID" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-4">
                    <label for="formrow-country-input" class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" id="formrow-country-input"
                        placeholder="Enter Your Living Country" value="{{ old('country') }}">
                </div>

                <div class="mb-3 col-md-4">
                    <label for="formrow-city-input" class="form-label">City</label>
                    <input type="text" name="city" class="form-control" id="formrow-city-input"
                        placeholder="Enter Your Living City" value="{{ old('city') }}">
                </div>

                <div class="mb-3 col-md-4">
                    <label for="formrow-region-input" class="form-label">Region</label>
                    <select name="region" id="formrow-region-input" class="form-select">
                        <option value="" selected>Choose...</option>
                        <!-- Add options dynamically if needed -->
                        <!-- Example: -->
                        <option value="region1" {{ old('region')==='region1' ? 'selected' : '' }}>Region 1</option>
                        <option value="region2" {{ old('region')==='region2' ? 'selected' : '' }}>Region 2</option>
                        <!-- Add more options as necessary -->
                    </select>
                </div>

                <div class="mb-3 col-md-4">
                    <label for="formrow-phone-input" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" id="formrow-phone-input"
                        placeholder="Enter Your Phone Number" value="{{ old('phone') }}">
                </div>

                <div class="mb-3 col-md-12">
                    <label for="formrow-notes-input" class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" id="formrow-notes-input"
                        placeholder="Enter Your Notes">{{ old('notes') }}</textarea>
                </div>
            </div>

    </div>
    <!-- end card body -->
</div>

{{-- addresses --}}
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mt-2">Additional Addresses:</h5>
            <button type="button" id="addAddress" class="btn btn-info flex-grow-0">
                Add Address <i class="bi bi-plus"></i>
            </button>
        </div>
        <hr>
    </div>
</div>


<!-- Address Form -->
<div id="addressForm">
    <!-- Existing fields for one address -->
    <div class="address card border p-2 mt-3">
        <div class="row">
            <div class="mb-3 col-md-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control @error('additional_first_name') is-invalid @enderror"
                    id="first_name" name="additional_first_name[]" placeholder="Enter Your First Name"
                    >
                @error('additional_first_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control @error('additional_last_name') is-invalid @enderror"
                    id="last_name" name="additional_last_name[]" placeholder="Enter Your Last Name"
                    >
                @error('additional_last_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label for="email" class="form-label">Company Name</label>
                <input type="text" class="form-control @error('additional_company_name') is-invalid @enderror" id="email"
                    name="additional_company_name[]" placeholder="Enter Your Company Name" >
                @error('additional_company_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control @error('additional_phone') is-invalid @enderror" id="phone"
                    name="additional_phone[]" placeholder="Enter Your Phone Number" >
                @error('additional_phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-md-12">
                <label for="address_line_1" class="form-label">Address Line #1</label>
                <input type="text" class="form-control @error('additional_address_line_1') is-invalid @enderror"
                    id="address_line_1" name="additional_address_line_1[]" placeholder="Enter Address Line #1"
                    >
                @error('additional_address_line_1')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-12">
                <label for="address_line_2" class="form-label">Address Line #2</label>
                <input type="text" class="form-control @error('additional_address_line_2') is-invalid @enderror"
                    id="address_line_2" name="additional_address_line_2[]" placeholder="Enter Address Line #2"
                  >
                @error('additional_address_line_2')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3 col-md-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control @error('additional_country') is-invalid @enderror" id="country"
                    name="additional_country[]" placeholder="Enter Your Country" >
                @error('additional_country')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label for="region" class="form-label">Region</label>
                <input type="text" class="form-control @error('additional_region') is-invalid @enderror" id="region"
                    name="additional_region[]" placeholder="Enter Your Region" >
                @error('additional_region')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control @error('additional_city') is-invalid @enderror" id="city"
                    name="additional_city[]" placeholder="Enter Your City" >
                @error('additional_city')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label for="zip_code" class="form-label">Zip code</label>
                <input type="text" class="form-control @error('additional_zip_code') is-invalid @enderror" id="zip_code"
                    name="additional_zip_code[]" placeholder="Enter Your Zip Code" >
                @error('additional_zip_code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>



<div class="card mt-3 text-center">
    <div>
        <button type="submit" class="btn btn-primary w-md">Submit</button>
    </div>
</div>
</form>
@endsection

@push('script')
<script>
  $(document).ready(function() {
        let addressCount = 1;

        $('#addAddress').click(function() {
            addressCount++;

            const newAddress = $('.address:first').clone();

            newAddress.find('input, textarea').each(function() {
                let currentId = $(this).attr('id');
                let newName = currentId.replace('_1', `_${addressCount}`);
                $(this).attr('id', newName).attr('name', $(this).attr('name').replace('[]', `[]`));
                $(this).val('');
            });

            $('#addressForm').append(newAddress);
        });
    });
</script>
@endpush