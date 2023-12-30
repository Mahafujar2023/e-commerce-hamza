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
                    <button data-toggle="modal" data-target="#deleteModal{{$item->id}}" class="btn btn-danger btn-sm mr-3"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
              <!-- Static Backdrop Modal -->
            <div class="modal fade" id="deleteModal{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <p>I will not close if you click outside me. Don't even try to press escape key.</p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Understood</button>
                      </div>
                  </div>
              </div>
            </div>
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
