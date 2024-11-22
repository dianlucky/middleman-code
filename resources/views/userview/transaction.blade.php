@extends('layouts.userMain')

@section('content')
    <div class="container py-4">
        <div class="row">
            <!-- Room List Section -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="bg-gradient p-4 rounded shadow-lg" style="background: linear-gradient(145deg, #f9f9f9, #e0e0e0); height: 480px; overflow-y: auto; min-height: 480px;">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="font-weight-bold text-dark">Rooms</h5>
                        </div>
                        <div class="col-12">
                            <!-- Search Input with Icon -->
                            <form method="get" action="{{ route('transaction.index') }}" class="d-flex">
                                @csrf
                                <div class="input-group">
                                    <input name="roomSearch" type="text" id="rooms-search" class="form-control border-0 rounded-pill p-2 shadow-sm" placeholder="Search Room Id" style="font-size: 14px; transition: all 0.3s;">
                                    <div class="input-group-append">
                                        <button class="btn btn-transparent border btn-sm rounded-circle ml-2" type="submit">
                                            <i class="fa fa-search" style="font-size: 16px;"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table Container with horizontal scroll -->
                    <div class="table-container" style="max-height: 300px; overflow-y: auto; overflow-x: auto;">
                        <table class="table table-hover table-striped" style="table-layout: fixed; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">ID</th>
                                    <th style="width: 50%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Name</th>
                                    <th style="width: 30%; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr style="cursor: pointer;" onclick="window.location.href='{{ route('transaction.index', ['id' => $room->id]) }}'">
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td class="text-center">
                                            @if ($room->user_id1 === auth()->id())
                                                <form method="post" action="{{ route('transaction.room.destroy', ['id' => $room->id]) }}" class="d-flex">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm rounded py-1 px-2 shadow-sm">Close</button>
                                                </form>
                                            @elseif ($room->user_id2 === auth()->id() && $room->status_user2 === \App\Repositories\RoomAdminRepository::$INVITER_STATUS_LEAVED)
                                                <form method="post" action="{{ route('transaction.room.join', ['id' => $room->id]) }}" class="d-flex">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-success btn-sm rounded py-1 px-2 shadow-sm">Join</button>
                                                </form>
                                            @elseif ($room->user_id2 === auth()->id() && $room->status_user2 === \App\Repositories\RoomAdminRepository::$INVITER_STATUS_JOINED)
                                                <form method="post" action="{{ route('transaction.room.leave', ['id' => $room->id]) }}" class="d-flex">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-warning btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-sm rounded py-1 px-2" disabled>
                                                    @if ($room->admin_id === auth()->id())
                                                        <i class="fa fa-users-cog"></i>
                                                    @else
                                                        <i class="fa fa-lock"></i>
                                                    @endif
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Create Room Button -->
                    <div class="text-center mt-4">
                        <button class="btn btn-success rounded-pill btn-sm py-2 px-4 shadow-lg"
                                style="width: 80%;"
                                data-toggle="modal"
                                data-target="#modalTambahRuangan">
                            Create Room
                        </button>
                    </div>
                </div>
            </div>

            <!-- Chatroom Section -->
            <div class="col-lg-8 col-md-12">
                <div class="bg-gradient p-4 rounded shadow-lg" style="background: linear-gradient(145deg, #e8e8e8, #c9c9c9); height: 480px; min-height: 480px;">
                    <div class="row border-bottom mb-3">
                        <div class="col-12 d-flex align-items-center">
                            <h5 class="font-weight-bold text-dark mb-3">
                                @if (@$data_room->id)
                                    {{ '#'.@$data_room->id }}
                                @endif
                            </h5>
                        </div>
                    </div>

                    <div class="chat-box" style="max-height: 400px; overflow-y: auto; padding: 15px; min-height: 400px;">
                        @if (isset ($data_conversations))
                            @forelse ($data_conversations as $conversation)
                            @if ($conversation->user_sender_id === auth()->id())
                                <div class="chat-message d-flex mb-3 justify-content-start">
                                    <div class="message-text" style="background-color: #dcf8c6; padding: 12px; border-radius: 15px; width: auto; min-width: 250px; max-width: 60%; position: relative; word-wrap: break-word; white-space: normal;">
                                        <div style="font-size: 13px; color: #4d4d4d;">
                                            <strong>{{ $conversation->sender->username }}</strong>
                                        </div>
                                        <p style="margin: 0; line-height: 1.4em; font-size: 14px;">
                                            {{ $conversation->message }}
                                        </p>
                                        <span class="message-time" style="position: absolute; top: 5px; right: 10px; font-size: 10px; color: #999;">
                                            {{ \Carbon\Carbon::parse($conversation->created_at)->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                @if ($conversation->sender->role === "member")
                                    <div class="chat-message d-flex mb-3 justify-content-end">
                                        <div class="message-text" style="background-color: #e0f7fa; padding: 12px; border-radius: 15px; width: auto; min-width: 250px; max-width: 60%; position: relative; word-wrap: break-word; white-space: normal;">
                                            <div style="font-size: 13px; color: #4d4d4d;">
                                                <strong>{{ $conversation->sender->username }}</strong>
                                            </div>
                                            <p style="margin: 0; line-height: 1.4em; font-size: 14px;">
                                                {{ $conversation->message }}
                                            </p>
                                            <span class="message-time" style="position: absolute; top: 5px; right: 10px; font-size: 10px; color: #999;">
                                                {{ \Carbon\Carbon::parse($conversation->created_at)->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                @elseif ($conversation->sender->role === "admin")
                                    <div class="chat-message d-flex mb-3 justify-content-center">
                                        <div class="message-text" style="background-color: #f1f1f1; padding: 12px; border-radius: 15px; width: auto; min-width: 250px; max-width: 60%; position: relative; word-wrap: break-word; white-space: normal;">
                                            <div style="font-size: 13px; color: #4d4d4d;">
                                                <strong>Admin</strong>
                                            </div>
                                            <p style="margin: 0; line-height: 1.4em; font-size: 14px;">
                                                {{ $conversation->message }}
                                            </p>
                                            <span class="message-time" style="position: absolute; top: 5px; right: 10px; font-size: 10px; color: #999;">
                                                {{ \Carbon\Carbon::parse($conversation->created_at)->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @empty
                                <p class="text-center">Empty conversation.</p>
                            @endforelse
                        @else
                            <p class="text-center">You are not in a room or you may not be authorized to enter this room.</p>
                        @endif
                    </div>

                    <!-- Chat Input Box -->
                    <form method="post" action="{{ route('transaction.conversation.store') }}" class="chat-input mt-5" style="position: relative;">
                        @csrf
                        <div class="input-group bg-secondary px-3 py-2 rounded">
                            <input name="conversation_room_id" type="hidden" value="{{ @$data_room->id }}">
                            <input name="conversation_receiver_id" type="hidden" value="{{ @$data_room->inviter->id }}">
                            <input @if (! @$data_room) disabled @endif name="conversation_message" type="text" id="message-input" class="form-control border-0 rounded-pill p-3 shadow-sm" placeholder="@if (@$data_room) Type a message... @endif" style="font-size: 14px; transition: all 0.3s;">
                            <div class="input-group-append">
                                <button @if (! @$data_room) disabled @endif type="submit" class="btn btn-primary rounded-circle mx-3 shadow-sm" style="height: 45px; width: 45px; padding: 0;">
                                    <i class="fa fa-paper-plane" style="font-size: 20px;"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Room Modal -->
        <div class="modal fade" id="modalTambahRuangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content rounded-lg shadow-lg border-0">
                    <!-- Modal Header -->
                    <div class="modal-header bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
                        <h5 class="modal-title text-sm" id="exampleModalLabel">Create Room</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <!-- Modal Body -->
                    <form method="post" action="{{ route('transaction.room.store') }}" class="p-3">
                        @csrf

                        <div class="modal-body">
                            <!-- Room Name -->
                            <div class="form-group mb-3">
                                <label for="name" class="font-weight-semibold text-primary text-sm">Room Name</label>
                                <input name="room_name" type="text" class="form-control form-control-sm rounded-pill p-3 shadow-sm" id="name" placeholder="Enter room name" required />
                                @error('room_name')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <label for="password" class="font-weight-semibold text-primary text-sm">Password</label>
                                <input name="room_password" type="password" class="form-control form-control-sm rounded-pill p-3 shadow-sm" id="password" placeholder="Enter password" required />
                                @error('room_password')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Role Selection -->
                            <div class="form-group mb-3">
                                <label for="room_role_user1" class="font-weight-semibold text-primary text-sm">Select Role</label>
                                <select name="room_role_user1" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                    <!-- <option selected disabled>Select your role</option> -->
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>

                            <!-- User Selection -->
                            <div class="form-group mb-3">
                                <label for="room_user_id2" class="font-weight-semibold text-primary text-sm">Select Seller / Buyer</label>
                                <select name="room_user_id2" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                    <!-- <option selected disabled>Select seller / buyer</option> -->
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>

                            <!-- Admin Selection -->
                            <div class="form-group mb-3">
                                <label for="room_admin_id" class="font-weight-semibold text-primary text-sm">Select Admin</label>
                                <select name="room_admin_id" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                    <!-- <option selected disabled>Select admin</option> -->
                                    @foreach ($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary rounded-pill px-4 py-2" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Create Room</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Add Room Modal -->

    </div>
@endsection
