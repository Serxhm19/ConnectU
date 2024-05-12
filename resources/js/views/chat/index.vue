<template>
  <div class="row chat-container container-fluid">
    <!-- Chat Header -->
    <div class="col-12 card chat-header">
      <button @click="toggleEventList" class="toggle-button btn btn-primary mb-4" >CHATS</button>
      <div class="chat-text" :class="{ 'hide-chat': !showChat }">
        <template v-if="selectedEvent && selectedEvent.id">
          <router-link :to="{ name: 'publi-event.event', params: { id: selectedEvent.id } }">
            {{ selectedEvent.eventData.name }}
          </router-link>
        </template>
      </div>
      <div class="user-profile">
        <div class="profile-pic">
          <img src="\images\connectu.svg" class="profile-pic" alt="Profile Picture">
        </div>
        <div>
          <h2 class="user-nickname">
            {{ user.name }} {{ user.surname }}
          </h2>
        </div>
      </div>
    </div>

    <!-- Chat Body -->
    <div class="col-12 row">
      <!-- Columna Izquierda -->
      <div class="col-xs-12 col-sm-4">
        <div class="card events-list" :class="{ 'hide-event-list': !showEventList }">
          <div class="My-Events" >
            <h2 class="buscarEvento">Buscar Evento</h2>
            <input type="text" v-model="searchQuery" placeholder="Search events..." class="inputSearch">
            <hr>
            <ul class="list-group list-group-flush">
              <li v-for="event in filteredEvents" :key="event.event_id" @click="selectEvent(event.event_id)" class="list-group-item EventsButton">
                <button @click="toggleEventList" class="toggle-button">
                  <div class="events">
                    <img src="\images\eventoPrueba.webp" class="chat-pic" alt="Profile Picture">
                    <div class="event-name">{{ event.eventData ? event.eventData.name : 'Cargando...' }}</div>
                  </div>
                </button>
              </li>
            </ul>
            <hr>
          </div>
        </div>
      </div>
      <!-- Chat Body -->
      <div class="col-xs-12 col-sm-8">
        <div class="chat" :class="{ 'hide-chat': !showChat }">
          <!-- Card de Mensajes -->
          <div class="card chat-body">
            <ul class="list-group list-group-flush chat">
              <li v-if="!selectedEvent" class="list-group-item no-event-selected">
                <img src="/Images/ChatIcon.svg" class="no-event-img" alt="Chat Icon">
                <p class="no-event-text">Select an event to start chatting!</p>
              </li>
              <li v-else v-for="message in reversedMessages" :key="message.id" class="list-group-item">
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
            <div class="input d-flex">
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
      searchQuery: '',
      showEventList: true,
      showChat: false
    } 
  },


  mounted() {
    
    setInterval(this.fetchMessages, 3000);
    this.fetchUserEvents();

    document.title = 'ConnectU - Chats';
    const favicon = document.createElement('link');
    favicon.rel = 'icon';
    favicon.href = '/images/favicon-32x32.png';
    document.head.appendChild(favicon);
  },
  computed: {
  user() {
    const store = useStore();
    const user = store.state.auth.user;
    return user;
  },
  toggleEventList() {
    this.showEventList = !this.showEventList;
    this.showChat = !this.showEventChat;
  },
  reversedMessages() {
    return this.messages.slice().reverse();
  },

  userEventsFiltered() {
    return this.userEvents.filter(event => event.user_id === this.user.id);
  },

  filteredEvents() {
    if (!this.searchQuery.trim()) {
      return this.userEventsFiltered;
    } else {
      return this.userEventsFiltered.filter(event => {
        return event.eventData.name.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  }
},



  methods: {
    fetchMessages() {
      if (!this.selectedEvent) {
        return;
      }

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
                event.eventData = eventResponse.data;
                event.id = event.event_id;
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
      console.log('Selected event ID:', eventId);
      this.selectedEvent = this.userEvents.find(event => event.id === eventId);
      console.log('Selected event:', this.selectedEvent);
      this.fetchMessages(eventId);
    }
  }
}

</script>

<style scoped>
body {
  background-color: #f4f7f6;
  margin-top: 20px;
}

.EventsButton {
  position: relative;
  display: block;
  padding: var(--bs-list-group-item-padding-y) var(--bs-list-group-item-padding-x);
  color: var(--bs-list-group-color);
  text-decoration: none;
  background-color: var(--bs-list-group-bg);
  margin: 10px;
  border: none;
  cursor: pointer;
}

.list-group-item {
  position: relative;
  display: block;
  padding: var(--bs-list-group-item-padding-y) var(--bs-list-group-item-padding-x);
  color: var(--bs-list-group-color);
  text-decoration: none;
  background-color: var(--bs-list-group-bg);
  margin: 10px;
  border: none;
}

.EventsButton:hover {
  background-color: #f0f0f0;
  /* Cambia el color de fondo */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  /* Añade una sombra suave */
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
  flex-direction: row;
  height: 500px;
}

.chat-header{
    background-color: rgb(255, 255, 255);
    margin-top: 90px;
    margin-bottom: 10px;
    display: flex;
    flex-direction: row-reverse;
    align-content: center;
    justify-content: space-between;
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
  font-family: Gotham;
  font-size: 22px;
  color: #01afee;
  text-decoration: dashed;
}

.user-profile {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: flex-start;
  align-content: space-around;
  align-items: center;
}

.profile-pic {
  width: 35px;
  height: 35px;
  border-radius: 50%;
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
  scroll-behavior: smooth;
  scroll-padding-bottom: 50px;
  display: flex;
  flex-direction: column-reverse;
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
  overflow-y: auto;
  overscroll-behavior: contain;
}

hr {
  margin: none;
  height: 2px;
  border: none;
  background-color: #000;
}

.hr-events {
  height: 1px;
  border: none;
  background-color: #000;
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
  margin: 10px
}

.event-name {
  font-family: Gotham;
  font-size: 18px;
  font-weight: bold;
  color: #0070bb;
}

.no-event-img {
  width: 400px;
  height: 400px;
  margin-left: 275px;
  margin-bottom: 50px;
}

p.no-event-text {
  font-family: Gotham;
  font-size: 33px;
  color: #0070bb;
  font-weight: bolder;
  display: flex;
  flex-wrap: nowrap;
  flex-direction: row;
  justify-content: center;
  margin-bottom: 20px;
}

.events {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  align-content: center;
  justify-content: flex-start;
  align-items: center;
}

a {
  font-family: Gotham;
  font-size: 20px;
  font-weight: bold;
  color: #01afee;
}

a:hover {
  font-family: Gotham;
  font-size: 20px;
  font-weight: bold;
  color: #0070bb;
  text-decoration: dashed;
}

h2.buscarEvento {
    font-family: Gotham;
    font-size: 22px;
    color: #0070bb;
}
.toggle-button{
    display: none;
  }
@media (max-width: 500px) {
  .toggle-button{
    background-color: #fff;
    border-color: #0070BB;
    color: #0070BB;
    width: 100%;
  }

  .toggle-button:hover{
    background-color: #0070BB;
    border-color: #0070BB;
    color: #fff;
  }
  .chat-container {
    width: 450px;
  }
  .chat-body{
    width: 100%;
  }
  .no-event-img{
    margin: 0;
    width: 100%;
  }
  .chat-footer input {
    flex: 1;
    margin-right: 10px;
    width: 200px;
  }

  .chat-header{
    width: 95%;
    display: flex;
    flex-direction: column;
  }
  
  .chat-text a{
    width: 100%;
    text-align: center;
  }
  .user-profile{
    display: none;
  }
  .hide-event-list {
    display: none;
  }

  .hide-chat {
    display: none;
  }
}
.profile-pic-small img {
  width: 30px;
  height: 30px;
}

.inputSearch {
    width: 100%;
    border-radius: 30px;
    border: 1px solid black;
    height: 30px;
    padding: 10px;
    font-family: Gotham;
}
</style>
