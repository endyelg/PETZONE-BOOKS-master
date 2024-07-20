@extends('admin.layouts.app')

@section('title' , 'Admin-Categories')

@section('content')
{{-- Add category form start --}}
<div class="col-12 mt-5"> 
  <div class="card">
    <form action="{{ route('admin.categories.storage') }}" method="POST">
    @csrf
      <div class="card-body">
          <div class="row">
              <div class="col">
                <input type="text" name="slug" class="form-control" placeholder="Website Genre" aria-label="slug">
              </div>
              <div class="col">
                <input type="text" name="title" class="form-control" placeholder="Category" aria-label="title">
              </div>
          </div>
      </div>
      <div class="d-grid gap-2 col-6 mx-auto">
          <button class="btn btn-primary" type="txt">Add Category</button>
      </div>
    </form>
  </div>
</div>
{{-- Add category form end --}}
<hr>
<!-- Categories list start -->
<div class="main-content-inner">
  <div class="row">
    {!! $dataTable->table(['class' => 'table table-bordered table-striped', 'id' => 'categories-table'], true) !!}
  </div>
</div>
<!-- Categories list end -->
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.0/css/dataTables.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.dataTables.min.js"></script>
    <script>
        var categoriesIndexUrl = "{{ route('admin.categories.index') }}";
    </script>
    <script src="{{ asset('public/js/datatables-init.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush