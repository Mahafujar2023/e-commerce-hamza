@extends('backend.Layout.app')
@section('title','Dashboard | Admin Panel')

@section('content')
<!-- start page title -->
<!-- start page title -->
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Basic Tables</h4>
  
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
            <li class="breadcrumb-item active">Basic Tables</li>
          </ol>
        </div>
  
      </div>
    </div>
  </div>
  <!-- end page title -->
<!-- end row -->
<!-- end page title -->
<form action="{{ route('saveRolePermissions', $role->id) }}" method="POST">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Permission</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                        {{ $permission->name }}
                    </td>
                    <td>...</td> <!-- Action column if needed -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="btn btn-primary">Save Permissions</button>
</form>

@endsection