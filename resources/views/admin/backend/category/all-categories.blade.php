@extends('admin.dashboard')
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">All Categories</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{route('add.category')}}" class="btn btn-primary waves-effect waves-light">Add Category</a>
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
                                    <th>Category Name</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($categories as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->category_name}}</td>
                                        <td><img src="{{asset($item->image)}}" alt="no photo"
                                                 style="width: 70px;height: 40px;"></td>
                                        <td>
                                            <a href="{{route('edit.category',$item->id)}}" class="btn btn-info waves-effect waves-light">Edit</a>
                                            <a href="{{route('delete.category',$item->id)}}" id="delete" class="btn btn-danger waves-effect waves-light">Delete</a>
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
@endsection
