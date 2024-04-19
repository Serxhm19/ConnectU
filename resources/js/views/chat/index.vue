<template>
  <div class="chat-container">
    <!-- Chat Header -->
    <div>
      <div class="card chat-header">
        <div class="chat-text">
          Chats
        </div>
        <div class="user-profile">
          <div class="profile-pic">
            <img src="\images\logo.png" class="profile-pic" alt="Profile Picture">
          </div>
          <div>
            <h2 class="user-nickname">
              {{ user.name }} {{ user.surname }}
            </h2>
          </div>
        </div>
      </div>
    </div>

    <!-- Chat Body -->
    <div class="row">
      <!-- Columna Izquierda -->
      <div class="col-lg-4">
        <!-- Card de Usuario -->
        <div class="card events-list">
          <div class="card-header">
            <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Events">
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="user in filteredUsers" :key="user.id">{{ user.name }}</li>
            
            </ul>
        </div>
      </div>


      <!-- Chat Body -->
      <div class="col-lg-8">
        <div class="chat-body">
          <!-- Card de Mensajes -->
          <div class="card">
            <ul class="list-group list-group-flush chat">
              <li class="list-group-item left clearfix" v-for="message in messages">
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

          <!-- Chat Footer -->
          <div class="card chat-footer">
            <div class="card-body">
              <input type="text" v-model="newMessage" @keyup.enter="sendMessage" class="form-control">
              <button @click="sendMessage" class="btn btn-primary">Send</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useStore } from 'vuex';
import axios from 'axios';
import { ref, inject, onMounted, computed } from "vue"

export default {
  data() {
    return {
      messages: [],
      newMessage: ''
    }
  },

  mounted() {
    this.fetchMessages();
    // Llama a fetchMessages() cada 5 segundos
    setInterval(this.fetchMessages, 1000);
  },

  computed: {
    user() {
      const store = useStore();
      return store.state.auth.user;
    }
  },

  methods: {
    fetchMessages() {
      axios.get('/api/messages')
        .then(response => {
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
            // Restablece el campo de nuevo mensaje después de enviar el mensaje
            this.newMessage = '';
          })
          .catch(error => {
            console.error('Error sending message:', error);
          });
      }
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
  background-color: aliceblue;
  margin-top: 10px;
  margin-bottom: 10px;
}


.chat-text {
  font-family: Gotham;
  font-size: 22px;
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

.chat-text {
  display: flex;
  flex-direction: row;
  align-content: center;
  flex-wrap: wrap;
  justify-content: flex-end;
  align-items: center;
}

.user-profile {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: flex-start;
  align-content: space-around;
  align-items: center;
  margin-top: -35px;
}

.profile-pic {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  border: 1px solid #000;

}

.user-nickname {
  font-family: Gotham;
  font-size: 18px;
  margin: 10px;
}
</style>
