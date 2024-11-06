<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href={{ url('img/middleman3.png') }} rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pb-4 pb-lg-0">
                    <div class="img-container mt-5">
                        <img src="{{ url('/img/middleman3.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 mt-5">
                    <h1 class="text-primary text-uppercase font-weight-bold">Register</h1>
                    <div class="contact-form bg-secondary d-flex flex-column" style="padding: 30px; height: 80%;">
                        <form action={{ url('/register/save') }} method="POST" class="flex-grow-1">
                            @csrf
                            <div class="control-group">
                                <input type="text" class="form-control border-0 p-4" id="name"
                                    placeholder="Username" value="{{ old('username') }}" required="required"
                                    name="username" data-validation-required-message="Harap masukkan username anda" />
                                <p class="help-block text-danger">
                                    @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </p>
                            </div>
                            <div class="control-group position-relative">
                                <input type="password" class="form-control border-0 p-4" id="password"
                                    placeholder="Password" value="{{ old('password') }}" required="required"
                                    name="password" data-validation-required-message="Harap masukkan password anda" />
                                <span id="toggle-password" class="position-absolute"
                                    style="right: 15px; top: 15px; cursor: pointer;">
                                    <i class="fa fa-eye"></i>
                                </span>
                                <p class="help-block text-danger">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control border-0 p-4" id="name"
                                    placeholder="Nama" value="{{ old('name') }}" required="required" name="name"
                                    data-validation-required-message="Harap masukkan nama anda" />
                                <p class="help-block text-danger">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control border-0 p-4" id="name"
                                    placeholder="No HP" value="{{ old('phone') }}" required="required" name="phone"
                                    data-validation-required-message="Harap masukkan No HP anda" />
                                <p class="help-block text-danger">
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </p>
                            </div>
                            <div>
                                <button type="submit"
                                    class="btn btn-primary py-3 px-4 w-100 fw-400 mt-4">Register</button>
                            </div>
                        </form>
                        <div class="mt-5 mb-5 text-center">
                            <p class="text-dark">Sudah memiliki akun? <a href="{{ url('/login') }}"
                                    class="">Login!</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
