@extends('frontend.dashboard.dashboard')
@section('dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">


<section class="section pt-4 pb-4 osahan-account-page">
    <div class="container">
        <div class="row">

            @include('frontend.dashboard.sidebar')


            <div class="col-md-9">
                <div class="osahan-account-page-right rounded shadow-sm bg-white p-4 h-100">

                    <div class="tab-pane">
                        <h4 class="font-weight-bold mt-0 mb-4">Favourites</h4>
                        <div class="row">

                            @foreach ($wishlist as $wish)
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div
                                        class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <a href="{{ route('res.details',$wish->client_id) }}">
                                                <img
                                                    src="{{ asset('upload/client_images/' . $wish['client']['photo']) }}"
                                                    class="img-fluid item-img" style="width: 300px; height:200px;"
                                                    alt="no photo">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="{{ route('res.details',$wish->client_id) }}"
                                                                    class="text-black">{{$wish['client']['name']}}
                                                        <p class="text-gray mb-3">Vegetarian • Indian • Pure veg</p>
                                                        <p class="text-gray mb-3 time"><span
                                                                class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                                    class="icofont-wall-clock"></i> 15–30 min</span>
                                                            <span
                                                                class="float-right text-black-50"> $350 FOR TWO</span>
                                                        </p>
                                                    </a>
                                                </h6>
                                                <div style="float:right; margin-bottom:5px">
                                                    <a href="{{ route('remove.wishlist',$wish->id) }}"
                                                       class="badge badge-danger">
                                                        <i class="icofont-ui-delete"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


@endsection
