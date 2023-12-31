@extends('backend.layout.app')

@section('title','Permission | Admin Panel')

@push('page-wise-css')
<!-- DataTables -->
<link href="{{('backend-assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{('backend-assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
    type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{('backend-assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
    rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endpush

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Permissions</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Permissions</a></li>
                    <li class="breadcrumb-item active">Permission List</li>
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
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Permission List</h4>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createPermissionModal">Create A New Permission</button>
                </div>
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Permission Name</th>
                            <th>Guard</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->guard_name }}</td>
                            <td>   <!-- Edit Button -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $permission->id }}">Edit</button>
                                
                                <!-- Delete Button -->
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeletion('{{ route('permissions.delete', $permission->id) }}')">Delete</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal{{ $permission->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $permission->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $permission->id }}">Edit Permission
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('updatePermission', $permission->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="editName{{ $permission->id }}"
                                                    class="form-label">Name</label>
                                                <input type="text" class="form-control"
                                                    id="editName{{ $permission->id }}" name="name"
                                                    value="{{ $permission->name }}">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
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

<!-- Modal for creating a new permission -->
<div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for creating a new permission -->
                <form action="{{route('createPermission')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="permissionName" class="form-label">Permission Name</label>
                        <input type="text" class="form-control" id="permissionName" name="name"
                            placeholder="Enter Permission Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="guardName" class="form-label">Guard Name</label>
                        <input type="text" class="form-control" id="guardName" name="guard_name" value="web"
                            placeholder="web" disabled>
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
<script src="{{('backend-assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{('backend-assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Datatable init js -->
<script>
     $(document).ready(function() {
        $('#datatable').DataTable();
    });
     function confirmDeletion(deleteUrl) {
        if (confirm('Are you sure you want to delete this permission?')) {
            window.location.href = deleteUrl;
        }
    }
</script>

@endpush