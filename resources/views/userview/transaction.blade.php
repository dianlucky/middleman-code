@extends('layouts.userMain')

@section('content')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Transaction</h1>
            <h3 class="text-primary mb-4">MiddleMan</h3>
        </div>
    </div>
    <!-- Header End -->

    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row">
            <!-- Blog Grid Start -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="bg-secondary mb-3" style="padding: 30px; height: 450px;">
                          <div class="row">
                            <div class="col-8">
                                <h4 class="font-weight-bold mb-3">Transaction rooms</h4>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 p-2 ml-4" placeholder="room id">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-primary border-primary text-white"><i
                                                class="fa fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <p>Dolor sea ipsum ipsum et. Erat duo lorem magna vero dolor dolores. Rebum eirmod no dolor diam
                                dolor amet ipsum. Lorem lorem sea sed diam est lorem magna</p>
                            <a class="border-bottom border-primary text-uppercase text-decoration-none" href="">Read
                                More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-lg justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div> --}}
            </div>
            <!-- Blog Grid End -->

            <!-- Sidebar Start -->
            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="bg-secondary" style="padding: 30px; height: 550px;">
                        <div class="row">
                            <div class="col-3">
                                <h4 class="font-weight-bold mb-3">Users</h4>
                            </div>
                            <div class="col-9">
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 p-2 ml-4" placeholder="Search">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-primary border-primary text-white"><i
                                                class="fa fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Search Form End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->
@endsection
