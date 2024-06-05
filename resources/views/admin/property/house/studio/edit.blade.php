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
                    <h4 class="card-title">Edit Room</h4>
                </div>
                <div class="card-body p-4">
                    <form class="hidden" action="{{ route('studio.update', $studio->id) }}"  method="post" enctype="multipart/form-data" id="studio-form">
                       @csrf
                       @method('PUT')
                       <div class="row">
                            <input name="propertyid" value="{{$studio->property->id}}" hidden>
                            <input name="houseid" value="{{$studio->house->id}}" hidden>
                            <input name="roomid" value="{{$studio->id}}" hidden>
                            <input type="text" name="type" value="{{$studio->property->type}}" class="form-control" hidden>
                            <input type="text" name="house-type" value="{{$studio->house->type}}" class="form-control" hidden>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$studio->property->name}}">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Studio Type</label>
                                    <select class="form-select" aria-label="Default select example" name="studio-type">
                                        <option selected>{{$studio->type}}</option>
                                        <option>Simple</option>
                                        <option>Modern</option>
                                        <option>Ultra-modern</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Region</label>
                                    <select class="form-control form-select" id="inputVendor" name="region_id">
                                    @if($studio->property->region_id == 1)
                                    <option slected value="{{$studio->property->region_id}}">Adamawa</option>
                                    @elseif($studio->property->region_id == 2)
                                    <option slected value="{{$studio->property->region_id}}">Centre</option>
                                    @elseif($studio->property->region_id == 3)
                                    <option slected value="{{$studio->property->region_id}}">East</option>
                                    @elseif($studio->property->region_id == 4)
                                    <option slected value="{{$studio->property->region_id}}">Far North</option>
                                    @elseif($studio->property->region_id == 5)
                                    <option slected value="{{$studio->property->region_id}}">Littoral</option>
                                    @elseif($studio->property->region_id == 6)
                                    <option slected value="{{$studio->property->region_id}}">North</option>
                                    @elseif($studio->property->region_id == 7)
                                    <option slected value="{{$studio->property->region_id}}">North West</option>
                                    @elseif($studio->property->region_id == 8)
                                    <option slected value="{{$studio->property->region_id}}">South</option>
                                    @elseif($studio->property->region_id == 9)
                                    <option slected value="{{$studio->property->region_id}}">South West</option>
                                    @elseif($studio->property->region_id == 10)
                                    <option slected value="{{$studio->property->region_id}}">West</option>
                                    @endif

                                        @foreach($regions as $item)
                                            <option value="{{$item->id}}">{{$item->designation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">City</label>
                                    <input type="text" name="city" class="form-control" value="{{$studio->property->city}}">
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Quater</label>
                                    <input type="text" name="quater" class="form-control" value="{{$studio->property->quater}}">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group mb-3">
                                <label class="form-label" for="formrow-firstname-input">Description</label>
                                    <textarea class="form-control" name="description" id="ckeditor-classic">{{$studio->property->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Bathroom</label>
                                    <select class="form-select" aria-label="Default select example" name="bathroom">
                                        <option selected>{{$studio->bathroom}}</option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Kitchen</label>
                                    <select class="form-select" aria-label="Default select example" name="kitchen">
                                        <option selected>{{$studio->kitchen}}</option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Balcony</label>
                                    <select class="form-select" aria-label="Default select example" name="balcony">
                                        <option selected>{{$studio->balcony}}</option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Price</label>
                                    <input type="text" name="price" class="form-control" value="{{$studio->property->amount}}">
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Date <strong class="is-small">(e.g: dd mm, xxxx)</strong></label>
                                    <input type="text" name="date" class="form-control" value="{{$studio->property->date}}">
                                </div>
                            </div>
                            {{-- Image Upload Section --}}
                            <div class="col-xl-12 mb-3">
                                <div class="forn-group control">
                                    <label for="img">Images <strong class="is-small">(Tip: Upload more the one photograph [Max Image Size: 4MB])</strong></label>
                                    <div class="content">
                                        <div class="row">
                                                @foreach (json_decode($studio->property->image) as $image)
                                                <div class="col-md-3 mb-3"><img src="/uploads/images/property/house/studio/{{$image}}" class="img-fluid" /></div>
                                                @endforeach
                                        </div>
                                    </div>
                                    <div class="input-group control-group increment">
                                        <input type="file" name="filename[]" class="form-control" multiple>
                                        <div class="input-group-append input-group-btn">
                                            <button class="btn btn-success is-success addmore" type="button"><i class="glyphicon glyphicon-plus"></i>More</button>
                                        </div>
                                    </div>

                                    <div class="clone hide">
                                        <div class="control-group input-group" style="margin-top:10px">
                                            <input type="file" name="filename[]" class="form-control">
                                            <div class="input-group-append input-group-btn">
                                                <button class="btn btn-danger is-danger" type="button"><i
                                                        class="glyphicon glyphicon-remove"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('filename'))
                                <span>
                                    <strong class="has-text-danger">{{ $errors->first('filename') }}</strong>
                                </span> @endif
                            </div>
                            <div class="col-xl-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="fence" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Fence</label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="parking" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Parking</label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="pool" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Pool</label>
                                </div>
                            </div>
                            <div class="col-xl-12">
                               <div class="form-group mb-3">
                                    <input type="radio" class="btn-check" name="action" id="studio-success-outlined" value="buy" autocomplete="off">
                                    <label class="btn btn-outline-success" for="studio-success-outlined">sell</label>

                                    <input type="radio" class="btn-check" name="action" id="studio-danger-outlined" value="rent" autocomplete="off">
                                    <label class="btn btn-outline-warning" for="studio-danger-outlined">Rent</label>
                                </div>
                            </div>
                       </div>
                       <div class="mt-4">
                              <button  type="submit"  id="btnSubmit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
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

        <script type="text/javascript">
            $(document).ready(function() {
        
            $(".addmore").click(function(){ 
                console.log('works')
                var html = $(".clone").html();
                $(".increment").after(html);
            });
        
            $("body").on("click",".is-danger",function(){ 
                $(this).parents(".control-group").remove();
            });
        
            });
        </script>

    
    @endpush
@endsection