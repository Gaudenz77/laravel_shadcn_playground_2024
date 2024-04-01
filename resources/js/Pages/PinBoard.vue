<script setup lang="ts">
import { ref, onMounted, defineProps } from 'vue';
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from 'axios';

const { authId } = defineProps(['authId']); // Import authId from props

// Define a reactive variable to store the messages
interface Message {
  id: number;
  user_id: number;
  first_name: string;
  last_name: string;
  email: string;
  message: string;
}

const messages: Array<Message> = ref([]);

// Fetch messages from the backend API
const fetchMessages = async () => {
  try {
    const response = await axios.get('/messages', {
      params: {
        user_id: authId // Pass the authenticated user's ID as a parameter
      }
    });
    messages.value = response.data; // Assign the fetched messages to the reactive variable
  } catch (error) {
    console.error(error); // Log any errors
  }
};

// Call the fetchMessages function when the component is mounted
onMounted(() => {
  fetchMessages();
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
            <div class="-mt-64 bg-gray-200 p-4 md:col-span-2 rounded-full p-20">
              <h1 class="text-center mb-4"><strong>Pinboard-Messages</strong></h1>
              
              <!-- Render messages -->
              <ul>
                <li v-for="message in messages" :key="message.id">
                  User ID: {{ message.user_id }} - {{ message.first_name }} {{ message.last_name }}: {{ message.email}} "{{ message.message}}"
                </li>
              </ul>
            </div>
  
            <!-- Row 2 -->
            <div class="bg-gray-300 p-4">Row 2, Column 1</div>
            <div class="bg-gray-300 p-4">Row 2, Column 2</div>
          </div>
        </div>
      </AuthenticatedLayout>
    </div>
  </template>
  