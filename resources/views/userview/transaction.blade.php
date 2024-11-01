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
                        <div class="bg-secondary mb-3" style="padding: 30px; height: 550px;">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="font-weight-bold mb-3">Ruangan transaksi</h4>
                                </div>
                                <div class="col-6">
                                    <div class="row g-0">
                                        <div class="col-10 input-group ">
                                            <input type="text" class="form-control border-0 p-2 ml-4"
                                                placeholder="id ruangan">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-primary border-primary text-white"><i
                                                        class="fa fa-search"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalTambahRuangan"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blog Grid End -->

            <!-- Modal tambah ruangan -->
            <div class="modal fade" id="modalTambahRuangan" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Buat Ruangan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action={{ url('/transaction/add') }} method="POST">
                                <div class="control-group">
                                    <input type="text" class="form-control border-0 p-4" id="name"
                                        placeholder="Nama ruangan" required="required"
                                        data-validation-required-message="Harap masukkan nama ruangan" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <input type="text" class="form-control border-0 p-4" id="role"
                                        placeholder="Peran (Penjual / Pembeli)" required="required"
                                        data-validation-required-message="Harap tambahkan peran anda" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <input type="text" class="form-control border-0 p-4" id="admin"
                                        placeholder="Pilih Admin" required="required"
                                        data-validation-required-message="Harap tambahkan admin ke dalam ruangan" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary">Buat ruangan</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal tambah ruangan -->


            <!-- Sidebar Start -->
            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="bg-secondary" style="padding: 30px; height: 550px;">
                        <div class="row">
                            <div class="col-4">
                                <h4 class="font-weight-bold mb-3">Pengguna</h4>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                    <input type="text" id="search-input" class="form-control border-0 p-2 ml-4"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-primary border-primary text-white"><i
                                                class="fa fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table w-100 text-left">
                            <tbody id="user-table-body" style="display: block; max-height: 450px; overflow-y: auto;">
                                <!-- Hasil pencarian akan ditampilkan di sini -->
                                @foreach ($member as $m)
                                    <tr>
                                        <td>{{ $m->username }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Search Form End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->

    <script>
        document.getElementById('search-input').addEventListener('input', function() {
            const query = this.value;

            fetch(`/search-users?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('user-table-body');
                    tableBody.innerHTML = ''; // Bersihkan hasil sebelumnya

                    // Perulangan hasil pencarian dan tampilkan di tabel
                    data.forEach(user => {
                        const row = `<tr><td>${user.username}</td><td></td></tr>`;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
