@extends('backend.Layout.app')
@section('title','Dashboard | Admin Panel')

@section('content')
<!-- start page title -->

<!-- end row -->
<!-- end page title -->
@endsection





{{-- Here is page title example --}}

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


{{-- vaidation sample --}}

try {
  $request->validate([
      'name' => [
          'required',
          'string',
          'max:255',
          Rule::unique('permissions')->where(function ($query) {
              return $query->where('guard_name', 'web');
          }),
      ],
  ]);

  $permission = Permission::create([
      'name' => $request->name,
      'guard_name' => 'web',
  ]);

  return back()->with('message', 'Permission created successfully');
} catch (ValidationException $e) {
  return back()->withErrors($e->validator->errors()->all())->withInput();
} catch (\Exception $e) {
  return back()->with('error', 'Something went wrong');
}