<script setup lang="ts">
import { ref, Ref } from 'vue';
import { defineProps } from 'vue';
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from 'axios';
import { createRouter, createWebHistory } from 'vue-router';


const csrfToken = document.head.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
// Define props
const { authId } = defineProps(['authId']);

// Define the type of formData
interface FormData {
  title: string;
  leadtext: string;
  message: string;
  image: File | null; // Allow image to be either a File or null
}


// Define reactive formData
const formData: Ref<FormData> = ref({
  title: '',
  leadtext: '',
  message: '',
  image: null,
});

const successMessage = ref<string | null>(null);

// Define method to handle image change
const handleImageChange = (event: Event) => {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    formData.value.image = target.files[0];
  }
};

// Define method to submit form
const submitForm = async () => {
  try {
    console.log("User ID:", authId);
    // Create form data object
    const formDataToSend = new FormData();
    // Append form fields
    formDataToSend.append('title', formData.value.title);
    formDataToSend.append('leadtext', formData.value.leadtext);
    formDataToSend.append('message', formData.value.message);
    // Append image file
    if (formData.value.image) {
      formDataToSend.append('image', formData.value.image);
    }
    // Append user ID
    formDataToSend.append('user_id', authId);
    // Send form data using axios
    const response = await axios.post('/messages', formDataToSend, {
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Content-Type': 'multipart/form-data'
      }
    });
    console.log(response.data);
    // Handle success response
    successMessage.value = response.data.message;
    // Clear form data
    formData.value.title = '';
    formData.value.leadtext = '';
    formData.value.message = '';
    formData.value.image = null;
  } catch (error: any) {
    console.error(error.response.data);
  }
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="container lg:mt-0 mt-4 px-1 lg:min-h-screen flex justify-center items-center">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Row 1 -->
        <div class=" bg-gray-200 md:col-span-2 rounded-full p-20">
          <h1 class="text-center mb-4"><strong>Your Message Belongs Here !!!</strong></h1>
          <form @submit.prevent="submitForm" enctype="multipart/form-data" class="formOwnOne space-y-4">
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
              <input type="text" id="title" v-model="formData.title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
              <label for="leadtext" class="block text-sm font-medium text-gray-700">Leadtext</label>
              <input type="text" id="leadtext" v-model="formData.leadtext" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
              <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
              <textarea id="message" v-model="formData.message" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            <div>
              <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
              <input type="file" id="image" accept="image/*" @change="handleImageChange" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
              </button>
            </div>
          </form>
        </div>
        
            <!-- Tailwind modal for displaying success message -->
    <div v-if="successMessage" class="fixed inset-0 overflow-y-auto">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This is the modal container -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal panel, show/hide based on modal state. -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                <!-- Heroicon name: check -->
                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg font-medium text-gray-900" id="modal-headline">
                  Success!
                </h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">
                    {{ successMessage }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <a href="/pinboard" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
              Go to PinBoard
            </a>
          </div>
        </div>
      </div>
    </div>

        <!-- Row 2 -->
        <div class="bg-gray-300 p-4">Row 2, Column 1</div>
        <div class="bg-gray-300 p-4">Row 2, Column 2</div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
