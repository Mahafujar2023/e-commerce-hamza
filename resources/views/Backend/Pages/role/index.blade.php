@extends('backend.layout.app')

@section('title','Role | Admin Panel')

@push('page-wise-css')
<!-- DataTables -->
<link href="{{('backend-assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
  type="text/css" />
<link href="{{('backend-assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
  type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{('backend-assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
  rel="stylesheet" type="text/css" />
@endpush

@section('content')
<!-- start page title -->
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0 font-size-18">Roles</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">Roles</a></li>
          <li class="breadcrumb-item active">Role List</li>
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
        <h4 class="card-title">Role List</h4>
        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
          <thead>
            <tr>
              <th>ID</th>
              <th>Role Name</th>
              <th>Guard</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($roles as $role)
            <tr>
              <td>{{$role->id}}</td>
              <td>{{$role->name}}</td>
              <td>{{$role->guard_name }}</td>
              <td>
                <a class="btn btn-sm btn-warning" href="{{route('hasPermissionsPage',$role->id)}}">Assign/Change permissions</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('page-wise-script')
<!-- Required datatable js -->
<script src="{{('backend-assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{('backend-assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Datatable init js -->
<script src="{{('backend-assets/js/pages/datatables.init.js')}}"></script>
@endpush