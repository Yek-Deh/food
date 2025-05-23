@extends('admin.dashboard')
@section('admin_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">All Cities</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target="#myModal">Add City
                                </button>
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

                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>City Name</th>
                                    <th>City Slug</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($cities as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->city_name}}</td>
                                        <td>{{$item->city_slug}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#myEdit" id="{{$item->id}}"
                                                    onclick="cityEdit(this.id)">Edit
                                            </button>
                                            <a href="{{route('delete.city',$item->id)}}" id="delete"
                                               class="btn btn-danger waves-effect waves-light">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
         aria-hidden="true" data-bs-scroll="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add Cityy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="myForm" action="{{route('city.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group mb-3">
                                        <label for="example-text-input" class="form-label">City Name</label>
                                        <input class="form-control" type="text" name="city_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                changes
                            </button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- Edit modal content -->
    <div id="myEdit" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
         aria-hidden="true" data-bs-scroll="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="myForm" action="{{route('update.city')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="city_id" id="city-id">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group mb-3">
                                        <label for="example-text-input" class="form-label">City Name</label>
                                        <input class="form-control" type="text" name="city_name" id="city-name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                changes
                            </button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript">
        function cityEdit(id) {
            $('#city-name').val('');
            $.ajax({
                type: 'GET',
                url: '/edit/city/' + id,
                dataType: 'json',
                success: function (data) {
                    // console.log(data)
                    $('#city-name').val(data.city_name);
                    $('#city-id').val(data.id);
                }
            })

        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
                rules: {
                    city_name: {
                        required: true,
                    },
                },
                messages: {
                    city_name: {
                        required: 'Please Enter City NAME',
                    },

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>
@endsection
