@push('styles')
    <livewire:styles />
@endpush

@push('scripts')
    <livewire:scripts />
@endpush

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
                        <div class="input-group">
                            <input type="text" id="rooms-search" class="form-control border-0 rounded-pill p-2 shadow-sm" placeholder="Search Room ID" style="font-size: 14px; transition: all 0.3s;">
                            <div class="input-group-append">
                                <button class="btn btn-transparent border btn-sm rounded-circle ml-2" type="button">
                                    <i class="fa fa-search" style="font-size: 16px;"></i>
                                </button>
                            </div>
                        </div>
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
                            <!-- Dummy data, these rows should be dynamic -->
                            <tr>
                                <td>1</td>
                                <td>Room 1</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-danger btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Room 2</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-danger btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Room 3</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-danger btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Room 4</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-danger btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Room 5</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-danger btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Room 6</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-danger btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Room 7</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-danger btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Room 8</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-danger btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Room 9</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-danger btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Room 10</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-danger btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                </td>
                            </tr>
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
                        <h5 class="font-weight-bold text-dark mb-3">Chatroom</h5>
                    </div>
                </div>

                <div class="chat-box" style="max-height: 400px; overflow-y: auto; padding: 15px; min-height: 400px;">
                    <!-- Chat message user 1 (left) -->
                    <div class="chat-message d-flex mb-3 justify-content-start">
                        <div class="message-text" style="background-color: #dcf8c6; padding: 12px; border-radius: 15px; max-width: 50%; position: relative;">
                            <div style="font-size: 13px; color: #4d4d4d;">
                                <strong>User 1</strong>
                            </div>
                            <p style="margin: 0; line-height: 1.4em; font-size: 14px; overflow: hidden; text-overflow: ellipsis; white-space: normal;">
                                Hi there! How are you doing? This is a very long message to demonstrate the ellipsis functionality in action...
                            </p>
                            <span class="message-time" style="position: absolute; top: 5px; right: 10px; font-size: 10px; color: #999;">Last 1 hour</span>
                        </div>
                    </div>

                    <!-- Chat message user 2 (right) -->
                    <div class="chat-message d-flex mb-3 justify-content-end">
                        <div class="message-text" style="background-color: #e0f7fa; padding: 12px; border-radius: 15px; max-width: 50%; position: relative;">
                            <div style="font-size: 13px; color: #4d4d4d;">
                                <strong>User 2</strong>
                            </div>
                            <p style="margin: 0; line-height: 1.4em; font-size: 14px;">
                                Hello! I'm good. Thanks for asking. Here's a longer message to show how the overflow works with long text...
                            </p>
                            <span class="message-time" style="position: absolute; top: 5px; right: 10px; font-size: 10px; color: #999;">Last 30 minutes</span>
                        </div>
                    </div>

                    <!-- Chat message admin (center) -->
                    <div class="chat-message d-flex mb-3 justify-content-center">
                        <div class="message-text" style="background-color: #f1f1f1; padding: 12px; border-radius: 15px; max-width: 50%; position: relative;">
                            <div style="font-size: 13px; color: #4d4d4d;">
                                <strong>Admin</strong>
                            </div>
                            <p style="margin: 0; line-height: 1.4em; font-size: 14px; overflow: hidden; text-overflow: ellipsis; white-space: normal;">
                                Welcome to the chatroom! Please be respectful and follow the rules. Let me know if you have any questions.
                            </p>
                            <span class="message-time" style="position: absolute; top: 5px; right: 10px; font-size: 10px; color: #999;">Last 5 minutes</span>
                        </div>
                    </div>

                </div>

                <!-- Chat Input Box -->
                <div class="chat-input mt-4" style="position: relative;">
                    <div class="input-group bg-secondary px-3 py-2 rounded">
                        <input type="text" id="message-input" class="form-control border-0 rounded-pill p-3 shadow-sm" placeholder="Type a message..." style="font-size: 14px; transition: all 0.3s;">
                        <div class="input-group-append">
                            <button class="btn btn-primary rounded-circle mx-3 shadow-sm" style="height: 45px; width: 45px; padding: 0;">
                                <i class="fa fa-paper-plane" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </div>
                </div>
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
                <div class="p-3">
                    <input type="hidden" name="user_id1" value="1"> <!-- Dummy user ID -->
                    
                    <div class="modal-body">
                        <!-- Room Name -->
                        <div class="form-group mb-3">
                            <label for="name" class="font-weight-semibold text-primary text-sm">Room Name</label>
                            <input type="text" class="form-control form-control-sm rounded-pill p-3 shadow-sm" id="name" placeholder="Enter room name" required name="name" />
                            <p class="help-block text-danger"></p>
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="font-weight-semibold text-primary text-sm">Password</label>
                            <input type="password" class="form-control form-control-sm rounded-pill p-3 shadow-sm" id="password" placeholder="Enter password" name="password" value="password123" />
                            <p class="help-block text-danger"></p>
                        </div>

                        <!-- Role Selection -->
                        <div class="form-group mb-3">
                            <label for="role_user1" class="font-weight-semibold text-primary text-sm">Select Role</label>
                            <select name="role_user1" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                <option selected disabled>Select your role</option>
                                <option value="seller">Seller</option>
                                <option value="buyer">Buyer</option>
                            </select>
                            <p class="help-block text-danger"></p>
                        </div>

                        <!-- User Selection -->
                        <div class="form-group mb-3">
                            <label for="user_id2" class="font-weight-semibold text-primary text-sm">Select Seller / Buyer</label>
                            <select name="user_id2" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                <option selected disabled>Select seller / buyer</option>
                                <option value="1">User 1</option>
                                <option value="2">User 2</option>
                                <option value="3">User 3</option>
                            </select>
                            <p class="help-block text-danger"></p>
                        </div>

                        <!-- Admin Selection -->
                        <div class="form-group mb-3">
                            <label for="admin_id" class="font-weight-semibold text-primary text-sm">Select Admin</label>
                            <select name="admin_id" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                <option selected disabled>Select admin</option>
                                <option value="1">Admin 1</option>
                                <option value="2">Admin 2</option>
                            </select>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary rounded-pill px-4 py-2" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Create Room</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Room Modal -->

</div>
