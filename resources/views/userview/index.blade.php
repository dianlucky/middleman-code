@extends('layouts.userMain')

@section('content')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-primary mb-4">MiddleMan</h1>
            <h1 class="text-white display-3 mb-5">Penengah Transaksi Anda</h1>
            <div class="mx-auto" style="width: 100%; max-width: 600px;">
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 pb-4 pb-lg-0">
                    <img class="img-fluid w-100" src="img/about.png" alt="">
                    <div class="bg-light text-dark text-center p-4">
                        <h3 class="m-0"> </h3>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h6 class="text-primary text-uppercase font-weight-bold">About Us</h6>
                    <h1 class="mb-4">When Trust Meets Trade</h1>
                    <p class="mb-4">a reliable and secure platform for online transactions. With MiddleMan, buyers and
                        sellers can trade confidently, knowing that their dealings are protected every step of the way. By
                        acting as a trusted intermediary, MiddleMan ensures that both parties fulfill their commitments
                        before completing the transaction. It's a seamless, worry-free experience designed to build trust in
                        every trade.</p>
                    <div class="d-flex align-items-center pt-2">
                        <button type="button" class="btn-play" data-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">
                            <span></span>
                        </button>
                        <h5 class="font-weight-bold m-0 ml-4">Play Video</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

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


    <!-- Team Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Admin Team</h6>
                <h1 class="mb-4">Meet Our MiddleMan</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team card position-relative overflow-hidden border-0 mb-5">
                        <img class="card-img-top" src="img/team-1.jpg" alt="">
                        <div class="card-body text-center p-0">
                            <div class="team-text d-flex flex-column justify-content-center bg-secondary">
                                <h5 class="font-weight-bold">Full Name</h5>
                                <span>Designation</span>
                            </div>
                            <div class="team-social d-flex align-items-center justify-content-center bg-primary">
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-dark btn-social" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team card position-relative overflow-hidden border-0 mb-5">
                        <img class="card-img-top" src="img/team-2.jpg" alt="">
                        <div class="card-body text-center p-0">
                            <div class="team-text d-flex flex-column justify-content-center bg-secondary">
                                <h5 class="font-weight-bold">Full Name</h5>
                                <span>Designation</span>
                            </div>
                            <div class="team-social d-flex align-items-center justify-content-center bg-primary">
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-dark btn-social" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team card position-relative overflow-hidden border-0 mb-5">
                        <img class="card-img-top" src="img/team-3.jpg" alt="">
                        <div class="card-body text-center p-0">
                            <div class="team-text d-flex flex-column justify-content-center bg-secondary">
                                <h5 class="font-weight-bold">Full Name</h5>
                                <span>Designation</span>
                            </div>
                            <div class="team-social d-flex align-items-center justify-content-center bg-primary">
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-dark btn-social" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team card position-relative overflow-hidden border-0 mb-5">
                        <img class="card-img-top" src="img/team-4.jpg" alt="">
                        <div class="card-body text-center p-0">
                            <div class="team-text d-flex flex-column justify-content-center bg-secondary">
                                <h5 class="font-weight-bold">Full Name</h5>
                                <span>Designation</span>
                            </div>
                            <div class="team-social d-flex align-items-center justify-content-center bg-primary">
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-dark btn-social mr-2" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-dark btn-social" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Testimonial</h6>
                <h1 class="mb-4">Our Clients Say</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-1.jpg"
                            style="width: 60px; height: 60px;" alt="">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Client Name</h6>
                            <small>- Profession</small>
                        </div>
                    </div>
                    <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor
                        ipsum sanct clita</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-2.jpg"
                            style="width: 60px; height: 60px;" alt="">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Client Name</h6>
                            <small>- Profession</small>
                        </div>
                    </div>
                    <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor
                        ipsum sanct clita</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-3.jpg"
                            style="width: 60px; height: 60px;" alt="">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Client Name</h6>
                            <small>- Profession</small>
                        </div>
                    </div>
                    <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor
                        ipsum sanct clita</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-4.jpg"
                            style="width: 60px; height: 60px;" alt="">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Client Name</h6>
                            <small>- Profession</small>
                        </div>
                    </div>
                    <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor
                        ipsum sanct clita</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

@endsection
