<script setup lang="ts">
import { defineComponent } from 'vue';
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";

const props = defineProps<{
  message: {
    title: string;
    leadtext: string;
    message: string;
    image: string | null;
  };
}>();
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
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                <p class="text-lg">{{ message.title }}</p>
                <p class="text-base">{{ message.leadtext }}</p>
                <p class="text-sm">{{ message.message }}</p>
                <img v-if="message.image" :src="'/storage/' + message.image" alt="Message Image">
            </div>
        </div>
   
    </AuthenticatedLayout>
  </template>
  

  