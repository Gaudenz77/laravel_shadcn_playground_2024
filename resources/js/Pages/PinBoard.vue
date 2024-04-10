<script setup lang="ts">
import { ref, onMounted, defineProps } from 'vue';
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from 'axios';

const props = defineProps({
  authId: Number, // Define the prop type as Number
});

const authId = ref(props.authId); // Initialize with the received authId
const editMode = ref<number | null>(null);
const messages = ref<Message[]>([]);

// Variable to store the original message content during editing
const originalMessageContent = ref('');

interface Message {
  id: number;
  user_id: number;
  user_name: string;
  title: string;
  leadtext: string;
  image: string;
  message: string;
  created_at: string;
}

onMounted(async () => {
  try {
    // Fetch messages
    const response = await axios.get('/messages');
    messages.value = response.data;
  } catch (error) {
    console.error('Error fetching messages:', error);
  }
});

const formatCreatedAt = (createdAt: any) => {
  const date = new Date(createdAt);
  return date.toLocaleString();
};

const deleteMessage = async (id: any) => {
  try {
    await axios.delete(`/messages/${id}`);
    messages.value = messages.value.filter(message => message.id !== id);
  } catch (error) {
    console.error('Error deleting message:', error);
  }
};

const updateMessage = async (updatedMessage: any) => {
  try {
    const response = await axios.put(`/messages/${updatedMessage.id}`, updatedMessage);
    const updatedMessageIndex = messages.value.findIndex(message => message.id === updatedMessage.id);
    if (updatedMessageIndex !== -1) {
      messages.value.splice(updatedMessageIndex, 1, response.data);
      // Update originalMessageContent if the updated message is the one being edited
      if (editMode.value === updatedMessage.id) {
        originalMessageContent.value = response.data.message;
      }
    }
    cancelEdit();
  } catch (error) {
    console.error('Error updating message:', error);
  }
};


const cancelEdit = () => {
  editMode.value = null;
};

// Function to handle "Edit" button click
const handleEdit = (message: Message) => {
  // Store the original message content
  originalMessageContent.value = message.message;
  // Set edit mode
  editMode.value = message.id;
};

</script>

<template>
  <div>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Dashboard
        </h2>
      </template>

     <!--  <div class="container min-h-screen flex justify-center items-center">
        <div class="p-4 md:col-span-1">
          <h1 class="text-center mb-4"><strong>All Messages</strong></h1>

          <div v-for="message in messages" :key="message.id">
            <div :class="{ 'bg-emerald-300 dark:bg-pink-800': message.user_id === authId, 'bg-orange-300 dark:bg-cyan-800': message.user_id !== authId }" class="p-4 mb-4 rounded-md animate__animated animate__fadeInLeft">              <p>
                <h1 class="text-4xl font-bold">{{ message.title }}</h1>
                <h3 class="text-xl italic">{{ message.leadtext }}</h3>
               User_Id: {{ message.user_id }}</p>
              <img v-if="message.image" :src="'/storage/' + message.image" alt="Message Image" class="my-4 rounded-lg"> -->
              <!-- Display original message content if not in edit mode -->
              <!-- <p v-if="!editMode || editMode !== message.id">{{ originalMessageContent || message.message }}</p> -->
              <!-- Display editable textarea in edit mode -->
              <!-- <textarea v-model="message.message" v-else class="w-full border-gray-300 text-slate-800 rounded-md p-2"></textarea>
              <a :href="'/singlestory/' + message.id" class="read-more-link">Read more</a> -->

              <!-- Show edit and delete buttons if message is created by the currently authenticated user -->
              <!-- <template v-if="message.user_id === authId">
                <template v-if="!editMode || editMode !== message.id">
                  <p>Created At: {{ formatCreatedAt(message.created_at) }}</p>
                  <button @click="handleEdit(message)" class="text-white bg-yellow-500 px-2 py-1 rounded-md mr-2">Edit</button>
                  <button @click="deleteMessage(message.id)" class="text-white bg-red-500 px-2 py-1 rounded-md mt-2">Delete</button>
                </template>
                <template v-else>
                  <button @click="updateMessage(message)" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update</button>
                  <button @click="cancelEdit" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">Cancel</button>
                </template>
              </template>
            </div>
          </div>
        </div>
      </div> -->



      <div class="container min-h-screen grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 justify-center my-12">
        <div v-for="message in messages" :key="message.id">
          <a href="#" class="group relative block aspect-w-4 aspect-h-5"   style="height:auto;">
            <span class="absolute inset-0 border-2 border-dashed border-black"></span>
            <div class="relative flex flex-col h-full border-2 border-black bg-white transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2">
              <div class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-10 sm:size-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="mt-4 text-xl font-medium sm:text-2xl"> 
                  
                  <h1 class="text-4xl font-bold">{{ message.title }}</h1>
                </h2>
                <div>
                  <img v-if="message.image" :src="'/storage/' + message.image" alt="Message Image" class="fluid my-4 rounded-lg">
                </div>
              </div>
              <div class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8">
                <h3 class="mt-4 text-xl font-medium sm:text-2xl">{{ message.title }}</h3>
                <p class="mt-4 text-sm sm:text-base">
                  <h3 class="text-xl italic">{{ message.leadtext }}</h3>
                </p>
                <p class="mt-8 font-bold"><a :href="'/singlestory/' + message.id" class="read-more-link">Read more</a></p>
              </div>
            </div>
          </a>
        </div>
      </div>

      
      
      


    </AuthenticatedLayout>
  </div>
</template>
