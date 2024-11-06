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
                    <div class="col-md-12 mb-2">
                        <div class="bg-secondary" style="padding: 30px; height: 350px;">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="font-weight-bold mb-3">Ruangan transaksi</h4>
                                </div>
                                <div class="col-6">
                                    <div class="col-12 input-group ">
                                        <input type="text" class="form-control border-0 p-2 ml-4"
                                            placeholder="id ruangan">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-primary border-primary text-white"><i
                                                    class="fa fa-search"></i></span>
                                        </div>
                                        <div class="ml-1">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalTambahRuangan"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="bg-secondary mb-3" style="padding: 30px; height: 200px;">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="font-weight-bold mb-3">Ruangan saya</h4>
                                </div>
                            </div>

                            <!-- Carousel -->
                            <div id="roomCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($myRooms as $index => $room)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <a class="text-decoration-none" href="{{ url('/room/' . $room->id) }}">
                                                <div class="bg-primary px-3 pt-2 shadow-lg rounded-lg">
                                                    <h5 class="text-white text-center font-weight-bold text-truncate">
                                                        {{ $room->name }}</h5>
                                                    <p class="text-white text-right"><small>Room id:
                                                            <span>{{ $room->id }}</span></small></p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Navigasi Carousel -->
                                <a class="carousel-control-prev" href="#roomCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#roomCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
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
                        <form action={{ url('/transaction/create') }} method="POST" class="flex-grow-1">
                            @csrf
                            <input type="hidden" name="user_id1" value={{ auth()->user()->id }}>
                            <div class="modal-body bg-secondary">
                                <div class="control-group">
                                    <input type="text" class="form-control border-0 p-4" id="name"
                                        placeholder="Nama ruangan" required="required" name="name"
                                        data-validation-required-message="Harap masukkan nama ruangan" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <select name="role_user1" class="custom-select" required>
                                        <option selected>Pilih peran</option>
                                        <option value="penjual">Penjual</option>
                                        <option value="pembeli">Pembeli</option>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <select name="admin_id" class="custom-select" required>
                                        <option selected>Pilih admin</option>
                                        @foreach ($admin as $adm)
                                            <option value={{ $adm->id }}>{{ $adm->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Buat ruangan</button>
                            </div>
                        </form>
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
                            <div class="col-3">
                                <h4 class="font-weight-bold mb-3">Teman</h4>
                            </div>
                            <div class="col-9">
                                <div class="input-group">
                                    <input type="text" id="search-input" class="form-control border-0 p-2 ml-4"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-primary border-primary text-white"><i
                                                class="fa fa-search"></i></span>
                                        <button class="btn btn-primary ml-1"><i class="fa fa-bell"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table w-100 text-left">
                            <tbody id="user-table-body" style="display: block; max-height: 450px; overflow-y: auto;">
                                <!-- Hasil pencarian akan ditampilkan di sini -->

                                @foreach ($friendlist as $m)
                                    @if ($friendlist->isNotEmpty())
                                        <tr>
                                            <td>{{ $m->username }}</td>
                                            <td></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>Kosong</td>
                                            <td></td>
                                        </tr>
                                    @endif
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
                        const row = `<tr><td>${user.username}</td><td> blah blah</td></tr>`;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
