@extends('layouts.adminMain')

@section('content')
    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <a href={{ url('/admin/add  ') }} class="btn btn-primary border-0">Tambah data</a>
                        </div>
                        <h4 class="page-title">Data Admin</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Berhasil!</strong> {{ session('success') }}
                                </div>
                            @endif
                            <table id="datatable-buttons" class="table table-striped table-bordered w-100 text-center">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Tanggal lahir</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->birth_date }}</td>
                                            <td>{{ $user->profile_pic }}</td>
                                            <td class="row d-flex justify-content-center align-item-center">
                                                <form action={{ url('/admin/edit/' . $user->id) }} method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-light bg-warning border-0 d-flex justify-content-center align-items-center"
                                                        style="width: 40px; height: 40px; margin-right: 10px;">
                                                        <i class="mdi mdi-border-color" style="font-size: 1.5em;"></i>
                                                    </button>
                                                </form>

                                                <button data-toggle="modal"
                                                    data-target="#modalHapusAdmin{{ $user->id }}"
                                                    class="btn btn-light bg-danger border-0 d-flex justify-content-center align-items-center"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="mdi mdi-delete" style="font-size: 1.5em;"></i>
                                                </button>
                                            </td>

                                        </tr>

                                        <div class="modal fade" id="modalHapusAdmin{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-500" id="exampleModalLongTitle">Konfirmasi
                                                            hapus data admin</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin untuk menghapus data <span
                                                                class="text-warning fw-500"> {{ $user->name }}</span> ??
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action={{ url('/admin/delete/' . $user->id) }}
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-raised btn-danger">Hapus</button>
                                                        </form>
                                                        <button type="button" class="btn btn-raised btn-secondary ml-2"
                                                            data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
