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
          <li class="breadcrumb-item active">Category Update</li>
        </ol>
      </div>

    </div>
  </div>
</div>
<!-- end page title -->
<div class="row">
  <div class="col-md-8 m-auto">
    <div class="card">
        <div class="card-header">
           <h4>Category Update</h4>
        </div>
      <div class="card-body">
      <form  action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label for="" class="form-label">Category Name</label>
              <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" value="{{$data->category_name}}" required>
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Description</label>
              <textarea type="text" class="form-control" name="description" placeholder="Enter Description">{{$data->category_description}}</textarea>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Category Icon</label>
              <input type="file" class="form-control" name="category_icon">
              <img src="" alt="">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Category Image</label>
              <input type="file" class="form-control" name="category_image">
              <img src="{{asset('Backend-assets/images/category',$data->category_image)}}" alt="">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Status</label>
              <select type="text" class="form-control"  name="status" required>
                <option value="">---Select---</option>
              <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
              <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <button type="button" onclick="history.back()" class="btn btn-danger">Back</button>
          </form>
      </div>
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
    $(document).ready(function(){
        $("#datatable").DataTable();
        $('#addModal form').submit(function(e){
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function (response) {
                    console.log(response); 
                    return false;
                    $('#addModal').modal('hide');
                    $('#addModal form')[0].reset();
                    if (response.success) {
                    toastr.success(response.success);
                    $('#datatable1').DataTable().ajax.reload( null , false);
                    } else {
                        if (response.errors) {
                            var errorMessages = response.errors.join('<br>');
                            toastr.error(errorMessages);
                        }else {
                            toastr.error("Error!!!");
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endpush
