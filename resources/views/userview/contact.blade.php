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

    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 pb-4 pb-lg-0">
                    <div class="bg-primary text-dark text-center p-4">
                        <h4 class="m-0"><i class="fa fa-map-marker-alt text-white mr-2"></i>Pelaihari, Tanah Laut, Kalsel</h4>
                    </div>
                    <iframe style="width: 100%; height: 470px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d637500.5741360826!2d114.75973867618772!3d-3.801209949975997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de6743c42b23f45%3A0xe577e653da548fd5!2sPelaihari%2C%20Tanah%20Laut%20Regency%2C%20South%20Kalimantan!5e0!3m2!1sen!2sid!4v1696864099478!5m2!1sen!2sid"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>


                </div>
                <div class="col-lg-7">
                    <h6 class="text-primary text-uppercase font-weight-bold">Contact Us</h6>
                    <h1 class="mb-4">Contact For Any Queries</h1>
                    <div class="contact-form bg-secondary" style="padding: 30px;">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate">
                            <div class="control-group">
                                <input type="text" class="form-control border-0 p-4" id="name"
                                    placeholder="Your Name" required="required"
                                    data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control border-0 p-4" id="email"
                                    placeholder="Your Email" required="required"
                                    data-validation-required-message="Please enter your email" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control border-0 p-4" id="subject" placeholder="Subject"
                                    required="required" data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control border-0 py-3 px-4" rows="3" id="message" placeholder="Message"
                                    required="required" data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">Send
                                    Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
