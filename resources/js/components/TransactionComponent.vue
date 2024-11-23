<template>

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
                        <form action="#" class="d-flex">
                            <div class="input-group">
                                <input v-model="roomSearch" type="text" id="rooms-search" class="form-control border-0 rounded-pill p-2 shadow-sm" placeholder="Search Uninvited Room Id" style="font-size: 14px; transition: all 0.3s;">
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
                            <tr v-for="(eachRoom, indexRoom) in rooms" :key="eachRoom.id" style="cursor: pointer;">
                                <td>{{ eachRoom.id }}</td>
                                <td>{{ eachRoom.name }}</td>
                                <td class="text-center">
                                    <form v-if="eachRoom.user_id1 === authId" action="#" class="d-flex">
                                        <button @click="closeRoom (indexRoom)" type="button" class="btn btn-danger btn-sm rounded py-1 px-2 shadow-sm">Close</button>
                                    </form>
                                    <form v-else-if="eachRoom.user_id2 === authId && eachRoom.status_user2 === 'leaved'" action="#" class="d-flex">
                                        <button @click="showDialog (indexRoom)" type="button" class="btn btn-success btn-sm rounded py-1 px-2 shadow-sm">Join</button>
                                    </form>
                                    <form v-else-if="eachRoom.user_id2 === authId && eachRoom.status_user2 === 'joined'" action="#" class="d-flex">
                                        <button @click="leaveRoom (indexRoom)" type="button" class="btn btn-warning btn-sm rounded py-1 px-2 shadow-sm">Leave</button>
                                    </form>
                                    <button v-else class="btn btn-secondary btn-sm rounded py-1 px-2" disabled>
                                        <i v-if="eachRoom.admin_id === authId" class="fa fa-users-cog"></i>
                                        <i v-else class="fa fa-lock"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Create Room Button -->
                <div class="text-center mt-4">
                    <button @click="showDialog ('create')" class="btn btn-success rounded-pill btn-sm py-2 px-4 shadow-lg" style="width: 80%;">
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
                        <h5 v-if="room" class="font-weight-bold text-dark mb-3">
                            {{ '#' + room.id }}
                        </h5>
                    </div>
                </div>

                <div class="chat-box" style="min-height: 400px; max-height: 400px; overflow-y: auto; padding: 15px;">

                    <div class="chat-message d-flex mb-3 justify-content-start">
                        <div class="message-text" style="background-color: #dcf8c6; padding: 12px; border-radius: 15px; width: auto; min-width: 250px; max-width: 60%; position: relative; word-wrap: break-word; white-space: normal;">
                            <div style="font-size: 13px; color: #4d4d4d;">
                                <strong>JohnDoe</strong>
                            </div>
                            <p style="margin: 0; line-height: 1.4em; font-size: 14px;">
                                Hello, is anyone there?
                            </p>
                            <span class="message-time" style="position: absolute; top: 5px; right: 10px; font-size: 10px; color: #999;">
                                5 minutes ago
                            </span>
                        </div>
                    </div>

                    <div class="chat-message d-flex mb-3 justify-content-center">
                        <div class="message-text" style="background-color: #f1f1f1; padding: 12px; border-radius: 15px; width: auto; min-width: 250px; max-width: 60%; position: relative; word-wrap: break-word; white-space: normal;">
                            <div style="font-size: 13px; color: #4d4d4d;">
                                <strong>Admin (Admin 1)</strong>
                            </div>
                            <p style="margin: 0; line-height: 1.4em; font-size: 14px;">
                                Please follow the rules and respect everyone in the room.
                            </p>
                            <span class="message-time" style="position: absolute; top: 5px; right: 10px; font-size: 10px; color: #999;">
                                1 minute ago
                            </span>
                        </div>
                    </div>

                    <div class="chat-message d-flex mb-3 justify-content-end">
                        <div class="message-text" style="background-color: #e0f7fa; padding: 12px; border-radius: 15px; width: auto; min-width: 250px; max-width: 60%; position: relative; word-wrap: break-word; white-space: normal;">
                            <div style="font-size: 13px; color: #4d4d4d;">
                                <strong>JaneDoe</strong>
                            </div>
                            <p style="margin: 0; line-height: 1.4em; font-size: 14px;">
                                Hi John! I'm here, how can I help you?
                            </p>
                            <span class="message-time" style="position: absolute; top: 5px; right: 10px; font-size: 10px; color: #999;">
                                3 minutes ago
                            </span>
                        </div>
                    </div>

                    <p class="text-center">No more messages.</p>
                </div>

                <!-- Chat Input Box -->
                <form action="#" class="chat-input mt-5" style="position: relative;">
                    <div class="input-group bg-secondary px-3 py-2 rounded">
                        <input name="conversation_room_id" type="hidden" value="101">
                        <input name="conversation_receiver_id" type="hidden" value="1">
                        <input name="conversation_message" type="text" id="message-input" class="form-control border-0 rounded-pill p-3 shadow-sm" placeholder="Type a message..." style="font-size: 14px; transition: all 0.3s;">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary rounded-circle mx-3 shadow-sm" style="height: 45px; width: 45px; padding: 0;">
                                <i class="fa fa-paper-plane" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Room Modal -->
    <div class="modal fade" id="modalRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content rounded-lg shadow-lg border-0">
                <!-- Modal Header -->
                <div class="modal-header bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
                    <h5 v-text="dialogType == 'create' ? 'Create Room' : 'Join Room'" class="modal-title text-sm" id="exampleModalLabel"></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <form action="#" class="p-3">
                    <div class="modal-body">
                        <!-- Room Name -->
                        <div v-if="dialogType == 'create'" class="form-group mb-3">
                            <label for="name" class="font-weight-semibold text-primary text-sm">Room Name</label>
                            <input v-model="newRoom.room_name" type="text" class="form-control form-control-sm rounded-pill p-3 shadow-sm" placeholder="Enter room name" required />
                            <p class="help-block text-danger">{{ newRoom.error_room_name }}</p>
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="font-weight-semibold text-primary text-sm">Password</label>
                            <input v-model="newRoom.room_password" type="password" class="form-control form-control-sm rounded-pill p-3 shadow-sm" placeholder="Enter password" required />
                            <p class="help-block text-danger">{{ newRoom.error_room_password }}</p>
                        </div>

                        <!-- Role Selection -->
                        <div v-if="dialogType == 'create'" class="form-group mb-3">
                            <label for="room_role_user1" class="font-weight-semibold text-primary text-sm">Select Role</label>
                            <select v-model="newRoom.room_role_user1" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                <option disabled selected value="">Select Role</option>
                                <option v-for="eachRole in roles" :key="eachRole.id" :value="eachRole.id">{{ eachRole.name }}</option>
                            </select>
                            <p class="help-block text-danger">{{ newRoom.error_role_user1 }}</p>
                        </div>

                        <!-- User Selection -->
                        <div v-if="dialogType == 'create'" class="form-group mb-3">
                            <label for="room_user_id2" class="font-weight-semibold text-primary text-sm">Select Inviter</label>
                            <select v-model="newRoom.room_user_id2" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                <option disabled selected value="">Select Member</option>
                                <option v-for="eachMember in members" :key="eachMember.id" :value="eachMember.id">{{ eachMember.name }}</option>
                            </select>
                            <p class="help-block text-danger">{{ newRoom.error_user_id2 }}</p>
                        </div>

                        <!-- Admin Selection -->
                        <div v-if="dialogType == 'create'" class="form-group mb-3">
                            <label for="room_admin_id" class="font-weight-semibold text-primary text-sm">Select Admin</label>
                            <select v-model="newRoom.room_admin_id" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                <option disabled selected value="">Select Admin</option>
                                <option v-for="eachAdmin in admins" :key="eachAdmin.id" :value="eachAdmin.id">{{ eachAdmin.name }}</option>
                            </select>
                            <p class="help-block text-danger">{{ newRoom.error_admin_id }}</p>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer border-0">
                        <button @click="resetNewRoom" type="button" class="btn btn-secondary rounded-pill px-4 py-2" data-dismiss="modal">Cancel</button>
                        <button @click="dialogType == 'create' ? createNewRoom () : joinRoom (dialogType)" v-text="dialogType == 'create' ? 'Create Room' : 'Join Room'" type="button" class="btn btn-primary rounded-pill px-4 py-2"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Room Modal -->
