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
                        <div class="card-body p-5">
                            <h4 class="mt-0 header-title">Isi data admin</h4>
                            <div class="general-label">
                                <form action="{{ url('/admin/save') }}" method="POST" class="row form-material">
                                    @csrf
                                    <div class="form-group col-6">
                                        <label for="username" class="bmd-label-floating">Username</label>
                                        <input type="text" class="form-control" name="username" required id="username"
                                            value="{{ old('username') }}">
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="password" class="bmd-label-floating">Password</label>
                                        <input type="password" name="password" class="form-control" required id="password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name" class="bmd-label-floating">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="phone" class="bmd-label-floating">No HP</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="birth_date" class="bmd-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="birth_date" id="birth_date"
                                            value="{{ old('birth_date') }}">
                                        @error('birth_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="address" class="bmd-label-floating">Alamat</label>
                                        <textarea class="form-control" name="address" id="address" required rows="2">{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-raised mb-0">Simpan</button>
                                        <a class="btn btn-raised btn-secondary mb-0" href="{{ url('/admin') }}">Batal</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection
