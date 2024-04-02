<script setup lang="ts">
import { onMounted, defineProps } from 'vue';
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from 'axios';
import { ref, Ref } from 'vue';

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
const messages: Ref<Message[]> = ref([]);

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
    console.error('Error fetching messages:', error); // Log any errors
  }
};

const deleteMessage = async (messageId: number) => {
  console.log('Deleting message with ID:', messageId);
  try {
    await axios.delete(`/messages/${messageId}`);
    // Find the index of the deleted message in the messages array
    const index = messages.value.findIndex(message => message.id === messageId);
    // If the message is found, remove it from the array
    if (index !== -1) {
      messages.value.splice(index, 1);
      // Force Vue to detect the change by assigning a new array reference
      messages.value = [...messages.value];
    }
  } catch (error) {
    console.error('Error deleting message:', error); // Log any errors
  }
};

// Define a reactive variable to store the edited message
const editedMessage: Ref<Message | null> = ref(null);

// Function to handle editing a message
const editMessage = async (message: Message) => {
  try {
    // Make a PUT request to the backend route for updating the message
    const response = await axios.put(`/messages/${message.id}`, {
      first_name: message.first_name,
      last_name: message.last_name,
      email: message.email,
      message: message.message,
    });

    // Handle the response from the backend
    if (response.status === 200) {
      // Update the edited message
      editedMessage.value = response.data;
      console.log('Message updated successfully:', editedMessage.value);
    }
  } catch (error) {
    console.error('Error updating message:', error);
  }
}; 

// Call the fetchMessages function when the component is mounted
onMounted(() => {
  fetchMessages();
});

// Function to format the created_at date
const formatCreatedAt = (createdAt: string) => {
  const date = new Date(createdAt);
  return date.toLocaleString(); // Format the date to a human-readable format
};

// Set the X-CSRF-Token for Axios requests
const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
if (csrfTokenMeta) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfTokenMeta.getAttribute('content') || '';
} else {
  console.error("CSRF token meta tag not found.");
}

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
            <div v-for="message in messages" :key="message.id">
              <!-- Render cards for messages from the logged-in user -->
              <div v-if="message.user_id === authId" class="bg-blue-200 p-4 mb-4 rounded-md -ml-60 animate__animated animate__fadeInLeft">
                <p><!-- User ID: {{ message.user_id }}  -->- 
                {{ message.first_name }} {{ message.last_name }}</p>
                <!-- <p>Email: {{ message.email }}</p> -->
                <p>Message: "{{ message.message }}"</p> 
                <p>Created At: {{ formatCreatedAt(message.created_at) }}</p>
                <div><button @click="deleteMessage(message.id)" class="text-red-500">Delete</button></div>
                <div><button @click="editMessage(message)" class="text-blue-500">Edit</button></div>
              </div>
              <!-- Render cards for other messages -->
              <div v-else class="bg-gray-200 p-4 mb-4 rounded-md -mr-60 animate__animated animate__fadeInRight">
                <p><!-- User ID: {{ message.user_id }}  -->- 
                {{ message.first_name }} {{ message.last_name }}</p>
                <!-- <p>Email: {{ message.email }}</p> -->
                
                <p>Message: "{{ message.message }}"</p>
                <p>Created At: {{ formatCreatedAt(message.created_at) }}</p>
              </div>
            </div>
          </div>

          <!-- Row 2 -->
          <!-- <div class="bg-gray-300 p-4">Row 2, Column 1</div>
          <div class="bg-gray-300 p-4">Row 2, Column 2</div> -->
        </div>
      </div>
    </AuthenticatedLayout>
  </div>
</template>


