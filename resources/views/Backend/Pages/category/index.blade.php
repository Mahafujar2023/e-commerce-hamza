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
            <a href="{{route('admin.category.create')}}" class="btn btn-success ">Create New Category</a>
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

          </tbody>
        </table>
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

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script type="text/javascript">

    var table=$("#datatable").DataTable({
        "processing":true,
       "responsive": true,
       "serverSide":true,
       beforeSend: function () {
       },
       ajax: "{{ route('admin.category.all_data') }}",
      language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
       },
       "columns":[
         {
           "data":"id"
         },
         {
           "data":"image_path",
           render: function (data, type, row) {
             return '<img src="{{asset("backend-assets/images/category")}}/' + data + '" alt="Image" width="50" height="50">';
           }
         },
         {
           "data":"category_name"
         },
         {
           "data":"created_at",
           render: function (data, type, row) {
               var formattedDate = moment(row.created_at).format('DD MMM YYYY');
               return formattedDate;
           }
         },
         {
           "data":"status",
           render:function(data,type,row){
             if (row.status==1) {
               return '<span class="badge bg-success">Active</span>';
             }else{
               return '<span class="badge bg-danger">Inactive</span>';
             }
           }
         },

         {
           render:function(data,type,row){
             return `<a href="/admin/product/category/edit/${row.id}" class="btn btn-primary btn-sm mr-3"><i class="fa fa-edit"></i></a>
               <button class="btn btn-danger btn-sm mr-3 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="${row.id}"><i class="fa fa-trash"></i></button>`
           }
         },
       ],
       order:[
         [0, "desc"]
       ],

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
</script>
@endpush
