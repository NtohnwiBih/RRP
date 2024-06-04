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
@endpush
    <!-- start page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Post Management</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{route('post.create')}}" class="btn btn-sm bg-primary text-white">Add Post</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-rep-plugin view-section" id="table" >
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th data-priority="1"></th>
                                        <th data-priority="1"> Title</th>
                                        <th data-priority="1"> Author</th>
                                        <th data-priority="1"> Status</th>
                                        <th data-priority="1" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td data-priority="1">{{ $post->id }}</td>
                                        <td data-priority="1">{{$post->title}}</td>
                                        <td data-priority="1">{{ $post->user->name }}</td>
                                        <td data-priority="1" class="text-end">
                                            <form method="POST" action="{{route('activate-post')}}"
                                                class="active-deactive-form">
                                                @csrf
                                                <input name="post_id" value="{{$post->id}}" hidden/>
                                                <input name="current_status" value="{{$post->status}}" hidden/>
                                                <div class="form-check form-switch">
                                                    @if($post->status)
                                                        <input name="de_activate" class="btn btn-sm
                                                        btn-outline-danger" type="submit"
                                                            value="Deactivate">
                                                    @else
                                                        <input name="activate" class="btn btn-sm
                                                        btn-outline-success" type="submit"
                                                            value=" Activate ">
                                                    @endif

                                                </div>
                                            </form>
                                        </td>
                                        <td data-priority="1" class="text-end">
                                            <form action="{{ route('post.destroy',$post->id) }}" method="Post">
                                                <a class="btn btn-success" href=""> <i class='bx bxs-show'></i></a>
                                                <a class="btn btn-primary" href="{{ route('post.edit',$post->id) }}"> <i class='bx bxs-pencil'></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"> <i class='bx bxs-trash'></i></button>
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

        <script text="text/javascript">
             $(document).ready(function() {
            $('.views').on('click', function() {
                // Remove 'active' class from all nav items
                $('.views').removeClass('view-active');
                
                // Add 'active' class to the clicked nav item
                $(this).addClass('view-active');
                
                // Hide all sections
                $('.view-section').hide();
                
                // Show the target section
                var target = $(this).data('target');
                $(target).show();
            });
        });
        </script>

    
    @endpush
@endsection