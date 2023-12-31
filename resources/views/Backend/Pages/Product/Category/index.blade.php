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
          <li class="breadcrumb-item active">Category List</li>
        </ol>
      </div>

    </div>
  </div>
</div>
<!-- end page title -->
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#addModal">Create New Category</button>
        </div>
      <div class="card-body">
        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Category Name</th>
              <th>Create Date</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($data as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>
                    @if($item->image_path)
                    <img class="img-circle" height="50px"  src="{{ asset('backend-assets/images/category/' . $item->category_image) }}" alt="Photo">

                    @else
                        <img src="{{ asset('backend-assets/images/default.jpg') }}" height="50px" alt="Default Photo">
                    @endif
                </td>
              <td>{{$item->category_name }}</td>
              <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
              <td>
                @if ($item->status==1)
                  <span class="badge  bg-success ">Active</span>
                  @else 
                  <span class="badge bg-danger">InActive</span>
                @endif
              </td>
              <td>
                <!-- Add your action buttons here -->
                <a class="btn btn-primary btn-sm mr-3" href="{{route('admin.category.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                    <button  type="button"  data-id="{{ $item->id }}"  class="btn btn-danger delete-btn btn-sm mr-3"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
              <!-- Static Backdrop Modal -->
            
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Modal for creating a new Category -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create New Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form for creating a new permission -->
          <form  action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="" class="form-label">Category List</label>
              <select type="text" class="form-control"  name="parent_id">
                    <option value="">---Select---</option>
                    @forelse ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                    @empty
                        <option value="" disabled>No categories available</option>
                    @endforelse
              </select>
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Category Name</label>
              <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" required>
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Description</label>
              <textarea type="text" class="form-control" name="description" placeholder="Enter Description"></textarea>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Category Icon</label>
              <input type="file" class="form-control" name="category_icon">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Category Image</label>
              <input type="file" class="form-control" name="category_image">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Status</label>
              <select type="text" class="form-control"  name="status" required>
                <option value="">---Select---</option>
                <option value="1">Active</option>
                <option value="0">InActive</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <form action="{{route('admin.category.delete')}}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="tx-danger  tx-semibold mg-b-20 mt-2">Are you sure! you want to delete this?</h4>
                <input type="hidden" name="id" value="">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="sumit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
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
<<<<<<< HEAD
                console.log(response);
                return false;
=======
>>>>>>> 5106b30234320e5b6ce7571314226bb4b72733ea
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

      /** Handle Delete button click**/
      $('#datatable tbody').on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        $('#deleteModal').modal('show');
        var value_input = $("input[name*='id']").val(id);
      });
        /** Handle form submission for delete **/
      $('#deleteModal form').submit(function(e){
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();
        /** Use Ajax to send the delete request **/
        $.ajax({
          type:'POST',
          'url':url,
          data: formData,
          success: function (response) {
            $('#deleteModal').modal('hide');
            if (response.success) {
              toastr.success(response.success);
              //table.ajax.reload();
              $('#datatable').DataTable().ajax.reload( null , false);
            } else {
              /** Handle  errors **/
              toastr.error("Error!!!");
            }
          },

          error: function (xhr, status, error) {
            /** Handle  errors **/
            toastr.error(xhr.responseText);
          }
        });
      });


  });
</script>
@endpush
