<script setup lang="ts">
import { ref, onMounted, defineProps } from 'vue';
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from 'axios';
import { useRoute } from 'vue-router';

const props = defineProps<{
  message: {
    id: number;
    title: string;
    leadtext: string;
    message: string;
    image: string | null;
  };
}>();

const route = useRoute();
const editMode = ref(false);

const deleteMessage = async (id: number) => {
  try {
    await axios.delete(`/messages/${id}`);
    // Redirect back to the pinboard or any other desired page after deletion
    window.location.href = '/pinboard'; // Replace '/pinboard' with the appropriate route
  } catch (error) {
    console.error('Error deleting message:', error);
  }
};

const updateMessage = async () => {
  try {
    const response = await axios.put(`/messages/${props.message.id}`, props.message);
    console.log('Message updated:', response.data);
    // Refresh the page or any other desired action after update
    window.location.reload();
  } catch (error) {
    console.error('Error updating message:', error);
  }
};
</script>


<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Single Story
            </h2>
        </template>

        <div class="min-h-screen">
            <!-- Upper row with full-width image -->
            <div class="bg-gray-800">
            <img v-if="message.image" :src="'/storage/' + message.image" class="w-full h-[500px]" alt="Message Image" />
            </div>

            <!-- Lower row with centered content -->
            <div class="flex items-center justify-center h-1/2">
            <div class="w-1/2 py-12">
                <!-- Content goes here -->
                <h1 class="text-3xl font-bold mb-4">{{ message.title }}</h1>
                <p class="text-lg leading-relaxed">{{ message.leadtext }}</p>
                <!-- Show textarea for editing message if in edit mode -->
                <textarea v-if="editMode" v-model="message.message" class="w-full border-gray-300 text-slate-800 rounded-md p-2"></textarea>
                <!-- Show message content if not in edit mode -->
                <p v-else class="text-sm">{{ message.message }}</p>
                <!-- Buttons for edit and delete -->
                <div class="flex justify-center mt-4">
                <button v-if="!editMode" @click="editMode = true" class="text-white bg-yellow-500 px-4 py-2 rounded-md mr-2">Edit</button>
                <button v-if="editMode" @click="updateMessage" class="text-white bg-blue-500 px-4 py-2 rounded-md mr-2">Update</button>
                <button @click="deleteMessage(message.id)" class="text-white bg-red-500 px-4 py-2 rounded-md">Delete</button>
                <a href="/pinboard" class="text-white bg-gray-500 px-4 py-2 rounded-md">Back to Pinboard</a>

                </div>
            </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>