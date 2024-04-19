<template>
    <div class="chat-container">
      <div class="chat-header">
        Chats
      </div>
      <div class="chat-body">
        <ul class="chat">
          <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
              <div class="header">
                <strong class="primary-font">
                    <p>{{ message.id }}</p>
                  
                </strong>
              </div>
              <div class="message">
                {{ message.message }}
              </div>
              <div class="date">
                {{ message.date }} <!-- Display the date here -->
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="chat-footer">
        <input type="text" v-model="newMessage" @keyup.enter="sendMessage">
        <button @click="sendMessage">Send</button>
      </div>
    </div>
  </template>

<script>
export default {

    data() {
        return {
            messages: [],
            newMessage: ''
        }
    },

    mounted() {
        this.fetchMessages();
          console.log('Messages:', this.messages); // Log the messages array

    },

    methods: {
        fetchMessages() {
            axios.get('/api/messages')
                .then(response => {
                    console.log('Response:', response.data); // Add this line
                    this.messages = response.data.filter(message => message.group_id === 1);
                })
                .catch(error => {
                    console.error('Error fetching messages:', error);
                });
        },


        sendMessage() {
            if (this.newMessage.trim()) {
                axios.post('/api/send-message', {
                    message: this.newMessage
                })
                    .then(response => {
                        console.log('Message sent successfully:', response.data);
                        // Actualiza la lista de mensajes después de enviar el mensaje
                        this.fetchMessages();
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);
                    });
            }

            this.newMessage = '';
        }
    }
}
</script>

<style scoped>
.chat-container {
    display: flex;
    flex-direction: column;
    height: 500px;
}

.chat-header {
    background-color: #f1f1f1;
    padding: 10px;
    font-weight: bold;
}

.chat-body {
    flex: 1;
    overflow-y: scroll;
    padding: 10px;
}

.chat-footer {
    background-color: #f1f1f1;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-footer input {
    flex: 1;
    padding: 5px;
    margin-right: 10px;
}
</style>