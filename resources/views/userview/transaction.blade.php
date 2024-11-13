@extends('layouts.userMain')

@section('content')
    {{-- <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Transaction</h1>
            <h3 class="text-primary mb-4">MiddleMan</h3>
        </div>
    </div>
    <!-- Header End --> --}}

    <!-- Blog Start -->
    <div class="container py-4">
        <div class="row">
            <!-- Blog Grid Start -->
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="bg-secondary p-3" style="padding-top: 20px; height: 350px;">
                            <div class="row">
                                <div class="col-2">
                                    <h5 class="font-weight-bold ">Rooms</h5>
                                </div>
                                <div class="col-10">
                                    <div class="col-12 input-group ">
                                        <input type="text" id="rooms-search" class="form-control border-0 p-2 ml-4"
                                            placeholder="Room id">
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
                            <div class="px-4">
                                <div style="max-height: 450px; overflow-y: auto;">
                                    <table class="table table-hover w-100 text-left">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="room-table-body">
                                            <!-- Hasil pencarian akan ditampilkan di sini -->
                                            @if ($rooms->isNotEmpty())
                                                @foreach ($rooms as $room)
                                                    <tr>
                                                        <td>{{ $room->id }}</td>
                                                        <td>{{ $room->name }}</td>
                                                        <td><button type="button"
                                                                class="btn btn-sm btn-transparent rounded-circle"
                                                                data-toggle="modal" data-target="#modalPassword"><i
                                                                    class="fa fa-lock"></i></button></td>
                                                    </tr>
                                        <!-- Modal masuk ruangan -->
                                                    <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Masuk Ruangan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action={{ url('/room/in') }} method="POST" class="flex-grow-1">
                                                                    @csrf
                                                                    <input type="hidden" name="room_id" value={{$room->id}}>
                                                                    <input type="hidden" name="user_id1" value={{ auth()->user()->id }}>
                                                                    <div class="modal-body bg-secondary">
                                                                        <div class="control-group">
                                                                            <input type="text" class="form-control border-0 p-4" id="name"
                                                                                placeholder="Nama ruangan" readonly name="name" value="{{$room->name}}"
                                                                                data-validation-required-message="Harap masukkan nama ruangan" />
                                                                            <p class="help-block text-danger"></p>
                                                                        </div>
                                                                        <div class="control-group position-relative">
                                                                            <input type="text" class="form-control border-0 p-4" id="password"
                                                                                placeholder="Password" name="password" value="{{ old('[password]') }}" />
                                                                            {{-- <span id="toggle-password" class="position-absolute"
                                                                                style="right: 15px; top: 15px; cursor: pointer;">
                                                                                <i class="fa fa-eye"></i>
                                                                            </span> --}}
                                                                            <p class="help-block text-danger"></p>
                                                                        </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Masuk</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal masuk ruangan -->

                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>Kosong</td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="bg-secondary mb-3" style="padding: 30px;">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-weight-bold mb-3">My room</h5>
                                </div>
                            </div>

                            <!-- Wrapper untuk Scroll Horizontal -->
                            <div class="d-flex overflow-auto" style="white-space: nowrap;">
                                @foreach ($myRooms as $room)
                                    <div class="col-md-4 d-inline-block" style="min-width: 250px;">
                                        <a class="text-decoration-none" href="{{ url('/room/' . $room->id) }}">
                                            <div class="bg-primary px-3 pt-2 shadow-lg rounded-lg ">
                                                <h5 class="text-white text-center font-weight-bold text-truncate">
                                                    {{ $room->name }}</h5>
                                                <p class="text-white text-right"><small>Room id:
                                                        <span>{{ $room->id }}</span></small></p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
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
                        <form action={{ url('/room/create') }} method="POST" class="flex-grow-1">
                            @csrf
                            <input type="hidden" name="user_id1" value={{ auth()->user()->id }}>
                            <div class="modal-body bg-secondary">
                                <div class="control-group">
                                    <input type="text" class="form-control border-0 p-4" id="name"
                                        placeholder="Nama ruangan" required="required" name="name"
                                        data-validation-required-message="Harap masukkan nama ruangan" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group position-relative">
                                    <input type="text" class="form-control border-0 p-4" id="password"
                                        placeholder="Password" name="password" value="{{ old('[password]') }}" />
                                    {{-- <span id="toggle-password" class="position-absolute"
                                        style="right: 15px; top: 15px; cursor: pointer;">
                                        <i class="fa fa-eye"></i>
                                    </span> --}}
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <select name="role_user1" class="custom-select" required>
                                        <option selected>Pilih peran anda</option>
                                        <option value="penjual">Penjual</option>
                                        <option value="pembeli">Pembeli</option>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <select required name="user_id2" class="custom-select select-search" required>
                                        <option selected value="">Pilih penjual / pembeli</option>
                                        @foreach ($member as $m)
                                            <option value={{ $m->id }}>{{ $m->username }}</option>
                                        @endforeach
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
            <div class="col-lg-8 ">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="bg-secondary" style="padding: 20px; height: 550px;">
                        <div class="row border-bottom">
                            <div class="col-4 d-flex align-items-center">
                                {{-- <h5 class="font-weight-bold mb-3">Transaction</h5> --}}
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                {{-- <h5 class="font-weight-bold mb-3">Akun efef 200k</h5> --}}
                            </div>
                        </div>

                        <div>
                            <!-- Konten lain di sini -->
                        </div>
                        <div class="d-flex align-items-end"
                            style="position: absolute; left: 20px; bottom: 80px; width: 90%;">
                            {{-- <div class="col-12 input-group ">
                                <input type="text" id="rooms-search" class="form-control border-1 ml-4 rounded-pill"
                                    placeholder="Ketik pesan...">
                                <div class="input-group-append">
                                    <span class="input-group-text rounded-circle bg-primary border-primary text-white"><i
                                            class="fa fa-paper-plane"></i></span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Search Form End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->

    <script>
        $('#modalTambahRuangan').on('shown.bs.modal', function() {
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
        });

        // Inisialisasi Select2
        $('#modalTambahRuangan').on('shown.bs.modal', function() {
            $('.select-search').select2({
                placeholder: "Pilih peran",
                allowClear: true
            });
        });

        document.getElementById('rooms-search').addEventListener('input', function() {
            const query = this.value;

            fetch(`/search-rooms?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('room-table-body');
                    tableBody.innerHTML = ''; // Bersihkan hasil sebelumnya

                    // Perulangan hasil pencarian dan tampilkan di tabel
                    data.forEach(room => {
                        const row = `<tr><td>${room.id}</td><td>${room.name}</td><td>masuk</td></tr>`;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error:', error));
        });


    </script>
@endsection
