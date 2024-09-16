<template>
    <div>
        <div id="messages" style="height: 300px; overflow-y: scroll;">
            <div v-for="message in messages" :key="message.id">
                <strong>{{ message.user.name }}:</strong> {{ message.message }}
            </div>
        </div>
        <form @submit.prevent="sendMessage">
            <div class="input-group">
                <input type="text" v-model="newMessage" class="form-control" placeholder="Type a message...">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            newMessage: '',
        };
    },
    mounted() {
        this.fetchMessages();

        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.message.user
                });
            });
    },
    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },
        sendMessage() {
            axios.post('/messages', {
                message: this.newMessage
            }).then(response => {
                this.newMessage = '';
            });
        }
    }
}
</script>
