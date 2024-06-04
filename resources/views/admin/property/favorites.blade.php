@php
   $userId = auth()->id();  
@endphp
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
            .bg-light-success{background-color:#c7f3de!important}
            .bg-light-danger{background-color:#f5a7a4!important}

            .app-card .app-card-body.has-card-actions{
                position:relative;
                padding-right:1rem !important
            }
            .app-card .app-card-body .app-card-actions{
                display:inline-block;
                width:30px;
                height:30px;
                text-align:center;
                border-radius:50%;
                position:absolute;
                z-index:10;
                right:.75rem;
                top:.75rem
            }
            .app-card .app-card-body .app-card-actions:hover{
                background:#f5f6fe
            }
            .app-card .app-card-body .app-card-actions .dropdown-menu{
                font-size:.8125rem
            }
            .app-card-doc:hover{
                box-shadow:0 .5rem 1rem rgba(0,0,0,.15) !important
            }
            .app-card-doc .app-card-thumb-holder{
                background:#e9eaf1;
                text-align:center;
                position:relative;
                height:112px
            }
            .app-card-doc .app-card-thumb-holder .app-card-thumb{
                overflow:hidden;
                position:absolute;
                left:0;
                top:0;
                width:100%;
                height:100%;
                background:#000
            }
            .app-card-doc .app-card-thumb-holder .thumb-image{
                -webkit-opacity:.7;
                -moz-opacity:.7;
                opacity:.7;
                width:100%;
                height:auto
            }
            .app-card-doc .app-card-thumb-holder:hover{
                background:#fafbff
            }
            .app-card-doc .app-card-thumb-holder:hover .thumb-image{
                -webkit-opacity:1;
                -moz-opacity:1;
                opacity:1
            }
            .app-card-doc .app-card-thumb-holder .badge{
                position:absolute;
                right:.5rem;
                top:.5rem
            }
            .app-card-doc .app-card-thumb-holder .icon-holder{
                font-size:40px;
                display:inline-block;
                margin:0 auto;
                width:80px;
                height:80px;
                border-radius:50%;
                background:#fff;
                padding-top:10px
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .pdf-file
            {
                color:#da2d27
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .text-file{
                color:#66a0fd
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .excel-file{
                color:#0da95f
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .ppt-file{
                color:#f4b400
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .video-file{
                color:#935dc1
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .zip-file{
                color:#252930
            }
            .app-card-doc .app-doc-title{
                font-size:.875rem
            }
            .app-card-doc .app-doc-title a{
                color:#252930
            }
            .app-card-doc .app-doc-title.truncate{
                max-width:calc(100% - 30px);
                display:inline-block;
                overflow:hidden;
                text-overflow:ellipsis;
                white-space:nowrap
            }
            .app-card-doc .app-doc-meta{
                font-size:.75rem
            }

            .whatsapp-chat {
                bottom: 10%;
                right: 10px;
                position: fixed;
            }

            .views {
                cursor: pointer;
                display: inline-block;
                color: #9c9c9e;
            }
        </style>
@endpush
    <!-- start page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
			<div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Property Listing</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
				<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
				    <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Houses</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Lands</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Vehicles</a>
				</nav>
				
				
				<div class="tab-content" id="orders-table-tab-content">
					<div class="table-rep-plugin view-section tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
						<div class="table-responsive">
							<table id="datatable-buttons" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th data-priority="1"></th>
										<th data-priority="1"> Name</th>
										<th data-priority="1"> Price</th>
										<th data-priority="1"> Type</th>
										<th data-priority="1"> Location</th>
										<th data-priority="1" class="text-end"> Status</th>
										<th data-priority="1" class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($favorites as $favorite)
									<tr>
										<td data-priority="1">{{ $favorite->id }}</td>
										<td data-priority="1">{{$favorite->property->name}}</td>
										<td data-priority="1">XAF{{ $favorite->property->amount }}</td>
										<td data-priority="1">{{ $favorite->property->type }}</td>
										<td data-priority="1"> {{$favorite->property->city}}</td>
										<td data-priority="1" class="text-end">
											<form method="POST" action="{{route('activate-property')}}"
												class="active-deactive-form">
												@csrf
												<input name="property_id" value="{{$favorite->property->id}}" hidden/>
												<input name="current_status" value="{{$favorite->property->status}}" hidden/>
												<div class="form-check form-switch">
													@if($favorite->property->status)
														<input name="de_activate" class="btn btn-sm
														btn-outline-danger" type="submit"
															value="De-Active">
													@else
														<input name="activate" class="btn btn-sm
														btn-outline-success" type="submit"
															value=" Activate ">
													@endif

												</div>
											</form>
										</td>
										<td data-priority="1" class="text-end">
											<form action="" method="Post">
												<a class="btn btn-success" href=""> <i class='bx bxs-show'></i></a>
													@if($favorite->property->user_id == $userId)
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-danger"> <i class='bx bxs-trash'></i></button>
												@endif
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<div class="table-rep-plugin view-section tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
						<div class="table-responsive">
							<table id="datatable-buttons-house" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th data-priority="1"> Name</th>
										<th data-priority="1"> Price</th>
										<th data-priority="1"> Type</th>
										<th data-priority="1"> Location</th>
										<th data-priority="1" class="text-end"> Status</th>
										<th data-priority="1" class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($favorites as $favorite)
								     	@if($favorite->property->type == 'House')
										 <tr>
										<td data-priority="1">{{$favorite->property->name}}</td>
										<td data-priority="1">XAF{{ $favorite->property->amount }}</td>
										<td data-priority="1">{{ $favorite->house->type }}</td>
										<td data-priority="1"> {{$favorite->property->city}}</td>
										<td data-priority="1" class="text-end">
											<form method="POST" action="{{route('activate-property')}}"
												class="active-deactive-form">
												@csrf
												<input name="property_id" value="{{$favorite->property->id}}" hidden/>
												<input name="current_status" value="{{$favorite->property->status}}" hidden/>
												<div class="form-check form-switch">
													@if($favorite->property->status)
														<input name="de_activate" class="btn btn-sm
														btn-outline-danger" type="submit"
															value="De-Active">
													@else
														<input name="activate" class="btn btn-sm
														btn-outline-success" type="submit"
															value=" Activate ">
													@endif

												</div>
											</form>
										</td>
										<td data-priority="1" class="text-end">
											<form action="" method="Post">
												<a class="btn btn-success" href=""> <i class='bx bxs-show'></i></a>
													@if($favorite->property->user_id == $userId)
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-danger"> <i class='bx bxs-trash'></i></button>
												@endif
											</form>
										</td>
									</tr>
                                        @endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<div class="table-rep-plugin view-section tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
						<div class="table-responsive">
							<table id="datatable-buttons-land" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th data-priority="1"> Name</th>
										<th data-priority="1"> Size</th>
										<th data-priority="1"> Price</th>
										<th data-priority="1"> Location</th>
										<th data-priority="1" class="text-end"> Status</th>
										<th data-priority="1" class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($favorites as $favorite)
								     	@if($favorite->property->type == 'Land')
										 <tr>
										<td data-priority="1">{{$favorite->property->name}}</td>
										<td data-priority="1">{{ $favorite->land->size }}</td>
										<td data-priority="1">XAF{{ $favorite->property->amount }}</td>
										<td data-priority="1"> {{$favorite->property->city}}</td>
										<td data-priority="1" class="text-end">
											<form method="POST" action="{{route('activate-property')}}"
												class="active-deactive-form">
												@csrf
												<input name="property_id" value="{{$favorite->property->id}}" hidden/>
												<input name="current_status" value="{{$favorite->property->status}}" hidden/>
												<div class="form-check form-switch">
													@if($favorite->property->status)
														<input name="de_activate" class="btn btn-sm
														btn-outline-danger" type="submit"
															value="De-Active">
													@else
														<input name="activate" class="btn btn-sm
														btn-outline-success" type="submit"
															value=" Activate ">
													@endif

												</div>
											</form>
										</td>
										<td data-priority="1" class="text-end">
											<form action="" method="Post">
												<a class="btn btn-success" href=""> <i class='bx bxs-show'></i></a>
													@if($favorite->property->user_id == $userId)
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-danger"> <i class='bx bxs-trash'></i></button>
												@endif
											</form>
										</td>
									</tr>
                                        @endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<div class="table-rep-plugin view-section tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
						<div class="table-responsive">
							<table id="datatable-buttons-vehicle" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th data-priority="1"> Name</th>
										<th data-priority="1"> Price</th>
										<th data-priority="1"> Type</th>
										<th data-priority="1"> Location</th>
										<th data-priority="1" class="text-end"> Status</th>
										<th data-priority="1" class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($favorites as $favorite)
								     	@if($favorite->property->type == 'Vehicle')
										 <tr>
										<td data-priority="1">{{$favorite->property->name}}</td>
										<td data-priority="1">XAF{{ $favorite->property->amount }}</td>
										<td data-priority="1">{{ $favorite->vehicle->type }}</td>
										<td data-priority="1"> {{$favorite->property->city}}</td>
										<td data-priority="1" class="text-end">
											<form method="POST" action="{{route('activate-property')}}"
												class="active-deactive-form">
												@csrf
												<input name="property_id" value="{{$favorite->property->id}}" hidden/>
												<input name="current_status" value="{{$favorite->property->status}}" hidden/>
												<div class="form-check form-switch">
													@if($favorite->property->status)
														<input name="de_activate" class="btn btn-sm
														btn-outline-danger" type="submit"
															value="De-Active">
													@else
														<input name="activate" class="btn btn-sm
														btn-outline-success" type="submit"
															value=" Activate ">
													@endif

												</div>
											</form>
										</td>
										<td data-priority="1" class="text-end">
											<form action="" method="Post">
												<a class="btn btn-success" href=""> <i class='bx bxs-show'></i></a>
													@if($favorite->property->user_id == $userId)
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-danger"> <i class='bx bxs-trash'></i></button>
												@endif
											</form>
										</td>
									</tr>
                                        @endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div><!--//tab-content-->
                </div>
    
            </div>
        </div> <!-- end col -->
    </div>

    <ul class="whatsapp-chat">
        <li class="views view-active" data-target="#table">
        <i data-feather="align-justify"></i>
        </li>
        <li class="views" data-target="#cards">
        <i data-feather="square"></i>
        </li>
    </ul>

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

		<script>
		$(document).ready(function() {
			$('#datatable-buttons-house').DataTable({
				
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});

			$('#datatable-buttons-land').DataTable({
				
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});

			$('#datatable-buttons-vehicle').DataTable({
				
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
		});
		</script>

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