</div>

</template>

<script>

import axios from 'axios';
import moment from 'moment';

export default
{
    name: 'TransactionComponent',

    data ()
    {
        return {

            authId: null,
            room: null,
            rooms: [],
            conversations: [],
            roles: [],
            admins: [],
            members: [],
            dialogType: '',
            roomSearch: '',
            newRoom: {

                room_name: '',
                error_room_name: '',

                room_password: '',
                error_room_password: '',

                room_role_user1: '',
                error_role_user1: '',

                room_user_id2: '',
                error_user_id2: '',

                room_admin_id: '',
                error_admin_id: '',
            },
        };
    },

    methods: {

        datetime (date)
        {
            return moment (date).fromNow();
        },

        showDialog (type)
        {
            this.dialogType = type;
            $ ('#modalRoom').modal ('show');
        },

        resetNewRoom ()
        {
            this.newRoom.room_name = '';
            this.newRoom.error_room_name = '';

            this.newRoom.room_password = '';
            this.newRoom.error_room_password = '';

            this.newRoom.room_role_user1 = '';
            this.newRoom.error_role_user1 = '';

            this.newRoom.room_user_id2 = '';
            this.newRoom.error_user_id2 = '';

            this.newRoom.room_admin_id = '';
            this.newRoom.error_admin_id = '';
        },

        createNewRoom ()
        {
            axios.post ('/transaction/room', this.newRoom).then (response => {

                this.rooms.unshift (response.data.original);
                this.resetNewRoom ();
                $ ('#modalRoom').modal ('hide');

            }).catch (error => {

                this.newRoom.error_room_name = error?.response?.data?.errors?.room_name?.[0];
                this.newRoom.error_room_password = error?.response?.data?.errors?.room_password?.[0];
                this.newRoom.error_role_user1 = error?.response?.data?.errors?.room_role_user1?.[0];
                this.newRoom.error_user_id2 = error?.response?.data?.errors?.room_user_id2?.[0];
                this.newRoom.error_admin_id = error?.response?.data?.errors?.room_admin_id?.[0];
            });
        },

        closeRoom (indexRoom)
        {
            const room = this.rooms[indexRoom];

            axios.delete (`/transaction/room/${room.id}`).then (response => {

                this.rooms.splice (indexRoom, 1);
            });
        },

        joinRoom (indexRoom)
        {
            const room = this.rooms[indexRoom];

            axios.put (`/transaction/room/join/${room.id}`, {

                password: this.newRoom.room_password,

            }).then (response => {

                this.rooms[indexRoom] = response.data.original;
                $ ('#modalRoom').modal ('hide');

            }).catch (error => {

                this.newRoom.error_room_password = error?.response?.data?.errors?.password?.[0];
            });;
        },

        leaveRoom (indexRoom)
        {
            const room = this.rooms[indexRoom];

            axios.put (`/transaction/room/leave/${room.id}`).then (response => {

                this.rooms[indexRoom] = response.data.original;
            });
        },
    },

    watch: {

        roomSearch (newValue, oldValue)
        {
            axios.get (`/transaction/room/${this.roomSearch}`).then (response => {

                this.rooms = response.data.rooms;
            });
        },
    },

    created ()
    {
        axios.get ('/transaction/room').then (response => {

            this.authId = response.data.authId;
            this.admins = response.data.admins;
            this.members = response.data.members;
            this.rooms = response.data.rooms;
            this.roles = [

                {
                    id: 'penjual',
                    name: 'Seller',
                },
                {
                    id: 'pembeli',
                    name: 'Buyer',
                },
            ];
        });
    },

    mounted ()
    {
        //
    },
};

</script>
