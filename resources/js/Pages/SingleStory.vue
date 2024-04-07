<script setup lang="ts">
import { ref } from 'vue';
import { defineProps } from 'vue';
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from 'axios';

const props = defineProps<{
    message: {
        title: string;
        leadtext: string;
        message: string;
        image: string | null;
    };
}>();

import { onMounted, watchEffect } from 'vue';
import { useRoute } from 'vue-router';

// Define a reactive reference to store the message ID
const messageId = ref('');

// Get the route instance
const route = useRoute();

// When the component is mounted, set the message ID from the route params
onMounted(() => {
    messageId.value = route.params.id;
});

// Watch for changes in the message ID and update the local storage accordingly
watchEffect(() => {
    localStorage.setItem('lastMessageId', messageId.value);
});
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
                <img v-if="message.image" :src="'/storage/' + message.image" class="w-full h-[500px]"
                    alt="Message Image" />
            </div>

            <!-- Lower row with centered content -->
            <div class="flex items-center justify-center h-1/2">
                <div class="w-1/2 py-12">
                    <!-- Content goes here -->
                    <h1 class="text-3xl font-bold mb-4">{{ message.title }}</h1>
                    <p class="text-lg leading-relaxed">{{ message.leadtext }}</p>
                    <p class="text-sm">{{ message.message }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>