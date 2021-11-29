@extends('layouts.admin')

@section('title', 'User List')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
@endsection
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('content')
<!-- Basic table -->
<section id="admin_user">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <table class="datatables-basic table">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th>id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Position</th>
              <th>Phone</th>
              <th>Action</th>
              <!-- <th>Action</th> -->
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <!-- Modal to add new record -->
  
  
</section>
<!--/ Basic table -->
@endsection
@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <!-- <script src="{{ asset('js/scripts/tables/table-datatables-basic.js') }}"></script> -->
  <script>var userslistUrl = "{{ route('admin.getuserslist')}}";</script>
  <script src="{{ asset('js/scripts/tables/admin-user-datatables.js') }}"></script>
@endsection
