<script setup lang="ts">
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

// Add any additional script setup code here
</script>

<template>
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
        <div class="bg-gray-200 p-4 md:col-span-2">
            <form action="{{ route('messages.store') }}" method="post" enctype="multipart/form-data">            <div class="mb-4">
              <label for="first_name" class="block text-gray-700 font-bold mb-2">First Name</label>
              <input type="text" id="first_name" name="first_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
              <label for="last_name" class="block text-gray-700 font-bold mb-2">Last Name</label>
              <input type="text" id="last_name" name="last_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
              <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
              <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
              <label for="message" class="block text-gray-700 font-bold mb-2">Message</label>
              <textarea id="message" name="message" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <div class="mb-4">
              <label for="uploaded_files" class="block text-gray-700 font-bold mb-2">Upload Files</label>
              <input type="file" id="uploaded_files" name="uploaded_files" accept=".css, .jpg, .jpeg, .png, .pdf" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
              <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
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
