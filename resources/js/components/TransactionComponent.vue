<template>

<div class="container py-4">
    <div class="row">
        <!-- Room List Section -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="bg-gradient p-4 rounded shadow-lg" style="background: linear-gradient(145deg, #f9f9f9, #e0e0e0); height: 550px; overflow-y: auto; min-height: 550px;">
                <div class="row mb-3">
                    <div class="col-12">
                        <h5 class="font-weight-bold text-dark">Rooms</h5>
                    </div>
                    <div class="col-12">
                        <!-- Search Input with Icon -->
                        <form action="#" class="d-flex">
                            <div class="input-group">
                                <input v-model="roomSearch" type="text" class="form-control border-0 rounded-pill p-2 shadow-sm" placeholder="Search Room Id" style="font-size: 14px; transition: all 0.3s;">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table Container with horizontal scroll -->
                <div class="table-container" style="min-height: 330px; max-height: 330px; overflow-y: auto; overflow-x: auto;">
                    <table class="table table-hover table-striped" style="table-layout: fixed; width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 20%;">ID</th>
                                <th style="width: 50%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Name</th>
                                <th style="width: 30%; text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr @click="eachRoom.user_id1 === authId || (eachRoom.user_id2 === authId && eachRoom.status_user2 === 'joined') || eachRoom.admin.id === authId ? chooseRoom (indexRoom) : false" v-for="(eachRoom, indexRoom) in rooms" :key="eachRoom.id" :style="{ cursor: 'pointer', backgroundColor: room?.id === eachRoom.id ? 'rgba(0, 0, 0, 0.18)' : '' }">
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
                                    <div v-else class="dropdown">
                                        <button id="statusChanger" class="btn btn-sm btn-primary border rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="badge badge-pill badge-primary rounded position-absolute" style="margin-left: -30px; margin-top: -10px">{{ eachRoom.status }}</span>
                                            <i class="fa fa-users-cog text-white"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="statusChanger">
                                            <a @click="updateStatusRoom (indexRoom, 'ongoing')" class="dropdown-item" href="#">Ongoing</a>
                                            <a @click="updateStatusRoom (indexRoom, 'canceled')" class="dropdown-item" href="#">Canceled</a>
                                            <a @click="updateStatusRoom (indexRoom, 'done')" class="dropdown-item" href="#">Done</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Create Room Button -->
                <div class="text-center" :style="{ marginTop: authRole == 'member' ? '3.5rem' : '0.8rem', }">
                    <button @click="showDialog ('create')" class="btn btn-primary rounded-pill btn-sm py-2 px-4 shadow-lg" style="width: 80%;">
                        Create Room
                    </button>
                </div>
            </div>
        </div>

        <!-- Chatroom Section -->
        <div class="col-lg-8 col-md-12 bg-gradient p-4 rounded shadow-lg" style="background: linear-gradient(145deg, #e8e8e8, #c9c9c9); height: 550px; min-height: 550px;">
            <div style="height: 480px; min-height: 480px;">
                <div v-if="room" class="row border-bottom mb-3">
                    <div class="col-6 d-flex justify-content-start">
                        <h5 class="font-weight-bold text-dark mb-3">
                            {{ '#' + room.id }}
                        </h5>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button type="button" class="btn" data-toggle="modal" data-target="#modalInformation">
                            <i class="fa fa-info-circle"></i>
                        </button>

                        <div class="modal fade" id="modalInformation" tabindex="-1" role="dialog" aria-labelledby="modalInformationTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content border-0 rounded">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title" id="modalInformationTitle">Room Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="font-weight-bold text-uppercase"></span>
                                            <span>{{ originalDateTime (room.created_at) }}</span>
                                        </div>
                                        <div>&nbsp;</div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="font-weight-bold text-uppercase">Password</span>
                                            <span>{{ room.password }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="font-weight-bold text-uppercase">{{ room.role_user1 }}</span>
                                            <span>{{ room.owner.username }} ({{ room.owner.name }})</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="font-weight-bold text-uppercase">{{ room.role_user2 }}</span>
                                            <span>{{ room.inviter.username }} ({{ room.inviter.name }})</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="font-weight-bold text-uppercase">Admin</span>
                                            <span>{{ room.admin.username }} ({{ room.admin.name }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="chat-box" style="min-height: 400px; max-height: 400px; overflow-y: auto; overflow-x: hidden; padding: 15px;">
                    <div v-if="conversations.length > 0">
                        <div v-for="(eachConversation, indexConversation) in conversations" :key="eachConversation.id">
                            <div v-if="eachConversation.user_sender_id === authId" class="chat-message d-flex mb-3 justify-content-end">
                                <div class="message-text" style="background-color: #dcf8c6; padding: 15px; border-radius: 15px; width: auto; min-width: 250px; max-width: 60%; position: relative; word-wrap: break-word; white-space: normal;">
                                    <span class="message-time d-flex justify-content-end align-items-center" style="margin: -10px; font-size: 10px; color: #999;">
                                        <span>{{ datetime (eachConversation.created_at) }}</span>
                                        <span v-if="authRole == 'member'">
                                            <button disabled class="btn btn-sm" data-toggle="tooltip" data-placement="top" :title="eachConversation.is_admin_watchable ? 'This conversation is shown to the Admin' : 'This conversation is hidden from the Admin'">
                                                <i v-if="eachConversation.is_admin_watchable" class="fa fa-eye"></i>
                                                <i v-else class="fa fa-eye-slash"></i>
                                            </button>
                                        </span>
                                    </span>
                                    <div style="font-size: 13px; color: #4d4d4d;">
                                        <strong>{{ eachConversation.sender.username }} ({{eachConversation.sender_role ?? 'admin'}})</strong>
                                    </div>
                                    <p style="margin: 0; line-height: 1.4em; font-size: 14px;" v-html="eachConversation.message"></p>
                                    <span v-if="checkboxConversation" class="message-check" style="position: absolute; right: 0px; font-size: 10px; color: #999;" :style="{ top: authRole == 'member' ? '3.3rem' : '2rem', }">
                                        <span class="form-check">
                                            <input class="form-check-input" type="checkbox" v-model="bulkConversations" :value="indexConversation">
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div v-else>
                                <div v-if="eachConversation.sender.role === 'member'" class="chat-message d-flex mb-3 justify-content-start">
                                    <div class="message-text" style="background-color: #e0f7fa; padding: 15px; border-radius: 15px; width: auto; min-width: 250px; max-width: 60%; position: relative; word-wrap: break-word; white-space: normal;">
                                        <span class="message-time d-flex justify-content-end align-items-center" style="margin: -10px; font-size: 10px; color: #999;">
                                            <span>{{ datetime (eachConversation.created_at) }}</span>
                                            <span v-if="authRole == 'member'">
                                                <button disabled class="btn btn-sm" data-toggle="tooltip" data-placement="top" :title="eachConversation.is_admin_watchable ? 'This conversation is shown to the Admin' : 'This conversation is hidden from the Admin'">
                                                    <i v-if="eachConversation.is_admin_watchable" class="fa fa-eye"></i>
                                                    <i v-else class="fa fa-eye-slash"></i>
                                                </button>
                                            </span>
                                        </span>
                                        <div style="font-size: 13px; color: #4d4d4d;">
                                            <strong>{{ eachConversation.sender.username }} ({{eachConversation.sender_role ?? 'admin'}})</strong>
                                        </div>
                                        <p style="margin: 0; line-height: 1.4em; font-size: 14px;" v-html="eachConversation.message"></p>
                                    </div>
                                </div>
                                <div v-else-if="eachConversation.sender.role === 'admin'" class="chat-message d-flex mb-3 justify-content-center">
                                    <div class="message-text" style="background-color: #f1f1f1; padding: 15px; border-radius: 15px; width: auto; min-width: 250px; max-width: 60%; position: relative; word-wrap: break-word; white-space: normal;">
                                        <span class="message-time" style="position: absolute; top: 5px; right: 10px; font-size: 10px; color: #999;">
                                            <span>{{ datetime (eachConversation.created_at) }}</span>
                                        </span>
                                        <div style="font-size: 13px; color: #4d4d4d;">
                                            <strong>{{ eachConversation.room.admin.username }} (admin)</strong>
                                        </div>
                                        <p style="margin: 0; line-height: 1.4em; font-size: 14px;" v-html="eachConversation.message"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p v-else class="text-center">
                        <div v-if="! room">No choosed room.</div>
                        <div v-else>There are no conversations.</div>
                    </p>
                </div>

                <!-- Chat Input Box -->
                <form @submit="e => { e.preventDefault (); }" class="chat-input" style="position: relative;" :style="{ marginTop: ! room ? '55px' : '-3px', }">
                    <div class="input-group px-3 py-2 rounded">
                        <div class="input-group-append">
                            <div class="btn-group dropup">
                                <input ref="fileUpload" @change="uploadFile" :accept="supportedFileExtensionUpload.map (ext => `.${ext}`).join (',')" type="file" class="d-none" />
                                <button @click="! fileUpload ? $refs.fileUpload.click () : null" :disabled="! room" type="button" class="btn rounded-circle ml-3 mr-3 shadow-md border" :class="! fileUpload ? 'btn-success' : 'btn-danger'" style="height: 35px; width: 35px; padding: 0;">
                                    <i v-if="! fileUpload" class="fa fa-paperclip" style="font-size: 15px;"></i>
                                    <i v-else class="fa fa-file" style="font-size: 15px;"></i>

                                    <span v-if="fileUpload" @click="(e) => { e.stopPropagation (); fileUpload = null; }" class="position-absolute badge badge-danger rounded font-weight-light" style="right: -13px;"><i class="fa fa-times"></i></span>
                                    <span v-if="fileUpload" @click="(e) => { e.stopPropagation (); previewFile (); }" class="position-absolute badge badge-success rounded font-weight-light" style="left: -10px; top: -10px;">{{ fileExtensionUpload }}</span>
                                </button>
                            </div>
                        </div>
                        <input @keydown="controlConversation" :disabled="! room" ref="chat" v-model="newConversation.conversation_message" type="text" class="form-control border-0 rounded-pill p-3 shadow-sm" :placeholder="! room ? '' : 'Type a message...'" style="font-size: 14px; transition: all 0.3s;">
                        <div class="input-group-append">
                            <div class="btn-group dropup">
                                <button @click="submitConversation ()" :disabled="! room" type="button" class="btn btn-success rounded-circle ml-3 mr-1 shadow-md border" style="height: 35px; width: 35px; padding: 0;">
                                    <i class="fa fa-paper-plane" style="font-size: 15px;"></i>
                                </button>
                                <button :disabled="! room" type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split rounded-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 35px; width: 35px;"></button>
                                <div class="dropdown-menu rounded p-2">
                                    <a v-if="authRole == 'member'" @click="submitConversation ('private')" class="dropdown-item p-1" href="#"><small>Send as Private</small></a>
                                    <a v-if="authRole == 'member' && checkboxConversation" @click="optionConversations ('hide')" class="dropdown-item p-1" href="#"><small>Make Private</small></a>
                                    <a v-if="authRole == 'member' && checkboxConversation" @click="optionConversations ('show')" class="dropdown-item p-1" href="#"><small>Make Public</small></a>
                                    <a v-if="checkboxConversation" class="dropdown-item p-1" @click="optionConversations ('delete')" href="#"><small>Delete</small></a>
                                    <a class="dropdown-item p-1" @click="checkboxConversation = ! checkboxConversation; bulkConversations = []" href="#"><small>{{ ! checkboxConversation ? 'Mark' : 'Unmark' }}</small></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Room Modal -->
    <div class="modal fade" id="modalRoom" tabindex="-1" role="dialog" aria-labelledby="modalRoomLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content rounded-lg shadow-lg border-0">
                <!-- Modal Header -->
                <div class="modal-header bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
                    <h5 v-text="dialogType == 'create' ? 'Create Room' : 'Join Room'" class="modal-title text-sm" id="modalRoomLabel"></h5>
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
                                <option disabled selected value="">Select Member Inviter</option>
                                <option v-for="eachMember in members" :key="eachMember.id" :value="eachMember.id">{{ eachMember.name }}</option>
                            </select>
                            <p class="help-block text-danger">{{ newRoom.error_user_id2 }}</p>
                        </div>

                        <!-- Admin Selection -->
                        <div v-if="authRole == 'member' && dialogType == 'create'" class="form-group mb-3">
                            <label for="room_admin_id" class="font-weight-semibold text-primary text-sm">Select Admin</label>
                            <select v-model="newRoom.room_admin_id" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                <option disabled selected value="">Select Admin</option>
                                <option v-for="eachAdmin in admins" :key="eachAdmin.id" :value="eachAdmin.id">{{ eachAdmin.name }}</option>
                            </select>
                            <p class="help-block text-danger">{{ newRoom.error_admin_id }}</p>
                        </div>
                        <div v-else-if="authRole != 'member' && dialogType == 'create'" class="form-group mb-3">
                            <label for="room_user_id1" class="font-weight-semibold text-primary text-sm">Select Owner</label>
                            <select v-model="newRoom.room_user_id1" class="custom-select form-control-sm rounded-pill shadow-sm" required>
                                <option disabled selected value="">Select Member Owner</option>
                                <option v-for="eachMember in members" :key="eachMember.id" :value="eachMember.id">{{ eachMember.name }}</option>
                            </select>
                            <p class="help-block text-danger">{{ newRoom.error_user_id1 }}</p>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer border-0">
                        <button @click="resetNewRoom" type="button" class="btn btn-secondary rounded-pill px-4 py-2" data-dismiss="modal">Cancel</button>
                        <span class="mx-2"></span>
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
            authRole: null,
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

                room_user_id1: '',
                error_user_id1: '',
            },

            newConversation: {

                conversation_room_id: '',
                conversation_receiver_id: '',

                conversation_message: '',
                error_conversation_message: '',
            },

            fileUpload: null,
            fileExtensionUpload: null,
            supportedFileExtensionUpload: [ 'jpg', 'jpeg', 'png', 'pdf', ],

            checkboxConversation: false,
            bulkConversations: [],
        };
    },

    methods: {

        originalDateTime (date)
        {
            return moment (date).format ('LLLL');
        },

        datetime (date)
        {
            return moment (date).fromNow ();
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

            this.newRoom.room_user_id1 = '';
            this.newRoom.error_user_id1 = '';
        },

        updateStatusRoom (indexRoom, status)
        {
            const room = this.rooms[indexRoom];

            axios.put (`/room/${room.id}`, {

                room_status: status,

            }).then (response => {

                this.rooms[indexRoom].status = response.data.original.status;
            });
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
                this.newRoom.error_user_id1 = error?.response?.data?.errors?.room_user_id1?.[0];
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
                this.resetNewRoom ();
                $ ('#modalRoom').modal ('hide');

            }).catch (error => {

                this.newRoom.error_room_password = error?.response?.data?.errors?.password?.[0];
            });
        },

        leaveRoom (indexRoom)
        {
            const room = this.rooms[indexRoom];

            axios.put (`/transaction/room/leave/${room.id}`).then (response => {

                this.rooms[indexRoom] = response.data.original;
            });
        },

        chooseRoom (indexRoom)
        {
            this.room = this.rooms[indexRoom];

            axios.get (`/transaction/conversation/${this.room.id}`).then (response => {

                this.conversations = response.data.conversations;

                this.scrollConversation ();
                this.$refs.chat.focus ();
            });
        },

        controlConversation (e)
        {
            if (e.shiftKey && e.key === 'Enter') {

                this.scrollConversation ();

            } else if (! e.shiftKey && e.key === 'Enter') {

                this.submitConversation ();
            }
        },

        scrollConversation ()
        {
            const chatBox = $ ('.chat-box');

            setTimeout (() => {

                chatBox.animate ({ scrollTop: chatBox[0].scrollHeight, }, 100);

            }, 50);
        },

        resetNewConversation ()
        {
            this.newConversation.conversation_room_id = '';
            this.newConversation.conversation_receiver_id = '';

            this.newConversation.conversation_message = '';
            this.newConversation.error_conversation_message = '';
        },

        submitConversation (mode = 'public')
        {
            this.newConversation.conversation_room_id = this.room.id;

            if (this.authId === this.room.admin.id) {

                this.newConversation.conversation_receiver_id = this.room.admin.id;

            } else if (this.authId === this.room.owner.id) {

                this.newConversation.conversation_receiver_id = this.room.inviter.id;

            } else if (this.authId === this.room.inviter.id) {

                this.newConversation.conversation_receiver_id = this.room.owner.id;
            }

            if (mode === 'private') this.newConversation.is_admin_watchable = false;
            if (mode === 'public') this.newConversation.is_admin_watchable = true;

            if (this.fileUpload) {

                let fileUpload = this.fileUpload;

                if (this.supportedFileExtensionUpload.includes (this.fileExtensionUpload)) {

                    if (this.fileExtensionUpload === 'pdf') {

                        fileUpload = `<div class="d-flex justify-content-center"><i class="fa fa-file"></i><a target="_blank" href="${fileUpload}" class="position-absolute" style="margin-left: 30px; margin-top: 5px;"><i class="fa fa-download"></i></a></div>`;

                    } else {

                        fileUpload = `<img src="${fileUpload}" class="attachment-image img-thumbnail" /><a target="_blank" href="${fileUpload}" class="position-absolute" style="right: 6px; top: 100px;"><i class="fa fa-download"></i></a>`;
                    }
                }

                if (this.newConversation.conversation_message) fileUpload = fileUpload + '<br />';

                this.newConversation.conversation_message = (fileUpload + this.newConversation.conversation_message).trim ();

                this.fileUpload = null;
                this.fileExtensionUpload = null;
            }

            axios.post ('/transaction/conversation', this.newConversation).then (response => {

                this.addConversation (response.data.original);
                this.resetNewConversation ();

            }).catch (error => {

                this.newConversation.error_conversation_message = error?.response?.data?.errors?.conversation_message?.[0];
            });
        },

        optionConversations (action)
        {
            for (let indexConversation of this.bulkConversations) {

                let conversation = this.conversations[indexConversation];

                axios.put (`/transaction/conversation/${conversation.id}`, { action, conversation_room_id: this.room.id, }).then (response => {

                    if (action === 'hide' || action === 'show') {

                        conversation.is_admin_watchable = response.data.original.is_admin_watchable;

                    } else if (action === 'delete') {

                        this.removeConversation (response.data.original);
                    }
                });
            }
        },

        addConversation (item)
        {
            this.conversations.push (item);
            this.scrollConversation ();
        },

        removeConversation (item)
        {
            let indexConversation = this.conversations.findIndex (conversation => conversation.id === item.id);
            this.conversations.splice (indexConversation, 1);
        },

        modeConversation (item)
        {
            let indexConversation = this.conversations.findIndex (conversation => conversation.id === item.id);
            this.conversations[indexConversation].is_admin_watchable = item.is_admin_watchable;
        },

        uploadFile (e)
        {
            const formData = new FormData ();
            formData.append ('file', e.target.files[0]);

            axios.post ('/upload', formData, {

                headers: {

                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json',
                },

            }).then (response => {

                this.fileUpload = response.data.path;
                this.fileExtensionUpload = this.fileUpload.split ('.').pop ();

            }).catch (error => {

                this.newConversation.error_conversation_message = error?.response?.data?.errors?.file?.[0];
            });
        },

        previewFile ()
        {
            window.open (this.fileUpload, '_blank').focus ();
        },

        listenToEventConversation (userId, roomId, customHandler)
        {
            window.Echo.private (`conversation.${userId}.${roomId}`)
            .listen (".conversation.created", (item) => {
                if (customHandler?.created) customHandler.created (item);
                else this.addConversation (item.conversation);
            })
            .listen (".conversation.deleted", (item) => {
                if (customHandler?.deleted) customHandler.deleted (item);
                else this.removeConversation (item.conversation);
            })
            .listen (".conversation.hidden", (item) => {
                if (customHandler?.hidden) customHandler.hidden (item);
                else this.modeConversation (item.conversation);
            })
            .listen (".conversation.shown", (item) => {
                if (customHandler?.shown) customHandler.shown (item);
                else this.modeConversation (item.conversation);
            });
        },
    },

    watch: {

        roomSearch ()
        {
            axios.get (`/transaction/room/${this.roomSearch}`).then (response => {

                this.rooms = response.data.rooms;
            });
        },

        room ()
        {
            if (this.authId === this.room.admin.id) {

                let created = (item) => {

                    if (! item.conversation.is_admin_watchable) return true;

                    this.addConversation (item.conversation);
                    return false;
                },

                hidden = (item) => {

                    this.removeConversation (item.conversation);
                    return false;
                };

                this.listenToEventConversation (this.room.owner.id, this.room.id, { created, hidden, });
                this.listenToEventConversation (this.room.inviter.id, this.room.id, { created, hidden, });

            } else {

                this.listenToEventConversation (this.authId, this.room.id);
                this.listenToEventConversation (this.room.admin.id, this.room.id);
            }
        },
    },

    created ()
    {
        axios.get ('/transaction/room').then (response => {

            this.authId = response.data.authId;
            this.authRole = response.data.authRole;
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
        window.Echo.connector.pusher.connection.bind ('connected', () => {
            console.log ('Connected.');
        });

        window.Echo.connector.pusher.connection.bind ('disconnected', () => {
            console.log ('Disconnected.');
        });
    },
};

</script>

<style>

.attachment-pdf {

    width: 100%;
    height: 100px;
    border: none;
    pointer-events: none;
    overflow: hidden;
}

.attachment-image {

    width: 100%;
    height: 100px;
    object-fit: cover;
    border-radius: .25rem;
}

</style>
