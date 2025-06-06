@extends('admin.dashboard')
@section('admin_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Roles</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('all.roles') }}" class="btn btn-primary waves-effect waves-light">Back</a>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="card-body p-4">

                            <form id="myForm" action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="form-group mb-3">
                                                <label for="example-text-input" class="form-label">Roles Name</label>
                                                <input class="form-control" type="text" name="name"  id="example-text-input">
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>










                    <!-- end tab content -->
                </div>
                <!-- end col -->


                <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: 'Please Enter Name',
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
