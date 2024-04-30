<template>
  <div class="chat-container">
    <!-- Chat Header -->
    <div>
      <div class="card chat-header">
        <div class="chat-text">
          {{ selectedEvent ? selectedEvent.eventData.name : 'Chats' }}
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
          <div class="My-Events">
            <div class="card-searcher">
              <!-- <input type="text" v-model="searchTerm" class="form-control" placeholder="Search Events">  -->
            </div>
            <hr>
            <li class="list-group-item" v-for="event in userEventsFiltered" :key="event.event_id"
              @click="selectEvent(event.event_id)">
              <div class="event-name">{{ event.eventData.name }}</div>
              <div>
                <img src="\images\eventoPrueba.webp" class="chat-pic" alt="Profile Picture">
                <!-- Mostrar el último mensaje -->
                <div v-if="lastMessage">
                  <p class="last-message">
                  <p class>{{ lastMessage.user_id === user.id ? 'You:' : lastMessage.user.name + ": " }}</p>{{
            lastMessage.message }}</p>
                </div>
              </div>
              <hr>
            </li>
          </div>
        </div>
      </div>
      <!-- Chat Body -->
      <div class="col-lg-8">
        <div class="chat">
          <!-- Card de Mensajes -->
          <div class="card chat-body">
            <ul class="list-group list-group-flush chat">
              <li class="list-group" v-for="message in reversedMessages" :key="message.id">
                <div class="chat clearfix">
                  <div class="header">
                    <img v-if="message.user_id !== user.id" class="profile-pic-icon" src="\images\connectu.svg" alt="">
                    <strong v-if="message.user_id !== user.id" class="primary-font d-flex align-items-center">
                      <p class="username-header">{{ message.user.name }}</p>
                    </strong>
                    <div :class="['date', { 'date-right': message.user_id === user.id }]">
                      {{ formatDateToText(message.date) }}
                    </div>
                  </div>
                  <div :class="['message', { 'text-right': message.user_id === user.id }]">
                    <div class="text">
                      {{ message.message }}
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <!-- Chat Footer -->
          <div class="card chat-footer">
            <div class="input">
              <input type="text" v-model="newMessage" @keyup.enter="sendMessage" class="form-control message-input"
                placeholder="Send your message">
              <button @click="sendMessage" class="btn btn-primary"><i class="pi pi-send"></i></button>
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
      newMessage: '',
      userEvents: [],
      selectedEvent: null,
      lastMessage: null,
    }
  },

  mounted() {
    console.log('User:', this.user);
    setInterval(this.fetchMessages, 3000);
    this.fetchUserEvents();

  },

  computed: {
    user() {
      const store = useStore();
      const user = store.state.auth.user;
      console.log('User:', user);
      return user;
    },

    reversedMessages() {
      return this.messages.slice().reverse();
    },

    userEventsFiltered() {
      return this.userEvents.filter(event => event.user_id === this.user.id);
    }
  },
  methods: {
    fetchMessages() {
      axios.get('/api/messages')
        .then(response => {
          this.messages = response.data.filter(message => message.group_id === this.selectedEvent.id);
        })
        .catch(error => {
          console.error('Error fetching messages:', error);
        });
    },

    sendMessage() {
      if (this.newMessage.trim()) {
        axios.post(`/api/send-message/${this.selectedEvent.id}`, {
          message: this.newMessage,
        })
          .then(response => {
            console.log('Message sent successfully:', response.data);
            if (this.selectedEvent) {
              this.fetchMessages(this.selectedEvent.id);
            }
            this.newMessage = '';
          })
          .catch(error => {
            console.error('Error sending message:', error);
          });
      }
    },



    formatDateToText(date) {
      const messageDate = new Date(date);
      const today = new Date();
      const yesterday = new Date(today);
      yesterday.setDate(today.getDate() - 1);

      if (messageDate.toDateString() === today.toDateString()) {
        return messageDate.getUTCHours().toString().padStart(2, '0') + ':' + messageDate.getUTCMinutes().toString().padStart(2, '0');
      } else if (messageDate.toDateString() === yesterday.toDateString()) {
        return 'Yesterday';
      } else {
        const options = { year: 'numeric', month: 'numeric', day: 'numeric' };
        return messageDate.toLocaleDateString(undefined, options);
      }
    },

    fetchUserEvents() {
      axios.get(`/api/userEvent`)
        .then(response => {
          this.userEvents = response.data;
          this.userEvents.forEach(event => {
            axios.get(`/api/events/show/${event.event_id}`)
              .then(eventResponse => {
                console.log('Datos del evento:', eventResponse.data);
                event.eventData = eventResponse.data;
              })
              .catch(error => {
                console.error('Error fetching event data:', error);
              });
          });
        })
        .catch(error => {
          console.error('Error fetching user events:', error);
        });
    },
    selectEvent(eventId) {
      this.selectedEvent = this.userEvents.find(event => event.id === eventId);
      this.fetchMessages(eventId); // Asegúrate de pasar el eventId aquí
      console.log('Selected event:', this.selectedEvent);
    },



  }
}

