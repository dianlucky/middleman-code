@extends('layouts.userMain')

@section('content')
    <!-- Blog Start -->
    <div class="container py-4">
        <div class="row">
            <!-- Chatroom Start -->
            <div class="col-lg-12">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="bg-secondary" style="padding: 20px; height: 550px;" id="chat-container">
                        <div class="row border-bottom">
                            <div class="col-4 d-flex align-items-center">
                                <h5 class="font-weight-bold mb-3">Transaction</h5>
                            </div>
                            <div class="col-8 d-flex justify-item-center">
                                <h5 class="font-weight-bold mb-3">{{ $room_name }}</h5>
                            </div>
                        </div>

                        <div id="chat-box">
                            @foreach ($messages as $message)
                                <div class="message">
                                    <span class="user">{{ $message->user->name }} ({{ $message->role }}):</span>
                                    <span class="text">{{ $message->message }}</span>
                                    <div class="time">{{ $message->created_at->format('H:i') }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex align-items-end" style="position: absolute; left: 20px; bottom: 80px; width: 95%;">
                            <div class="input-group">
                                <form id="message-form">
                                    @csrf
                                    <input type="hidden" value={{ $room_id }} id="room_id">
                                    <input type="hidden" name="role" value={{ $role }}>
                                    <input type="text" id="message-input" class="form-control border-1 ml-4 rounded-pill"
                                        placeholder="Ketik pesan...">
                                    <div class="input-group-append">
                                        <button
                                            class="input-group-text rounded-circle bg-primary border-primary text-white"><i
                                                class="fa fa-paper-plane"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Form End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->
    <script src="{{ mix('../js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBox = document.getElementById('chat-box');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');
            const roomId = document.getElementById('room_id').value;
            // console.log(roomId);
            // Listen to the private channel
            Echo.private(`chat.${roomId}`)
                .listen('MessageCreated', (e) => {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message');
                    
                    const userElement = document.createElement('span');
                    userElement.classList.add('user');
                    userElement.textContent = `${e.user.name} (${e.user.role}): `;

                    const textElement = document.createElement('span');
                    textElement.classList.add('text');
                    textElement.textContent = e.message;

                    const timeElement = document.createElement('div');
                    timeElement.classList.add('time');
                    timeElement.textContent = new Date(e.created_at).toLocaleTimeString();

                    messageElement.appendChild(userElement);
                    messageElement.appendChild(textElement);
                    messageElement.appendChild(timeElement);

                    chatBox.appendChild(messageElement);
                    chatBox.scrollTop = chatBox.scrollHeight;
                });

            // Handle form submission
            messageForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const message = messageInput.value;

                fetch('/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        room_id: roomId,
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'Message Sent!'){
                        messageInput.value = '';
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
