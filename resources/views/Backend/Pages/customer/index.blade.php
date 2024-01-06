@extends('backend.layout.app')
@section('title','Dashboard | Admin Panel')

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
        <h4 class="mb-sm-0 font-size-18">Customers</h4>
  
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="#">Customers</a></li>
            <li class="breadcrumb-item active">Customer list</li>
          </ol>
        </div>
  
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Customer List</h4>
          <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Creation Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($customers as $customer)
              <tr>
                <td>{{$customer->first_name.' '.$customer->last_name}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->created_at }}</td>
                <td>
                  <a class="btn btn-sm btn-warning" href="{{ route('customers.edit', $customer->id) }}">
                      <i class="fas fa-edit"></i> 
                  </a>
                 
                  <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')">
                          <i class="fas fa-trash-alt"></i> <!-- Font Awesome trash icon -->
                      </button>
                  </form>
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
 <!-- Buttons examples -->
 <script src="{{('backend-assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{('backend-assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
 <script src="{{('backend-assets/libs/jszip/jszip.min.js')}}"></script>
 <script src="{{('backend-assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
 <script src="{{('backend-assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
 <script src="{{('backend-assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
 <script src="{{('backend-assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
 <script src="{{('backend-assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
 
 <!-- Responsive examples -->
 <script src="{{('backend-assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{('backend-assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Datatable init js -->
<script src="{{('backend-assets/js/pages/datatables.init.js')}}"></script>
@endpush