</script>

<style scoped>
body {
  background-color: #f4f7f6;
  margin-top: 20px;
}

.list-group-item {
  position: relative;
  display: block;
  padding: var(--bs-list-group-item-padding-y) var(--bs-list-group-item-padding-x);
  color: var(--bs-list-group-color);
  text-decoration: none;
  background-color: var(--bs-list-group-bg);
  margin: 10px;
  /* border: var(--bs-list-group-border-width) solid var(--bs-list-group-border-color); */
}

.card {
  background: #fff;
  transition: .5s;
  border: 0;
  margin-bottom: 30px;
  border-radius: .55rem;
  position: relative;
  width: 100%;
  box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
}

.chat-container {
  display: flex;
  flex-direction: column;
  height: 500px;
}

.chat-header {
  background-color: rgb(255, 255, 255);
  margin-top: 10px;
  margin-bottom: 10px;

}

.chat-text {
  font-family: Gotham;
  font-size: 22px;
  font-weight: bold;
}

.chat-footer {
  background-color: #f1f1f1;
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: -50px;
  border-radius: 0 0 10px 10px;
  border: 1px solid #000000;
}

.chat-footer input {
  flex: 1;
  padding: 5px;
  margin-right: 10px;
  width: 1000px;
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
  color: #000000;
  max-width: 50%;
  border-radius: 30px;
  display: inline-block;
  position: relative;
  padding: 10px;
  background-color: #dadada;
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
}

.profile-pic-icon {
  width: 25px;
  height: 25px;
  border-radius: 50%;
}

.header {
  display: flex;
  flex-direction: row;
  margin-bottom: 10px;
  display: flex;
  flex-direction: row;
  margin-bottom: 10px;
  margin-top: 25px;

}

.text-right {
  text-align: right;
  display: flex;
  flex-direction: row-reverse;
  margin-left: auto;
  width: auto;
  max-width: fit-content;
  background-color: #6cb4ee;
  font-family: Gotham;
  font-size: 14px;
}

.date {
  margin-bottom: 10px;
  margin-top: 2px;
  margin-right: 3px;
  margin-left: 10px;
}

.date-right {
  text-align: right;
  display: flex;
  flex-direction: row-reverse;
  margin-left: auto;
  margin-bottom: -5px;
  margin-right: 5px;
}

.chat-body {
  height: 650px;
  overflow-y: auto;
  overscroll-behavior: contain;
  border: 1px solid #000;
}

.input {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  margin-top: 10px;
  margin: auto;
  align-items: end;
}

.message-input {
  width: 970px;
}

.chat-name {
  height: 60px;
  margin-bottom: 10px;
}

.username-header {
  margin-left: 10px;
  margin-bottom: 10px;
}

.Title {
  font-family: Gotham;
  font-size: 26px;
  color: #0070bb;
  text-align: center;
}

.form-control {
  border-radius: 20px;
  width: 100%;
  border: 1px solid #000;
  height: 35px;
  font-family: Gotham;
}


.events-list {
  height: 685px;
  overscroll-behavior: contain;
}

hr {
  border-top: solid #000000;
  border-width: 1px 0 0 0;
  margin: 1rem 0;
}

.col-lg-8 {
  flex: 0 0 auto;
  width: 66.66666667%;
  padding-left: revert-layer;
}

.chat-pic {
  width: 50px;
  height: 50px;
  border-radius: 50%;

}

.event-name {
  font-family: Gotham;
  font-size: 18px;
  font-weight: bold;
  text-align: center;
  color: #0070bb;

}
</style>
