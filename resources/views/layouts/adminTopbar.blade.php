   <!-- Top Bar Start -->
    <div class="topbar">
        <nav class="navbar-custom">
            <div class="dropdown notification-list nav-pro-img">
                <div class="list-inline-item hide-phone app-search">
                    {{-- <form role="search" class="">
                        <div class="form-group pt-1">
                            <input type="text" class="form-control" placeholder="Search.." />
                            <a href="">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </form> --}}
                </div>
            </div>

            <ul class="list-inline float-right mb-0 mr-3">
                <!-- language-->
                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti-email noti-icon"></i>
                        <span class="badge badge-danger heartbit noti-icon-badge">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title align-self-center">
                            <h5>
                                <span class="badge badge-danger float-right">745</span>Messages
                            </h5>
                        </div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                <img src="assets/images/users/avatar-2.jpg" alt="user-img"
                                    class="img-fluid rounded-circle" />
                            </div>
                            <p class="notify-details">
                                <b>Charles M. Jones</b>
                                <small class="text-muted">Dummy text of the printing and typesetting
                                    industry.</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                <img src="assets/images/users/avatar-3.jpg" alt="user-img"
                                    class="img-fluid rounded-circle" />
                            </div>
                            <p class="notify-details">
                                <b>Thomas J. Mimms</b>
                                <small class="text-muted">You have 87 unread messages</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                <img src="assets/images/users/avatar-4.jpg" alt="user-img"
                                    class="img-fluid rounded-circle" />
                            </div>
                            <p class="notify-details">
                                <b>Luis M. Konrad</b>
                                <small class="text-muted">It is a long established fact that a reader
                                    will</small>
                            </p>
                        </a>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            View All
                        </a>
                    </div>
                </li>

                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti-bell noti-icon"></i>
                        <span class="badge badge-success a-animate-blink noti-icon-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5>
                                <span class="badge badge-danger float-right">87</span>Notification
                            </h5>
                        </div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary">
                                <i class="mdi mdi-cart-outline"></i>
                            </div>
                            <p class="notify-details">
                                <b>Your order is placed</b>
                                <small class="text-muted">Dummy text of the printing and typesetting
                                    industry.</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-success">
                                <i class="mdi mdi-message"></i>
                            </div>
                            <p class="notify-details">
                                <b>New Message received</b>
                                <small class="text-muted">You have 87 unread messages</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning">
                                <i class="mdi mdi-martini"></i>
                            </div>
                            <p class="notify-details">
                                <b>Your item is shipped</b>
                                <small class="text-muted">It is a long established fact that a reader
                                    will</small>
                            </p>
                        </a>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            View All
                        </a>
                    </div>
                </li>

                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src={{url("assets/images/users/avatar-1.jpg")}} alt="user" class="rounded-circle img-thumbnail" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5>Welcome</h5>
                        </div>
                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-account-circle m-r-5 text-muted"></i>
                            Profile</a>
                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-wallet m-r-5 text-muted"></i> My
                            Wallet</a>
                        <a class="dropdown-item d-block" href="#">
                            <span class="badge badge-success float-right">5</span>
                            <i class="mdi mdi-settings m-r-5 text-muted"></i>
                            Settings</a>
                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i>
                            Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a href={{url('/logout')}} class="dropdown-item">
                            <i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                    </div>
                </li>
            </ul>

            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left waves-light waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
            </ul>

            <div class="clearfix"></div>
        </nav>
    </div>
    <!-- Top Bar End -->