@extends('admin.layouts.master')
@section('title',  __('messages.global.dashboard'))
@section('content')
@push('css')
    
        <link href="{{ URL::to('assets/css/custom.css') }}" rel="stylesheet" type="text/css" >
        <!-- DataTables -->
        <link href="{{ URL::to('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::to('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ URL::to('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <style>
            .hide {
            display: none;
            }
        </style>
@endpush
    <!-- start page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Post</h4>
                </div>
                <div class="card-body p-4">
                    <form class="forms-sample" action="{{ route('post.store') }}"   method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="link">Short Description</label>
                            <textarea name="short" class="form-control"  id="short" cols="15" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="title">Content</label>
                            <textarea name="content" class="form-control"  id="ckeditor-classic"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Featured Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="formrow-firstname-input">Date <strong class="is-small">(e.g: dd mm, xxxx)</strong></label>
                            <input type="text" name="date" class="form-control" >
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset"  class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
             <!-- end card -->
           </div> <!-- end col -->
    </div>

    @push('scripts')
              <!-- pristine js -->
              <script src="{{ URL::to('assets/libs/pristinejs/pristine.min.js')}}"></script>
        <!-- form validation -->
        <script src="{{ URL::to('assets/js/pages/form-validation.init.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{ URL::to('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::to('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::to('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::to('assets/js/pages/datatables.init.js')}}"></script>
    @endpush
@endsection