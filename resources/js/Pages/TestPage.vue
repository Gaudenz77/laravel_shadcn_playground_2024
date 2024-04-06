<script setup lang="ts">
import { ref } from 'vue';
import { defineProps } from 'vue';
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from 'axios';

const { authId } = defineProps(['authId']); // Fetch the authenticated user's ID passed from backend

const csrfToken = document.head.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

const formData = ref({
  title: '',
  leadtext: '',
  message: '',
});

const submitForm = async () => {
  try {
    console.log("User ID:", authId); // Log the user ID
    const response = await axios.post('/messages', {
      ...formData.value,
      user_id: authId // Include the authenticated user's ID in the request data
    }, {
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Content-Type': 'application/json'
      }
    });
    console.log(response.data); // Handle response

    // Clear the form inputs after successful submission
    formData.value.title = '';
    formData.value.leadtext = '';
    formData.value.message = '';
  } catch (error:any) {
    console.error(error.response.data); // Handle error
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
        <div class=" bg-gray-200 md:col-span-2 p-2 rounded">
          <h1 class="text-center mb-4"><strong>Your Message Belongs Here !!!</strong></h1>
          <form @submit.prevent="submitForm" class="formOwnOne space-y-4">
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
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
              </button>
            </div>
          </form>
        </div>

        <!-- Row 2 -->
        <div class="bg-gray-300 p-4">Row 2, Column 1</div>
        <div class="bg-gray-300 p-4">Row 2, Column 2</div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
