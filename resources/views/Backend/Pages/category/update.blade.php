@extends('backend.layout.app')

@section('title','Category | Admin Panel')

@push('page-wise-css')
<!-- DataTables -->
<link href="{{asset('backend-assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
  type="text/css" />
<link href="{{asset('backend-assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
  type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{asset('backend-assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
  rel="stylesheet" type="text/css" />
@endpush

@section('content')
<!-- start page title -->
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0 font-size-18">Category</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
          <li class="breadcrumb-item active">Category Create</li>
        </ol>
      </div>

    </div>
  </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-md-6 m-auto">
    <div class="card">
        <div class="card-header bg-info text-white"> <h4>Update Category</h4>  </div>
        <form action="{{route('admin.category.update',$data->id)}}" method="post" enctype="multipart/form-data">@csrf
            <div class="card-body">
                <div class="col-xl-12">
                    <div class="form-layout form-layout-4">

                        <div class="row mb-4">
                            <label class="col-sm-3 form-control-label">Cateogry Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" value="{{$data->category_name}}" required>
                            </div>
                        </div><!-- row -->
                        <div class="row mb-4 mt-4">
                            <label class="col-sm-3 form-control-label">Description: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <textarea type="text" class="form-control" name="category_description">{{ $data->category_description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4 mt-4">
                          <label class="col-sm-3 form-control-label">Category Icon: <span class="tx-danger">*</span></label>
                          <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                              <input type="file" id="iconInput" class="form-control" name="category_icon"><br>
                              
                              @if ($data->icon)
                                  <img class="img-fluid rounded" width="100px" height="50px" id="showIcon" src="{{ asset('backend-assets/images/category/' . $data->icon) }}" id="showIcon" alt="">
                              @else
                                  <img class="img-fluid rounded" width="100px" height="50px" id="showIcon" src="{{ asset('backend-assets/images/default.jpg') }}" id="showIcon" alt="">
                              @endif
                          </div>
                      </div>

                      <div class="row mb-4 mt-4">
                        <label class="col-sm-3 form-control-label">Category Image: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="file" class="form-control" name="category_image" id="imageInput" /><br>
                           
                            @if ($data->image_path)
                                  <img class="img-fluid rounded" width="100px" height="50px"  src="{{ asset('backend-assets/images/category/' . $data->image_path) }}" id="showImage" alt="">
                              @else
                                  <img class="img-fluid rounded" width="100px" height="50px"  src="{{ asset('backend-assets/images/default.jpg') }}" id="showImage" alt="">
                              @endif
                        </div>
                      </div>

                        

                        <div class="row mb-4 mt-4">
                            <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select class="form-select " name="status" required>
                                    <option value="">---Select---</option>
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $data->status == 2 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Add New</button>
                <button type="button" onclick="history.back();" class="btn btn-danger">Back</button>
            </div>
        </form>
   </div> 
    </div>
   </div>


@endsection

@push('page-wise-script')
<!-- Required datatable js -->
<script src="{{asset('backend-assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend-assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Datatable init js -->
<script src="{{asset('backend-assets/js/pages/datatables.init.js')}}"></script>

<script type="text/javascript">
    iconInput.onchange = evt => {
      const [file] = iconInput.files
      if (file) {
        showIcon.src = URL.createObjectURL(file)
      }
    }
    imageInput.onchange = evt => {
      const [file] = imageInput.files
      if (file) {
        showImage.src = URL.createObjectURL(file)
      }
    }
</script>
@endpush
