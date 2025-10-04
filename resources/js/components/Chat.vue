<template>
  <div>
    <div class="messages">
      <div v-for="m in messages" :key="m.id">
        <strong>{{ m.sender.name }}:</strong> {{ m.message }}
      </div>
    </div>
    <form @submit.prevent="sendMessage">
      <input v-model="newMessage" placeholder="Escribe..." />
      <button type="submit">Enviar</button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    conversationId: Number,
    authUser: Object
  },
  data() {
    return {
      messages: [],
      newMessage: ''
    }
  },
  mounted() {
    // Cargar mensajes
    axios.get(`/api/chats/${this.conversationId}/messages`).then(r => {
      this.messages = r.data
    });

    // Escuchar en tiempo real
    Echo.private(`chat.${this.conversationId}`)
        .listen('MessageSent', (e) => {
          this.messages.push(e.message);
        });
  },
  methods: {
    sendMessage() {
      axios.post(`/api/chats/${this.conversationId}/messages`, {
        message: this.newMessage
      }).then(() => this.newMessage = '');
    }
  }
}
</script>
