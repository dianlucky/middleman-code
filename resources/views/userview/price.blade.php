@extends('layouts.userMain')

@section('content')

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Pricing List</h1>
            <h3 class="text-primary mb-4">MiddleMan</h3>
        </div>
    </div>
    <!-- Header End -->
    

      <!-- Pricing Plan Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Pricing Plan</h6>
                <h1 class="mb-4">Affordable Transaction Fee</h1>
            </div>
            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="bg-secondary">
                        <div class="text-center p-4">
                            <h1 class="display-4 mb-0">
                                <small class="align-top text-muted font-weight-medium"
                                    style="font-size: 22px; line-height: 45px;">RP</small>5.000<small
                                    class="align-bottom text-muted font-weight-medium"
                                    style="font-size: 16px; line-height: 40px;"></small>
                            </h1>
                        </div>
                        <div class="bg-primary text-center p-4">
                            <h3 class="text-light m-0">Basic</h3>
                        </div>
                        <div class="d-flex flex-column align-items-center py-4">
                            <p>Security</p>
                            <p>Fast</p>
                            <p>All item</p>
                            <p>Transaction <100.000 </p>
                            <a href="" class="btn btn-primary py-2 px-4 my-2">Order Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="bg-secondary">
                        <div class="text-center p-4">
                            <h1 class="display-4 mb-0">
                                <small class="align-top text-muted font-weight-medium"
                                    style="font-size: 22px; line-height: 45px;">RP</small>10.000<small
                                    class="align-bottom text-muted font-weight-medium"
                                    style="font-size: 16px; line-height: 40px;"></small>
                            </h1>
                        </div>
                        <div class="bg-primary text-center p-4">
                            <h3 class="text-light m-0">Premium</h3>
                        </div>
                        <div class="d-flex flex-column align-items-center py-4">
                            <p>Security ++</p>
                            <p>Fast ++</p>
                            <p>All item</p>
                            <p>Transaction <300.000 </p>
                            <a href="" class="btn btn-primary py-2 px-4 my-2">Order Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="bg-secondary">
                        <div class="text-center p-4">
                            <h1 class="display-4 mb-0">
                                <small class="align-top text-muted font-weight-medium"
                                    style="font-size: 22px; line-height: 45px;">RP</small>15.000<small
                                    class="align-bottom text-muted font-weight-medium"
                                    style="font-size: 16px; line-height: 40px;"></small>
                            </h1>
                        </div>
                        <div class="bg-primary text-center p-4">
                            <h3 class="text-light m-0">VVIP</h3>
                        </div>
                        <div class="d-flex flex-column align-items-center py-4">
                            <p>Security +++</p>
                            <p>Priority</p>
                            <p>All item</p>
                            <p>Transaction >300.000</p>
                            <a href="" class="btn btn-primary py-2 px-4 my-2">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing Plan End -->


@endsection