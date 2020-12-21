<template>
  <div>
    <div
      class="flex flex-col overflow-y-auto px-3 scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2"
      id="msgContainer"
    >
      <div
        class="grid-cols-12"
        v-for="(item, index) in allMessages"
        :key="index"
      >
        <div :class="setClass(item.user.id)">
          <div class="text-sm block">{{ item.message }}</div>
          <div class="block">
            <span class="text-xs text-gray-500"
              ><small>{{ item.user.name }} - </small>
              <small>{{ item.created_at }}</small>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="grid-cols-12 p-3 mt-5">
      <input
        type="text"
        v-model="message"
        class="w-full rounded border-solid border border-black h-8 px-2"
      />
    </div>
    <div class="grid-cols-12 px-3">
      <button
        @click="sendMessage"
        class="bg-blue-500 text-white px-5 py-1 rounded"
      >
        Send
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      message: null,
      allMessages: [],
    };
  },
  methods: {
    sendMessage() {
      if (this.message) {
        axios
          .post("/messages", {
            message: this.message,
          })
          .then((result) => {
            this.message = null;
            console.log(result);
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },

    setClass(userId) {
      if (userId == this.user.id) {
        return "w-2/5 bg-gray-200 rounded-md p-2 mb-3 float-right";
      }
      return "w-2/5 bg-blue-200 rounded-md p-2 mb-3 float-left";
    },

    fetchMessages() {
      axios.get("/messages").then((response) => {
        this.allMessages = response.data;
      });
    },
  },

  created() {
    this.fetchMessages();
    Echo.private("chat").listen("MessageSent", (e) => {
      this.allMessages.push(e.message);
    });
  },
};
</script>

<style>
#msgContainer {
  height: 540px;
}

.scrollbar-w-2::-webkit-scrollbar {
  width: 0.25rem;
  height: 0.25rem;
}

.scrollbar-track-blue-lighter::-webkit-scrollbar-track {
  --bg-opacity: 1;
  background-color: #f7fafc;
  background-color: rgba(247, 250, 252, var(--bg-opacity));
}

.scrollbar-thumb-blue::-webkit-scrollbar-thumb {
  --bg-opacity: 1;
  background-color: #edf2f7;
  background-color: rgba(237, 242, 247, var(--bg-opacity));
}

.scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
  border-radius: 0.25rem;
}
</style>