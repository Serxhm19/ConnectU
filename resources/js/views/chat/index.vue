<template>
  <div class="row chat-container container-fluid">
    <!-- Chat Header -->
    <div class="col-12 card chat-header">
      <button @click="toggleEventList" class="toggle-button btn btn-primary mb-4" :class="{ 'hide-chat': !showChat }">CHATS</button>
      <div class="chat-text" :class="{ 'hide-chat': !showChat }">
        <template v-if="selectedEvent && selectedEvent.id">
          <router-link :to="{ name: 'publi-event.event', params: { id: selectedEvent.id } }">
            {{ selectedEvent.eventData.name }}
          </router-link>
        </template>
      </div>
      <div class="user-profile" :class="{ 'hide-event-list': !showEventList }">
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
              <li v-for="event in filteredEvents" :key="event.event_id" @click="selectEvent(event.event_id), toggleEventList" class="list-group-item EventsButton">
                  <div class="events">
                    <img src="\images\eventoPrueba.webp" class="chat-pic" alt="Profile Picture">
                    <div class="event-name">{{ event.eventData ? event.eventData.name : 'Cargando...' }}</div>
                  </div>
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
    this.showChat = !this.showChat;
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

<style scoped lang="scss">
@import "../../../sass/chat.scss";



</style>
