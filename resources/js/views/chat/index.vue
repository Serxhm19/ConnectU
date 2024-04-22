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
              <li class="list-group-item" v-for="message in messages" :key="message.id">
                <div class="chat-body clearfix">
                  <div class="header">
                    <img class="profile-pic-icon" src="\images\connectu.svg" alt="">
                    <strong class="primary-font">
                      <p>{{ message.user.name }}</p>
                    </strong>
                  </div>
                  <div :class="['message', { 'message-user': message.user_id === user.id }]">
                    <div class="text">
                      {{ message.message }}
                    </div>
                  </div>
                </div>
                <div class="date">
                  {{ formatDateToText(message.date) }}
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
    console.log('User:', this.user);
    this.fetchMessages();
    // Llama a fetchMessages() cada 5 segundos
    setInterval(this.fetchMessages, 3000);

  },

  computed: {
    user() {
      const store = useStore();
      const user = store.state.auth.user;
      console.log('User:', user);
      return user;
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
    },

    formatDateToText(date) {
      const messageDate = new Date(date);
      console.log(messageDate);
      const today = new Date();
      const yesterday = new Date(today);
      yesterday.setDate(today.getDate() - 1);

      if (messageDate.toDateString() === today.toDateString()) {
        // Si el mensaje fue enviado hoy, muestra la hora del mensaje en formato UTC
        return messageDate.getUTCHours().toString().padStart(2, '0') + ':' + messageDate.getUTCMinutes().toString().padStart(2, '0');
      } else if (messageDate.toDateString() === yesterday.toDateString()) {
        return 'Yesterday';
      } else {
        // Formatear la fecha en otro formato si no es hoy ni ayer
        const options = { year: 'numeric', month: 'numeric', day: 'numeric' };
        return messageDate.toLocaleDateString(undefined, options);
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

.message {
  color: #444;
  /* width: 50%; */
  max-width: 50%;
  border-radius: 7px;
  display: inline-block;
  position: relative;
  border: 1px solid #000;
  padding: 10px;
  background-color: #b7b7b7;
}

.text {
  font-family: Gotham;
  font-size: 16px;
  display: flex;
}

.message-user {
  margin-left: 95%;
  max-width: 50%;
  width: auto;
  color: #444;
  border-radius: 7px;
  position: relative;
  border: 1px solid #000;
  padding: 10px;
  background-color: #c1f6ff;
  text-align: right;
  /* display: flex; */

}

.profile-pic-icon {
  width: 25px;
  height: 25px;
  border-radius: 50%;
}

.header {
  display: flex;
  flex-direction: row;
}

/* Ajustes para alinear los mensajes del usuario logueado a la derecha */
.text-right {
  text-align: right;
  display: flex;
  flex-direction: row-reverse;
}
</style>
