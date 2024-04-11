<script setup lang="ts">
import { ref, onMounted, defineProps } from 'vue';
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "../../js/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from 'axios';

const props = defineProps({
  auth: Object, // Define the prop type as Object
});

/* const originalMessageContent = ref(''); */
const messages = ref<Message[]>([]);

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

</script>

<template>
  <div>

    <Head title="Dashboard"></Head>

    <GuestLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Pinboard
        </h2>
      </template>
      <div
        class="container min-h-screen grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 justify-center my-12 min-h-100">
        <div v-for="message in messages" :key="message.id">
          <a :href="'/singlestory/' + message.id" class="group relative block aspect-w-4 aspect-h-5 rounded-xl"
            style="height:auto;">
            <span class="absolute inset-0 border-2 border-dashed border-black dark:border-white rounded-xl"></span>
            <div
              class="relative flex flex-col h-full border-2 border-black dark:bg-white bg-slate-800 dark:text-slate-900 text-white transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2 rounded-xl ">
              <div class="p-4 pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8 rounded-xl">
                <i class="fa-solid fa-earth-africa fa-2x mt-3"></i>
                <h2 class="mt-4 text-xl font-medium sm:text-2xl">

                  <h1 class="text-4xl font-bold">{{ message.title }}</h1>
                </h2>
                <div>
                  <img v-if="message.image" :src="'/storage/' + message.image" alt="Message Image"
                    class="fluid my-4 rounded-lg">
                </div>
              </div>
              <div
                class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8">
                <h3 class="mt-4 text-xl font-medium sm:text-2xl">{{ message.title }}</h3>
                <p class="mt-4 text-sm sm:text-base">
                <h3 class="text-xl italic">{{ message.leadtext }}</h3>
                </p>
                <p>Created At: {{ formatCreatedAt(message.created_at) }}</p>
                <p class="mt-8 font-bold"><a :href="'/singlestory/' + message.id" class="read-more-link">Read more</a>
                </p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </GuestLayout>

  </div>
</template>
