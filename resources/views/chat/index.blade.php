<x-app-layout>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chat Room</div>

                    <div class="card-body">
                        <div id="messages" style="height: 300px; overflow-y: scroll;">
                            @foreach($messages as $message)
                                <div class="message {{ $message->user_id === auth()->id() ? 'own-message' : 'other-message' }}" style="@if ($message->user_id === auth()->id())
  text-align: right;
  padding-right: 6px;
                                @endif">
                                    <strong class="user-name" style="">{{ $message->user->name }}:</strong>
                                    {{ $message->message }}
                                </div>
                            @endforeach
                        </div>
                        <form id="chat-form">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="message" class="form-control  border border-2" placeholder="Type a message...">
                            </div><div class="input-group pt-2">
                                <button type="submit" class="btn btn-primary" style="">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        function fetchMessages() {
            axios.get('{{ route('chat.fetchMessages') }}')
                .then(response => {
                    const messagesElement = document.getElementById('messages');
                    messagesElement.innerHTML = '';
                    response.data.forEach(message => {
                        const messageElement = document.createElement('div');
                        messageElement.innerHTML = `<strong>${message.user.name}:</strong> ${message.message}`;
                        messagesElement.appendChild(messageElement);
                    });
                })
                .catch(error => {
                    console.error('Error fetching messages:', error);
                });
        }


        // Refresh messages every second
        setInterval(fetchMessages, 1000);

        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const messageInput = this.querySelector('input[name="message"]');
            axios.post('{{ route('chat.store') }}', {
                message: messageInput.value
            }).then(response => {
                messageInput.value = '';
                fetchMessages();
            });
        });
    </script>
</x-app-layout>
