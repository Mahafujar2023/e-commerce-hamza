@extends('backend.layout.app')
@section('title','Add Product | Admin Panel')

@section('content')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Add Product</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Basic Information</h4>
                <p class="card-title-desc">Fill all information below</p>

                <form action="{{url('admin/ecommerce/product/store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="productname">Product Name</label>
                                <input id="productname" name="product_name" type="text" class="form-control" placeholder="Product Name">
                            </div>
                            <div class="mb-3">
                                <label for="manufacturername">SKU</label>
                                <input id="sku" name="sku" type="text" class="form-control" placeholder="SKU">
                            </div>
                            <div class="mb-3">
                                <label for="price">Regular Price</label>
                                <input id="price" name="regular_price" type="number" class="form-control" placeholder="Regular Price">
                            </div>
                            <div class="mb-3">
                                <label for="discount_price">Discount Price</label>
                                <input id="discount_price" name="discount_price" type="number" class="form-control" placeholder="Discount Price">
                            </div>
                            <div class="mb-3">
                                <label for="price">Product Weight</label>
                                <input id="price" name="product_weight" type="number" class="form-control" placeholder="Product Weight">
                            </div>
                            
                            <div class="mb-3">
                                <label for="image">Gallary Image</label>
                                <input id="image" name="images" multiple type="file" class="form-control" placeholder="Quantity">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="control-label">Category</label>
                                <select class="form-control select2">
                                    <option name="category">Select</option>
                                    @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="mb-3">
                                <label class="control-label">Features</label>
                                <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                                    <option value="WI">Wireless</option>
                                    <option value="BE">Battery life</option>
                                    <option value="BA">Bass</option>
                                </select>
                            </div> --}}
                            <div class="mb-3">
                                <label for="quantity">Quantity</label>
                                <input id="quantity" name="quantity" type="number" class="form-control" placeholder="Quantity">
                            </div>
                            <div class="mb-3">
                                <label for="product_note">Product Note</label>
                                <input id="product_note" name="product_note" type="text" class="form-control" placeholder="Product  Note">
                            </div>
                            <div class="mb-3">
                                <label for="short_description">Short Description</label>
                                <input id="short_description" name="short_description" type="text" class="form-control" placeholder="Short Description">
                            </div>
                            <div class="mb-3">
                                <label for="productdesc">Product Description</label>
                                <textarea name="product_description" class="form-control" id="productdesc" rows="5" placeholder="Product Description"></textarea>
                            </div>
                            
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        {{-- <button type="button" class="btn btn-secondary waves-effect waves-light">Cancel</button> --}}
                    </div>
                </form>

            </div>
        </div>

        {{-- <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Product Images</h4>

                <form action="/" method="post" class="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>

                    <div class="dz-message needsclick">
                        <div class="mb-3">
                            <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                        </div>
                        
                        <h4>Drop files here or click to upload.</h4>
                    </div>
                </form>
            </div>

        </div> <!-- end card-->

        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Meta Data for SEO</h4>
                <p class="card-title-desc">Fill all information below</p>

                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="metatitle">Meta title</label>
                                <input id="metatitle" name="productname" type="text" class="form-control" placeholder="Metatitle">
                            </div>
                            <div class="mb-3">
                                <label for="metakeywords">Meta Keywords</label>
                                <input id="metakeywords" name="manufacturername" type="text" class="form-control" placeholder="Meta Keywords">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="metadescription">Meta Description</label>
                                <textarea class="form-control" id="metadescription" rows="5" placeholder="Meta Description"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                        <button type="submit" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                    </div>
                </form>

            </div>
        </div> --}}

    </div>
</div>
<!-- end row -->

@endsection