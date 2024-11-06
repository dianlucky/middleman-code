 <!-- Navbar Start -->
 <div class="container-fluid p-0">
     <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
         <a href="/" class="navbar-brand ml-lg-3">
             <h1 class="m-0 display-5 text-uppercase text-primary"><img src="/img/middleman3.png"
                     style="height: 50px; margin-bottom: 10px;"></img>MiddleMan</h1>
         </a>
         <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="navbar-nav m-auto py-0">
             <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
             <a href="/about" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
             <a href="/price" class="nav-item nav-link {{ request()->is('price') ? 'active' : '' }}">Price</a>
             <a href="/testimonial"
                 class="nav-item nav-link {{ request()->is('testimonial') ? 'active' : '' }}">Testimonial</a>
             <a href="/contact" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
             @can('is-login')
                 <a href="/transaction"
                     class="nav-item nav-link {{ request()->is('transaction') ? 'active' : '' }}">Transaction</a>
             @endcan
         </div>
         @can('is-login')
             <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{auth()->user()->username}}</a>
                 <div class="dropdown-menu rounded-0 m-0">
                     <a href="blog.html" class="dropdown-item">Profile</a>
                     <a href={{url('/logout')}} class="dropdown-item bg-danger text-light" style="height: 45px; margin-top: 10px;">Logout</a>
                 </div>
             </div>
         @endcan
         @can('free-user')
             <a href="/login" class="btn btn-primary py-2 px-4 d-none d-lg-block">Login</a>
         @endcan

     </nav>
 </div>
 <!-- Navbar End -->
