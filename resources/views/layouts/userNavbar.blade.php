 <!-- Navbar Start -->
 <div class="container-fluid p-0">
     <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
         <a href="/" class="navbar-brand ml-lg-3">
             <h1 class="m-0 display-5 text-uppercase text-primary"><img src="/img/middleman3.png" style="height: 50px; margin-bottom: 10px;"></img>MiddleMan</h1>
         </a>
         <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
             <div class="navbar-nav m-auto py-0">
                 <a href="/"
                     class="nav-item nav-link <?= $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>">Home</a>
                 <a href="/about"
                     class="nav-item nav-link <?= $_SERVER['REQUEST_URI'] == '/about' ? 'active' : '' ?>">About</a>
                 <a href="/price"
                     class="nav-item nav-link <?= $_SERVER['REQUEST_URI'] == '/price' ? 'active' : '' ?>">Price</a>
                 <a href="/testimonial"
                     class="nav-item nav-link <?= $_SERVER['REQUEST_URI'] == '/testimonial' ? 'active' : '' ?>">Testimonial</a>
                 <a href="/contact"
                     class="nav-item nav-link <?= $_SERVER['REQUEST_URI'] == '/contact' ? 'active' : '' ?>">Contact</a>
                 <a href="/transaction"
                     class="nav-item nav-link <?= $_SERVER['REQUEST_URI'] == '/transaction' ? 'active' : '' ?>">Transaction</a>
             </div>
             <a href="/login" class="btn btn-primary py-2 px-4 d-none d-lg-block">Login</a>
         </div>
     </nav>
 </div>
 <!-- Navbar End -->
