<script setup lang="ts">
import { ref, defineProps } from 'vue';
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "../../js/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from 'axios';

const props = defineProps<{
    message: {
        id: number;
        user_id: number;
        title: string;
        leadtext: string;
        message: string;
        image: string | null;
    };
    authId: number; // Add authId prop
}>();

const editMode = ref(false);
let originalMessageTitle: string;
let originalLeadText: string;
let originalMessageContent: string;

const deleteMessage = async (id: number) => {
    try {
        await axios.delete(`/messages/${id}`);
        window.location.href = '/pinboard'; // Redirect to the pinboard after deletion
    } catch (error) {
        console.error('Error deleting message:', error);
    }
};

const updateMessage = async () => {
    try {
        const response = await axios.put(`/messages/${props.message.id}`, props.message);
        console.log('Message updated:', response.data);
        window.location.reload(); // Refresh the page after update
    } catch (error) {
        console.error('Error updating message:', error);
    }
};

const startEditMode = () => {
    editMode.value = true;
    // Save the original message title, lead text, and content
    originalMessageTitle = props.message.title;
    originalLeadText = props.message.leadtext;
    originalMessageContent = props.message.message;
};

const cancelEdit = () => {
    editMode.value = false;
    // Restore the original message title, lead text, and content
    props.message.title = originalMessageTitle;
    props.message.leadtext = originalLeadText;
    props.message.message = originalMessageContent;
};

</script>

<template>
    
    <Head title="Dashboard"></Head>

    <GuestLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Single Story
            </h2>
        </template>
        <div class="min-h-screen">
            <!-- Upper row with full-width image -->
            <div class="relative h-[500px] overflow-hidde">
                <img v-if="message.image" :src="'/storage/' + message.image" class="absolute inset-0 w-full h-full object-cover object-center" alt="Message Image" />
            </div>
            <!-- Lower row with centered content -->
            <div class="flex items-center justify-center h-1/2">
                <div class="w-1/2 py-12">
                    <!-- Content goes here -->
                    <h1 v-if="editMode" class="text-3xl font-bold mb-4">
                        <input v-model="props.message.title" class="w-full border-gray-300 text-slate-800 rounded-md p-2">
                    </h1>
                    <h1 v-else class="text-3xl font-bold mb-4">{{ props.message.title }}</h1>
                    <p v-if="editMode" class="text-lg leading-relaxed">
                        <textarea v-model="props.message.leadtext" class="w-full border-gray-300 text-slate-800 rounded-md p-2"></textarea>
                    </p>
                    <p v-else class="text-lg leading-relaxed">{{ props.message.leadtext }}</p>
                    <!-- Show textarea for editing message if in edit mode -->
                    <textarea v-if="editMode" v-model="props.message.message" class="w-full border-gray-300 text-slate-800 rounded-md p-2"></textarea>
                    <!-- Show message content if not in edit mode -->
                    <p v-else class="textSingle text-sm">{{ props.message.message }}</p>
                    <!-- Buttons for edit and delete -->
                    <div class="flex justify-center mt-4 gap-2">
                        <button v-if="props.authId === props.message.user_id" @click="!editMode ? startEditMode() : updateMessage()" class="text-white bg-yellow-500 px-4 py-2 rounded-md mr-0">{{ !editMode ? 'Edit' : 'Update' }}</button>
                        <button v-if="props.authId === props.message.user_id && !editMode" @click="deleteMessage(props.message.id)" class="text-white bg-red-500 px-4 py-2 rounded-md">Delete</button>
                        <button v-if="editMode" @click="cancelEdit" class="text-white bg-gray-500 px-4 py-2 rounded-md">Cancel</button>
                        <a href="/pinboard" type="button" class="text-white bg-gray-500 px-4 py-2 rounded-md">Back to Pinboard</a>
                        
                    </div>
                    <!-- admin only start -->
                    <div  v-if="$page.props.auth.user" class="flex mt-4 justify-center align-middle ">
                        <p>Auth ID: {{ props.authId }}</p>
                        <p>Message User ID: {{ props.message.user_id }}</p>
                    </div>
                    <!-- admin only stop -->
                </div>
                
            </div>
        </div>
     
    </GuestLayout>
    
</template>

<style>
.textSingle {
    white-space: pre-wrap;
}
</style>
