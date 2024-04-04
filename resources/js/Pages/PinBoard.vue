<script setup lang="ts">
import { ref, computed } from 'vue';
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from 'axios';

/* import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card' */

const authId = ref(1); // Sample value for authId, replace it with your actual value
const editedMessage = ref(null);
const newLocal = false;
/* const isEditing = ref(newLocal); */
const editMode = ref(null);
const messages = ref<Message[]>([]);


interface Message {
  id: number;
    user_id: number;
    user_name: string; // Add user's name property
    title: string;
    leadtext: string;
    message: string;
    created_at: string;
}

// Fetch messages from the backend API
const fetchMessages = async () => {
  try {
    const response = await axios.get('/messages', {
      params: {
        user_id: authId.value
      }
    });
    messages.value = response.data;
  } catch (error) {
    console.error('Error fetching messages:', error);
  }
};

// Call the fetchMessages function when the component is mounted
fetchMessages();

// Function to format the created_at date
const formatCreatedAt = (createdAt) => {
  const date = new Date(createdAt);
  return date.toLocaleString();
};

// Function to delete a message
const deleteMessage = async (id) => {
  try {
    await axios.delete(`/messages/${id}`);
    messages.value = messages.value.filter(message => message.id !== id);
  } catch (error) {
    console.error('Error deleting message:', error);
  }
};

// Function to update a message
const updateMessage = async (updatedMessage:any) => {
  try {
    const response = await axios.put(`/messages/${updatedMessage.id}`, updatedMessage);
    const updatedMessageIndex = messages.value.findIndex(message => message.id === updatedMessage.id);
    if (updatedMessageIndex !== -1) {
      // Update the message in the local state with the updated message from the server response
      messages.value.splice(updatedMessageIndex, 1, response.data);
    }
    cancelEdit();
  } catch (error) {
    console.error('Error updating message:', error);
  }
};

// Function to cancel editing
const cancelEdit = () => {
  editedMessage.value = null;
  editMode.value = null;
};

// Function to check if a message is the updated message
const isUpdatedMessage = (message) => {
  return message.message.startsWith("Message updated successfully.");
};

// Filter out "message updated successfully" or error messages
const filteredMessages = computed(() => {
  return messages.value.filter(message => !isUpdatedMessage(message));
});
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

      <div class="container min-h-screen flex justify-center items-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Row 1 -->
          <div class="p-4 md:col-span-2 p-20">
            <h1 class="text-center mb-4"><strong>Pinboard-Messages</strong></h1>

            <!-- Render messages -->
            
              <div v-for="message in filteredMessages" :key="message.id">
              <!-- Render cards for messages from the logged-in user -->
              <div v-if="message.user_id === authId" class="bg-blue-200 p-4 mb-4 rounded-md -ml-60 animate__animated animate__fadeInLeft">
                <p><!-- User ID: {{ message.user_id }}  -->- 
                {{ message.title }} {{ message.leadtext }}</p>
                <!-- <p>Email: {{ message.email }}</p> -->
                <template v-if="!editMode || editMode !== message.id">
                  <p>Message: "{{ message.message }}"</p> 
                  <p>Created At: {{ formatCreatedAt(message.created_at) }}</p>
                  <button @click="editMode = message.id" class="text-white bg-yellow-500 px-2 py-1 rounded-md mr-2">Edit</button>
                  <button @click="deleteMessage(message.id)" class="text-white bg-red-500 px-2 py-1 rounded-md mt-2">Delete</button>
                </template>
                <template v-else>
                  <textarea v-model="message.message" class="w-full border-gray-300 rounded-md p-2"></textarea>
                  <button @click="updateMessage(message)" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update</button>
                  <button @click="cancelEdit" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">Cancel</button>
                </template>
              </div>
              <!-- Render cards for other messages -->
              <div v-else class="bg-gray-200 p-4 mb-4 rounded-md -mr-60 animate__animated animate__fadeInRight">
                <p>
                {{ message.title }} {{ message.leadtext }}</p>
            
                <p>Message: "{{ message.message }}"</p>
                <p>Created At: {{ formatCreatedAt(message.created_at) }}</p>
              </div>
            </div>
         
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </div>
</template>



