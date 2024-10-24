@extends('layouts.adminMain')

@section('content')
    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            {{-- <a href='/admin/add' class="btn btn-primary border-0">Tambah data</a> --}}
                        </div>
                        <h4 class="page-title">Tambah Admin</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">General Form</h4>
                            <p class="text-muted font-14">Form controls flavored by Material Design for Bootstrap
                                customizations such as <code>bmd-label-floating</code>.</p>
                            <div class="general-label">
                                <form class="mb-0">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bmd-label-floating ">Email address</label>
                                        <input type="email" class="form-control" required id="exampleInputEmail1">
                                     </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="bmd-label-floating">Password</label>
                                        <input type="password" class="form-control" required id="exampleInputPassword1">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleTextarea" class="bmd-label-floating">Example textarea</label>
                                        <textarea class="form-control" id="exampleTextarea" required rows="3"></textarea>
                                    </div>

                                    <div class="checkbox mb-2">
                                        <label>
                                            <input type="checkbox"> Check me out
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-raised mb-0">Submit</button>
                                    <button class="btn btn-raised btn-secondary mb-0">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection
